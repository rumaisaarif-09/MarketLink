<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $product->name }} - eGreen Basket</title>

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
            margin: 50px auto;
            padding: 0 25px;
        }

        .success {
            background: #e8f5e9;
            color: #2e7d32;
            border: 1px solid #a5d6a7;
            padding: 14px 18px;
            border-radius: 10px;
            margin-bottom: 20px;
            font-weight: 600;
        }

        .product-detail {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 45px;
            background: #ffffff;
            border: 1px solid #dfe8df;
            border-radius: 20px;
            padding: 30px;
        }

        .product-image {
            width: 100%;
            height: 430px;
            object-fit: cover;
            border-radius: 15px;
            background: #edf4ed;
        }

        .no-image {
            height: 430px;
            border-radius: 15px;
            background: #edf4ed;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #2e7d32;
            font-size: 70px;
        }

        .category {
            color: #2e7d32;
            font-size: 13px;
            font-weight: 700;
            text-transform: uppercase;
        }

        h1 {
            font-size: 34px;
            margin: 12px 0 18px;
        }

        .description {
            color: #68756d;
            line-height: 1.7;
            margin-bottom: 25px;
        }

        .price {
            font-size: 28px;
            font-weight: 700;
            color: #2e7d32;
            margin-bottom: 12px;
        }

        .stock {
            color: #68756d;
            margin-bottom: 25px;
        }

        .cart-btn {
            border: none;
            background: #2e7d32;
            color: #ffffff;
            padding: 13px 25px;
            border-radius: 9px;
            font-size: 15px;
            font-weight: 700;
            cursor: pointer;
        }

        .cart-btn:hover {
            background: #256b29;
        }

        @media (max-width: 800px) {
            .product-detail {
                grid-template-columns: 1fr;
            }

            .product-image,
            .no-image {
                height: 320px;
            }

            .navbar {
                padding: 0 20px;
            }
        }
    </style>
</head>

<body>

<nav class="navbar">
    <div class="logo">eGreen Basket</div>

    <a href="{{ route('customer.dashboard') }}" class="back">
        <i class="fa-solid fa-arrow-left"></i>
        Back to Products
    </a>
</nav>

<div class="container">

    @if(session('success'))
        <div class="success">
            <i class="fa-solid fa-circle-check"></i>
            {{ session('success') }}
        </div>
    @endif

    <div class="product-detail">

        <div>
            @if($product->image)
                <img
                    src="{{ asset('storage/' . $product->image) }}"
                    alt="{{ $product->name }}"
                    class="product-image"
                >
            @else
                <div class="no-image">
                    <i class="fa-solid fa-leaf"></i>
                </div>
            @endif
        </div>

        <div>
            <span class="category">
                {{ $product->category->name ?? 'General' }}
            </span>

            <h1>{{ $product->name }}</h1>

            <p class="description">
                {{ $product->description ?? 'Fresh quality food product.' }}
            </p>

            <div class="price">
                Rs. {{ number_format($product->price, 2) }}
            </div>

            <div class="stock">
                Available Stock: {{ $product->stock }}
            </div>

            <form action="{{ route('customer.cart.add', $product->id) }}" method="POST">
                @csrf

                <button type="submit" class="cart-btn">
                    <i class="fa-solid fa-cart-shopping"></i>
                    Add to Cart
                </button>
            </form>
        </div>

    </div>

</div>

</body>
</html>
