
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout - eGreen Basket</title>

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

        .checkout-layout {
            display: grid;
            grid-template-columns: 1fr 350px;
            gap: 25px;
        }

        .box {
            background: #ffffff;
            border: 1px solid #dfe8df;
            border-radius: 16px;
            padding: 25px;
        }

        .box h2 {
            margin-bottom: 22px;
        }

        .form-group {
            margin-bottom: 18px;
        }

        .form-group label {
            display: block;
            margin-bottom: 8px;
            font-weight: 600;
        }

        .form-group input,
        .form-group textarea,
        .form-group select {
            width: 100%;
            padding: 12px;
            border: 1px solid #ccd8ce;
            border-radius: 8px;
            font-size: 14px;
            outline: none;
        }

        .form-group input:focus,
        .form-group textarea:focus,
        .form-group select:focus {
            border-color: #2e7d32;
        }

        .form-group textarea {
            min-height: 100px;
            resize: vertical;
        }

        .summary-item {
            display: flex;
            justify-content: space-between;
            margin-bottom: 15px;
            gap: 15px;
        }

        .summary-total {
            border-top: 1px solid #dfe8df;
            margin-top: 20px;
            padding-top: 18px;
            display: flex;
            justify-content: space-between;
            font-size: 20px;
            font-weight: 700;
        }

        .place-order {
            width: 100%;
            border: none;
            background: #2e7d32;
            color: #ffffff;
            padding: 14px;
            border-radius: 9px;
            margin-top: 25px;
            font-size: 15px;
            font-weight: 700;
            cursor: pointer;
        }

        .place-order:hover {
            background: #256b29;
        }

        .message {
            background: #e8f5e9;
            color: #2e7d32;
            border: 1px solid #c8e6c9;
            padding: 12px 15px;
            border-radius: 8px;
            margin-bottom: 20px;
        }

        .error {
            background: #ffebee;
            color: #c62828;
            border: 1px solid #ffcdd2;
            padding: 12px 15px;
            border-radius: 8px;
            margin-bottom: 20px;
        }

        .empty-cart {
            text-align: center;
            padding: 30px 10px;
            color: #68756b;
        }

        @media (max-width: 800px) {
            .checkout-layout {
                grid-template-columns: 1fr;
            }

            .navbar {
                padding: 0 20px;
            }

            .container {
                margin: 30px auto;
            }
        }
    </style>
</head>

<body>

<nav class="navbar">
    <div class="logo">eGreen Basket</div>

    <a href="{{ route('customer.cart') }}" class="back">
        <i class="fa-solid fa-arrow-left"></i>
        Back to Cart
    </a>
</nav>

<div class="container">

    <h1>Checkout</h1>

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

    @if($errors->any())
        <div class="error">
            {{ $errors->first() }}
        </div>
    @endif

    @if($cartItems->count() > 0)

        <div class="checkout-layout">

            <div class="box">

                <h2>Delivery Information</h2>

                <form action="{{ route('customer.order.place') }}" method="POST">
                    @csrf

                    <div class="form-group">
                        <label for="shipping_address">Shipping Address</label>

                        <textarea
                            id="shipping_address"
                            name="shipping_address"
                            placeholder="Enter your complete address"
                            required
                        ></textarea>
                    </div>

                    <div class="form-group">
                        <label for="phone">Phone Number</label>

                        <input
                            id="phone"
                            type="text"
                            name="phone"
                            placeholder="Enter your phone number"
                            required
                        >
                    </div>

                    <div class="form-group">
                        <label for="payment_method">Payment Method</label>

                        <select
                            id="payment_method"
                            name="payment_method"
                            required
                        >
                            <option value="">Select Payment Method</option>
                            <option value="Cash on Delivery">
                                Cash on Delivery
                            </option>
                        </select>
                    </div>

                    <button type="submit" class="place-order">
                        <i class="fa-solid fa-check"></i>
                        Place Order
                    </button>

                </form>

            </div>

            <div class="box">

                <h2>Order Summary</h2>

                @foreach($cartItems as $item)

                    <div class="summary-item">

                        <span>
                            {{ $item->product->name }}
                            × {{ $item->quantity }}
                        </span>

                        <span>
                            Rs. {{ number_format($item->product->price * $item->quantity, 2) }}
                        </span>

                    </div>

                @endforeach

                <div class="summary-total">
                    <span>Total</span>

                    <span>
                        Rs. {{ number_format($total, 2) }}
                    </span>
                </div>

            </div>

        </div>

    @else

        <div class="box empty-cart">
            <i class="fa-solid fa-cart-shopping"></i>

            <h2>Your cart is empty</h2>

            <p>Add some products before checkout.</p>
        </div>

    @endif

</div>

</body>
</html>
