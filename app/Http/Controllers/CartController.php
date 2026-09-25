<?php

namespace App\Http\Controllers;

use App\Models\Cart;

class CartController extends Controller
{
    public function destroy(string $id)
    {
        $userId = auth()->id() ?? 1;

        $cart = Cart::where('id', $id)
            ->where('user_id', $userId)
            ->firstOrFail();

        $cart->delete();

        return redirect()
            ->route('customer.cart')
            ->with('success', 'Product removed from cart.');
    }
}
