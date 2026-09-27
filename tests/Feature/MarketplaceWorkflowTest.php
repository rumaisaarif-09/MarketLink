<?php

namespace Tests\Feature;

use App\Models\Category;
use App\Models\Order;
use App\Models\Product;
use App\Models\Review;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class MarketplaceWorkflowTest extends TestCase
{
    use RefreshDatabase;

    public function test_vendor_registration_redirects_to_vendor_area_and_buyer_cannot_enter(): void
    {
        $this->post(route('register.store'), [
            'name' => 'Vendor One',
            'email' => 'vendor@example.test',
            'role' => 'vendor',
            'password' => 'secure-password',
            'password_confirmation' => 'secure-password',
        ])->assertRedirect(route('vendor.dashboard'));

        $this->assertDatabaseHas('users', [
            'email' => 'vendor@example.test',
            'role' => 'vendor',
            'is_active' => true,
        ]);
        $this->assertAuthenticatedAs(User::where('email', 'vendor@example.test')->firstOrFail());
        $this->get(route('vendor.dashboard'))->assertOk();
        $this->get(route('vendor.orders.index'))->assertOk();
        $this->get(route('vendor.profile.edit'))->assertOk();
        $this->get(route('vendor.reviews.index'))->assertOk();

        $this->post(route('logout'))->assertRedirect(route('login.vendor'));
        $buyer = User::factory()->create(['role' => 'buyer']);
        $this->actingAs($buyer)->get(route('vendor.dashboard'))->assertForbidden();
        $this->get(route('admin.dashboard'))->assertForbidden();
    }

    public function test_login_redirects_admin_vendor_and_buyer_to_their_dashboards(): void
    {
        foreach ([
            'admin' => ['dashboard' => 'admin.dashboard', 'login' => 'login.admin'],
            'vendor' => ['dashboard' => 'vendor.dashboard', 'login' => 'login.vendor'],
            'buyer' => ['dashboard' => 'customer.dashboard', 'login' => 'login.customer'],
        ] as $role => $config) {
            $user = User::factory()->create([
                'role' => $role,
                'password' => Hash::make('secure-password'),
            ]);

            $this->post(route('login.store'), [
                'email' => $user->email,
                'password' => 'secure-password',
            ])->assertRedirect(route($config['dashboard']));

            $this->post(route('logout'))->assertRedirect(route($config['login']));
        }
    }

    public function test_role_specific_login_pages_are_available_for_customer_vendor_and_admin(): void
    {
        $this->get(route('login'))->assertOk()->assertSee('Customer')->assertSee('Vendor')->assertDontSee('Admin Login');
        $this->get(route('login.customer'))->assertOk()->assertSee('Customer Portal');
        $this->get(route('login.vendor'))->assertOk()->assertSee('Vendor Portal');
        $this->get(route('login.admin'))->assertOk()->assertSee('Admin Portal');
        $this->get(route('admin.login'))->assertOk()->assertSee('Admin Portal');

        $customer = User::factory()->create([
            'role' => 'buyer',
            'password' => Hash::make('secure-password'),
        ]);

        $this->post(route('login.customer.store'), [
            'email' => $customer->email,
            'password' => 'secure-password',
        ])->assertRedirect(route('customer.dashboard'));

        $this->post(route('logout'))->assertRedirect(route('login.customer'));

        $vendor = User::factory()->create([
            'role' => 'vendor',
            'password' => Hash::make('secure-password'),
        ]);

        $this->post(route('login.vendor.store'), [
            'email' => $vendor->email,
            'password' => 'secure-password',
        ])->assertRedirect(route('vendor.dashboard'));

        $this->post(route('logout'))->assertRedirect(route('login.vendor'));

        $admin = User::factory()->create([
            'role' => 'admin',
            'password' => Hash::make('secure-password'),
        ]);

        $this->post(route('login.admin.store'), [
            'email' => $admin->email,
            'password' => 'secure-password',
        ])->assertRedirect(route('admin.dashboard'));
    }

    public function test_checkout_creates_order_decrements_stock_and_review_requires_delivery(): void
    {
        $vendor = User::factory()->create(['role' => 'vendor']);
        $buyer = User::factory()->create(['role' => 'buyer']);
        $category = Category::create(['name' => 'Produce', 'slug' => 'produce']);
        $product = Product::create([
            'user_id' => $vendor->id,
            'category_id' => $category->id,
            'name' => 'Fresh Apples',
            'description' => 'Local apples',
            'price' => 12.50,
            'stock' => 5,
            'status' => 'approved',
        ]);

        $this->actingAs($buyer)
            ->withSession(['cart' => [$product->id => [
                'name' => $product->name,
                'quantity' => 2,
                'price' => 1,
            ]]])
            ->get(route('customer.cart'))
            ->assertOk()
            ->assertSee('Fresh Apples')
            ->assertSee(route('customer.cart.remove', $product));

        $this->actingAs($buyer)
            ->withSession(['cart' => [$product->id => [
                'name' => $product->name,
                'quantity' => 2,
                'price' => 1,
            ]]])
            ->post(route('customer.order.place'), [
                'phone' => '555-0100',
                'address' => '1 Market Street',
            ])
            ->assertRedirect(route('customer.orders'));

        $order = Order::firstOrFail();
        $this->assertEquals(25.00, (float) $order->total_amount);
        $this->assertSame(3, $product->fresh()->stock);
        $orderItem = $order->items()->firstOrFail();
        $this->assertSame($product->id, $orderItem->product_id);
        $this->assertSame(2, $orderItem->quantity);
        $this->assertEquals(12.50, (float) $orderItem->price);

        $admin = User::factory()->create(['role' => 'admin']);
        $this->actingAs($admin)->post(route('admin.orders.updateStatus', $order), [
            'status' => 'shipped',
        ])->assertRedirect();
        $this->assertDatabaseHas('orders', ['id' => $order->id, 'status' => 'shipped']);

        $this->actingAs($buyer)->get(route('customer.product', $product))
            ->assertOk()
            ->assertDontSee('Submit Review');
        $this->post(route('customer.reviews.store', $product), [
            'rating' => 5,
            'comment' => 'Fresh and tasty',
        ])->assertSessionHas('error');
        $this->assertSame(0, Review::count());

        $order->update(['status' => 'delivered']);
        $this->get(route('customer.product', $product))
            ->assertOk()
            ->assertSee('Submit Review');
        $this->get(route('customer.orders'))->assertOk()->assertSee('Delivered');
        $this->post(route('customer.reviews.store', $product), [
            'rating' => 5,
            'comment' => 'Fresh and tasty',
        ])->assertSessionHas('success');

        $this->assertDatabaseHas('reviews', [
            'product_id' => $product->id,
            'user_id' => $buyer->id,
            'rating' => 5,
        ]);

        $review = Review::firstOrFail();
        $this->actingAs($vendor)->get(route('vendor.reviews.index'))
            ->assertOk()
            ->assertSee('Fresh Apples');
        $this->post(route('vendor.reviews.respond', $review), [
            'vendor_response' => 'Thank you for your feedback.',
        ])->assertRedirect();
        $this->assertDatabaseHas('reviews', [
            'id' => $review->id,
            'vendor_response' => 'Thank you for your feedback.',
        ]);

        $admin = User::factory()->create(['role' => 'admin']);
        $this->actingAs($admin)->get(route('admin.dashboard'))->assertOk();
        $this->get(route('admin.users'))->assertOk();
        $this->get(route('admin.orders'))->assertOk();
        $this->get(route('admin.reports'))->assertOk();
        $this->get(route('admin.reviews.index'))->assertOk();
        $this->actingAs($admin)->patch(route('admin.reviews.visibility', $review))->assertRedirect();
        $this->assertDatabaseHas('reviews', ['id' => $review->id, 'is_visible' => false]);
    }

    public function test_vendor_sees_only_own_orders_and_admin_can_disable_access(): void
    {
        $vendor = User::factory()->create(['role' => 'vendor']);
        $otherVendor = User::factory()->create(['role' => 'vendor']);
        $buyer = User::factory()->create(['role' => 'buyer']);
        $admin = User::factory()->create(['role' => 'admin']);
        $category = Category::create(['name' => 'Fruit', 'slug' => 'fruit']);
        $ownProduct = Product::create([
            'user_id' => $vendor->id,
            'category_id' => $category->id,
            'name' => 'Vendor One Pears',
            'price' => 8,
            'stock' => 4,
            'status' => 'approved',
        ]);
        $otherProduct = Product::create([
            'user_id' => $otherVendor->id,
            'category_id' => $category->id,
            'name' => 'Vendor Two Plums',
            'price' => 9,
            'stock' => 4,
            'status' => 'approved',
        ]);
        $order = Order::create([
            'user_id' => $buyer->id,
            'total_amount' => 17,
            'payment_method' => 'COD',
            'status' => 'processing',
            'shipping_address' => '2 Market Street',
            'phone' => '555-0101',
        ]);
        $order->items()->create(['product_id' => $ownProduct->id, 'quantity' => 1, 'price' => 8]);
        $order->items()->create(['product_id' => $otherProduct->id, 'quantity' => 1, 'price' => 9]);

        $this->actingAs($vendor)->get(route('vendor.orders.index'))
            ->assertOk()
            ->assertSee('Vendor One Pears')
            ->assertDontSee('Vendor Two Plums');
        $this->get(route('vendor.products.edit', $otherProduct))->assertNotFound();

        $this->actingAs($vendor)->put(route('vendor.profile.update'), [
            'name' => 'Vendor One Updated',
            'email' => $vendor->email,
        ])->assertRedirect();
        $this->assertDatabaseHas('users', ['id' => $vendor->id, 'name' => 'Vendor One Updated']);

        $admin = User::factory()->create(['role' => 'admin']);
        $this->actingAs($admin)->get(route('admin.dashboard'))->assertOk();
        $this->actingAs($admin)->patch(route('admin.users.role', $buyer), ['role' => 'vendor'])->assertRedirect();
        $this->actingAs($admin)->patch(route('admin.users.access', $buyer))->assertRedirect();
        $this->assertDatabaseHas('users', ['id' => $buyer->id, 'role' => 'vendor', 'is_active' => false]);
    }

    public function test_vendor_market_pin_is_saved_and_listed_on_the_public_map(): void
    {
        $vendor = User::factory()->create(['role' => 'vendor']);

        $this->get(route('markets.index'))
            ->assertOk()
            ->assertSee('No vendors have added a market location yet.');

        $this->actingAs($vendor)->put(route('vendor.profile.update'), [
            'name' => $vendor->name,
            'email' => $vendor->email,
            'market_name' => 'Green Valley Farm',
            'market_address' => '12 Orchard Road, Lahore',
            'market_latitude' => '31.5204',
            'market_longitude' => '74.3587',
        ])->assertRedirect();

        $this->assertDatabaseHas('users', [
            'id' => $vendor->id,
            'market_name' => 'Green Valley Farm',
            'market_latitude' => '31.5204000',
            'market_longitude' => '74.3587000',
        ]);

        $this->get(route('markets.index'))
            ->assertOk()
            ->assertSee('Green Valley Farm')
            ->assertSee('12 Orchard Road, Lahore')
            ->assertDontSee('No vendors have added a market location yet.');
    }

    public function test_vendor_can_accept_and_mark_order_ready_for_pickup(): void
    {
        $vendor = User::factory()->create(['role' => 'vendor']);
        $buyer = User::factory()->create(['role' => 'buyer']);
        $category = Category::create(['name' => 'Fruit', 'slug' => 'fruit']);
        $product = Product::create([
            'user_id' => $vendor->id,
            'category_id' => $category->id,
            'name' => 'Seasonal Peaches',
            'price' => 90,
            'stock' => 15,
            'status' => 'approved',
        ]);

        $order = Order::create([
            'user_id' => $buyer->id,
            'total_amount' => 180,
            'payment_method' => 'COD',
            'status' => 'pending',
            'shipping_address' => '4 Valley Road',
            'phone' => '0300-0000001',
            'pickup_date' => '2026-09-30',
            'pickup_time' => '10:30 AM',
        ]);
        $order->items()->create([
            'product_id' => $product->id,
            'quantity' => 2,
            'price' => 90,
        ]);

        $this->actingAs($vendor)
            ->post(route('vendor.orders.updateStatus', $order), ['status' => 'accepted'])
            ->assertRedirect();

        $this->assertDatabaseHas('orders', ['id' => $order->id, 'status' => 'accepted']);

        $this->actingAs($vendor)
            ->post(route('vendor.orders.updateStatus', $order), ['status' => 'ready_for_pickup'])
            ->assertRedirect();

        $this->assertDatabaseHas('orders', ['id' => $order->id, 'status' => 'ready_for_pickup']);

        $this->actingAs($buyer)->get(route('customer.orders'))->assertOk()->assertSee('Ready for pickup');
    }

    public function test_customer_can_filter_products_and_save_favorites_with_pickup_details(): void
    {
        $vendor = User::factory()->create([
            'role' => 'vendor',
            'market_name' => 'Green Valley Farm',
            'market_day' => 'Saturday',
        ]);
        $buyer = User::factory()->create(['role' => 'buyer']);
        $category = Category::create(['name' => 'Fruit', 'slug' => 'fruit']);

        $product = Product::create([
            'user_id' => $vendor->id,
            'category_id' => $category->id,
            'name' => 'Fresh Mangoes',
            'description' => 'Seasonal mangoes',
            'price' => 120,
            'stock' => 10,
            'status' => 'approved',
        ]);

        $this->actingAs($buyer)
            ->get(route('products.index', ['market' => $vendor->id, 'day' => 'Saturday']))
            ->assertOk()
            ->assertSee('Fresh Mangoes');

        $this->actingAs($buyer)
            ->post(route('favorites.toggle', ['type' => 'product', 'id' => $product->id]))
            ->assertRedirect();

        $this->assertDatabaseHas('favorites', [
            'user_id' => $buyer->id,
            'favorite_type' => 'product',
            'favorite_id' => $product->id,
        ]);

        $this->withSession(['cart' => [$product->id => [
            'name' => $product->name,
            'quantity' => 1,
            'price' => 120,
        ]]])
            ->post(route('customer.order.place'), [
                'phone' => '0300-1234567',
                'address' => 'Main Bazaar, Lahore',
                'pickup_date' => '2026-09-30',
                'pickup_time' => '10:30 AM',
            ])
            ->assertRedirect(route('customer.orders'));

        $this->assertDatabaseHas('orders', [
            'user_id' => $buyer->id,
            'pickup_date' => '2026-09-30',
            'pickup_time' => '10:30 AM',
            'status' => 'pending',
        ]);

        $this->actingAs($buyer)
            ->post(route('customer.order.cancel', Order::firstOrFail()))
            ->assertRedirect(route('customer.orders'));

        $this->assertDatabaseHas('orders', [
            'id' => Order::firstOrFail()->id,
            'status' => 'cancelled',
        ]);
    }
}