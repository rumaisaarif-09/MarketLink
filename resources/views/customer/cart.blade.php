<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Cart - eGreen Basket</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
            background: #f4f8f3;
            color: #1f2d24;
        }

        .navbar {
            height: 70px;
            background: #ffffff;
            border-bottom: 1px solid #dfe8df;
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 40px;
        }

        .logo {
            font-size: 22px;
            font-weight: 700;
            color: #2e7d32;
        }

        .back {
            text-decoration: none;
            color: #2e7d32;
            font-weight: 600;
        }

        .container {
            max-width: 1100px;
            margin: 45px auto;
            padding: 0 25px;
        }

        h1 {
            margin-bottom: 25px;
        }

        .message {
            background: #e8f5e9;
            color: #2e7d32;
            border: 1px solid #c8e6c9;
            padding: 13px 16px;
            border-radius: 9px;
            margin-bottom: 20px;
        }

        .error {
            background: #ffebee;
            color: #c62828;
            border: 1px solid #ffcdd2;
            padding: 13px 16px;
            border-radius: 9px;
            margin-bottom: 20px;
        }

        .cart-layout {
            display: grid;
            grid-template-columns: 1fr 320px;
            gap: 25px;
        }

        .cart-item,
        .summary,
        .empty {
            background: #ffffff;
            border: 1px solid #dfe8df;
            border-radius: 16px;
        }

        .cart-item {
            display: flex;
            gap: 20px;
            padding: 18px;
            margin-bottom: 15px;
            align-items: center;
        }

        .product-image {
            width: 110px;
            height: 100px;
            object-fit: cover;
            border-radius: 10px;
            background: #edf4ed;
        }

        .no-image {
            width: 110px;
            height: 100px;
            border-radius: 10px;
            background: #edf4ed;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #2e7d32;
            font-size: 30px;
        }

        .item-info {
            flex: 1;
        }

        .item-info h3 {
            margin-bottom: 8px;
        }

        .price {
            color: #2e7d32;
            font-weight: 700;
        }

        .quantity {
            margin-top: 8px;
            color: #68756d;
            font-size: 14px;
        }

        .item-total {
            min-width: 130px;
            font-weight: 700;
            font-size: 17px;
            text-align: right;
        }

        .remove-btn {
            margin-top: 10px;
            border: none;
            background: #ffebee;
            color: #c62828;
            padding: 8px 12px;
            border-radius: 7px;
            font-size: 13px;
            font-weight: 600;
            cursor: pointer;
        }

        .remove-btn:hover {
            background: #ffcdd2;
        }

        .summary {
            padding: 25px;
            height: fit-content;
        }

        .summary h2 {
            margin-bottom: 20px;
        }

        .summary-row {
            display: flex;
            justify-content: space-between;
            margin-bottom: 15px;
        }

        .grand-total {
            border-top: 1px solid #dfe8df;
            padding-top: 18px;
            margin-top: 18px;
            font-size: 20px;
            font-weight: 700;
        }

        .checkout-btn {
            display: block;
            width: 100%;
            border: none;
            background: #2e7d32;
            color: #ffffff;
            padding: 14px;
            border-radius: 9px;
            margin-top: 20px;
            font-size: 15px;
            font-weight: 700;
            cursor: pointer;
            text-align: center;
            text-decoration: none;
        }

        .checkout-btn:hover {
            background: #256b29;
        }

        .empty {
            padding: 70px 30px;
            text-align: center;
        }

        .empty i {
            font-size: 50px;
            color: #2e7d32;
            margin-bottom: 18px;
        }

        .empty h2 {
            margin-bottom: 10px;
        }

        .shop-btn {
            display: inline-block;
            margin-top: 20px;
            background: #2e7d32;
            color: #ffffff;
            padding: 12px 22px;
            border-radius: 9px;
            text-decoration: none;
            font-weight: 700;
        }

        @media (max-width: 800px) {
            .cart-layout {
                grid-template-columns: 1fr;
            }

            .navbar {
                padding: 0 20px;
            }
        }

        @media (max-width: 550px) {
            .cart-item {
                flex-wrap: wrap;
            }

            .item-total {
                width: 100%;
                text-align: left;
            }
        }
    </style>
</head>

<body>

<nav class="navbar">
    <div class="logo">eGreen Basket</div>

    <a href="{{ route('customer.dashboard') }}" class="back">
        <i class="fa-solid fa-arrow-left"></i>
        Continue Shopping
    </a>
</nav>

<div class="container">

    <h1>My Cart</h1>

    @if(session('success'))
        <div class="message">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="error">
            {{ session('error') }}
        </div>
    @endif

    @if($cartItems->count() > 0)

        <div class="cart-layout">

            <div>
                @foreach($cartItems as $item)

                    <div class="cart-item">

                        @if($item->product->image)
                            <img
                                src="{{ asset('storage/' . $item->product->image) }}"
                                alt="{{ $item->product->name }}"
                                class="product-image"
                            >
                        @else
                            <div class="no-image">
                                <i class="fa-solid fa-leaf"></i>
                            </div>
                        @endif

                        <div class="item-info">

                            <h3>{{ $item->product->name }}</h3>

                            <div class="price">
                                Rs. {{ number_format($item->product->price, 2) }}
                            </div>

                            <div class="quantity">
                                Quantity: {{ $item->quantity }}
                            </div>

                        </div>

                        <div class="item-total">

                            <div>
                                Rs. {{ number_format($item->product->price * $item->quantity, 2) }}
                            </div>

                            <form
                                action="{{ route('customer.cart.remove', $item->id) }}"
                                method="POST"
                            >
                                @csrf
                                @method('DELETE')

                                <button type="submit" class="remove-btn">
                                    <i class="fa-solid fa-trash"></i>
                                    Remove
                                </button>
                            </form>

                        </div>

                    </div>

                @endforeach
            </div>

            <div class="summary">

                <h2>Order Summary</h2>

                <div class="summary-row">
                    <span>Items</span>
                    <span>{{ $cartItems->sum('quantity') }}</span>
                </div>

                <div class="summary-row grand-total">
                    <span>Total</span>
                    <span>
                        Rs. {{ number_format($total, 2) }}
                    </span>
                </div>

                <a
                    href="{{ route('customer.checkout') }}"
                    class="checkout-btn"
                >
                    <i class="fa-solid fa-credit-card"></i>
                    Proceed to Checkout
                </a>

            </div>

        </div>

    @else

        <div class="empty">

            <i class="fa-solid fa-cart-shopping"></i>

            <h2>Your Cart is Empty</h2>

            <p>Add some fresh products to your cart.</p>

            <a
                href="{{ route('customer.dashboard') }}"
                class="shop-btn"
            >
                Start Shopping
            </a>

        </div>

    @endif

</div>

</body>
</html>
