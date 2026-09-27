<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout - eGreen Basket</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background: #f3f7f2; color: #263328; }
        .panel { background: #fff; border: 1px solid #e0e8df; border-radius: 8px; }
        .text-green { color: #47734b; }
        .btn-green { color: #fff; background: #47734b; }
        .btn-green:hover { color: #fff; background: #365c3a; }
    </style>
</head>
<body>
    <nav class="navbar bg-white border-bottom px-3 py-3">
        <div class="container"><x-brand-logo :href="route('products.index')" class="navbar-brand" /><a href="{{ route('customer.cart') }}">Back to Cart</a></div>
    </nav>
    <main class="container py-4" style="max-width: 1000px">
        <h1 class="h3 mb-4">Checkout</h1>
        @if($errors->any()) <div class="alert alert-danger">{{ $errors->first() }}</div> @endif
        <div class="row g-4">
            <section class="col-md-6">
                <div class="panel p-4">
                    <h2 class="h5 mb-3">Order Summary</h2>
                    @forelse($cartItems as $item)
                        <div class="d-flex justify-content-between py-2 border-bottom">
                            <span>{{ $item['name'] }} <small class="text-muted">x {{ $item['quantity'] }}</small></span>
                            <strong>Rs. {{ number_format($item['price'] * $item['quantity'], 2) }}</strong>
                        </div>
                    @empty
                        <p class="text-muted">Your cart is empty.</p>
                    @endforelse
                    <div class="d-flex justify-content-between mt-3"><strong>Total</strong><strong class="text-green">Rs. {{ number_format($total, 2) }}</strong></div>
                </div>
            </section>
            <section class="col-md-6">
                <form class="panel p-4" action="{{ route('customer.order.place') }}" method="POST">
                    @csrf
                    <h2 class="h5 mb-3">Delivery Details</h2>
                    <div class="mb-3"><label class="form-label" for="phone">Phone Number</label><input class="form-control" id="phone" name="phone" value="{{ old('phone') }}" required></div>
                    <div class="mb-3"><label class="form-label" for="address">Pickup Address</label><textarea class="form-control" id="address" name="address" rows="4" required>{{ old('address') }}</textarea></div>
                    <div class="mb-3"><label class="form-label" for="pickup_date">Pickup Date</label><input class="form-control" id="pickup_date" name="pickup_date" type="date" value="{{ old('pickup_date') }}" min="{{ date('Y-m-d') }}" required></div>
                    <div class="mb-3"><label class="form-label" for="pickup_time">Pickup Time</label><input class="form-control" id="pickup_time" name="pickup_time" type="time" value="{{ old('pickup_time') }}" required></div>
                    <p class="text-muted">Payment: Cash on pickup. No online payment gateway.</p>
                    <button class="btn btn-green w-100" type="submit" @disabled($cartItems->isEmpty())>Place Order</button>
                </form>
            </section>
        </div>
    </main>
</body>
</html>
