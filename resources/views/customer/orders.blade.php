<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Orders - eGreen Basket</title>

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

        .order-card {
            background: #ffffff;
            border: 1px solid #dfe8df;
            border-radius: 16px;
            padding: 25px;
            margin-bottom: 20px;
        }

        .order-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-bottom: 1px solid #dfe8df;
            padding-bottom: 15px;
            margin-bottom: 20px;
        }

        .order-id {
            font-weight: 700;
            font-size: 18px;
        }

        .status {
            background: #fff3cd;
            color: #856404;
            padding: 7px 12px;
            border-radius: 20px;
            font-size: 13px;
            font-weight: 700;
            text-transform: capitalize;
        }

        .order-info {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 15px;
        }

        .info-box {
            background: #f7faf7;
            padding: 15px;
            border-radius: 10px;
        }

        .info-box span {
            display: block;
            color: #68756d;
            font-size: 13px;
            margin-bottom: 6px;
        }

        .info-box strong {
            font-size: 15px;
        }

        .total {
            color: #2e7d32;
            font-size: 18px;
        }

        .empty {
            background: #ffffff;
            border: 1px solid #dfe8df;
            border-radius: 16px;
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

        @media (max-width: 700px) {
            .navbar {
                padding: 0 20px;
            }

            .order-info {
                grid-template-columns: 1fr;
            }

            .order-header {
                gap: 15px;
                align-items: flex-start;
                flex-direction: column;
            }
        }
    </style>
</head>

<body>

<nav class="navbar">
    <div class="logo">eGreen Basket</div>

    <a href="{{ route('customer.dashboard') }}" class="back">
        <i class="fa-solid fa-arrow-left"></i>
        Back to Dashboard
    </a>
</nav>

<div class="container">

    <h1>My Orders</h1>

    @if($orders->count() > 0)

        @foreach($orders as $order)

            <div class="order-card">

                <div class="order-header">
                    <div class="order-id">
                        Order #{{ $order->id }}
                    </div>

                    <div class="status">
                        {{ $order->status }}
                    </div>
                </div>

                <div class="order-info">

                    <div class="info-box">
                        <span>Total Amount</span>
                        <strong class="total">
                            Rs. {{ number_format($order->total_amount, 2) }}
                        </strong>
                    </div>

                    <div class="info-box">
                        <span>Payment Method</span>
                        <strong>
                            {{ $order->payment_method }}
                        </strong>
                    </div>

                    <div class="info-box">
                        <span>Phone</span>
                        <strong>
                            {{ $order->phone }}
                        </strong>
                    </div>

                    <div class="info-box">
                        <span>Order Date</span>
                        <strong>
                            {{ $order->created_at->format('d M Y, h:i A') }}
                        </strong>
                    </div>

                    <div class="info-box">
                        <span>Shipping Address</span>
                        <strong>
                            {{ $order->shipping_address }}
                        </strong>
                    </div>

                </div>

            </div>

        @endforeach

    @else

        <div class="empty">

            <i class="fa-solid fa-box-open"></i>

            <h2>No Orders Yet</h2>

            <p>Your placed orders will appear here.</p>

            <a href="{{ route('customer.dashboard') }}" class="shop-btn">
                Start Shopping
            </a>

        </div>

    @endif

</div>

</body>
</html>
