<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Customer Dashboard | eGreen Basket</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        html {
            scroll-behavior: smooth;
        }

        body {
            font-family: Arial, sans-serif;
            background:
                radial-gradient(circle at top left, rgba(47, 143, 87, 0.12), transparent 22%),
                linear-gradient(180deg, #eefaf1 0%, #f8fbf9 100%);
            color: #18241c;
            transition: 0.3s ease;
        }

        .navbar {
            height: 76px;
            padding: 0 55px;
            background: linear-gradient(135deg, rgba(255,255,255,0.98), rgba(223,246,230,0.94));
            border-bottom: 1px solid #d9e9dc;
            display: flex;
            align-items: center;
            justify-content: space-between;
            position: sticky;
            top: 0;
            z-index: 1000;
            backdrop-filter: blur(12px);
            box-shadow: 0 8px 24px rgba(25, 84, 53, 0.08);
        }

  
.brand {
    display: flex;
    align-items: center;
    text-decoration: none;
}

.brand img {
    width: 150px;
    height: auto;
    display: block;
}

        .logo {
            display: flex;
            align-items: center;
            gap: 11px;
            color: #24752c;
            font-size: 22px;
            font-weight: 800;
        }

        .logo-icon {
            width: 38px;
            height: 38px;
            border-radius: 12px;
            background: #e8f6e8;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #2e7d32;
        }

        .nav-links {
            display: flex;
            align-items: center;
            gap: 30px;
        }

        .nav-link {
            color: #536158;
            text-decoration: none;
            font-size: 14px;
            font-weight: 700;
            transition: 0.25s ease;
            padding: 10px 13px;
            border-radius: 10px;
        }

        .nav-link:hover,
        .nav-link.active {
            color: #1f6d44;
            background: linear-gradient(135deg, #def6e6, rgba(188, 235, 207, 0.8));
            box-shadow: inset 0 0 0 1px rgba(47, 143, 87, 0.06);
        }

        .cart-link {
            display: flex;
            align-items: center;
            gap: 8px;
            padding: 10px 15px;
            border-radius: 10px;
            background: linear-gradient(135deg, #def6e6, #eefaf2);
            color: #1f6d44;
            text-decoration: none;
            font-size: 14px;
            font-weight: 700;
            transition: 0.25s ease;
            box-shadow: 0 10px 18px rgba(47, 143, 87, 0.06);
        }

        .cart-link:hover {
            background: linear-gradient(135deg, #2f8f57, #1f6d44);
            color: #ffffff;
            transform: translateY(-2px);
        }

        .theme-btn {
            border: 1px solid #dce6dc;
            background: linear-gradient(135deg, #edf7ee, #ffffff);
            color: #425247;
            padding: 9px 13px;
            border-radius: 10px;
            cursor: pointer;
            font-size: 13px;
            transition: 0.25s ease;
            box-shadow: 0 10px 18px rgba(47, 143, 87, 0.06);
        }

        .theme-btn:hover {
            background: linear-gradient(135deg, #2f8f57, #1f6d44);
            border-color: transparent;
            color: #ffffff;
            transform: translateY(-2px);
        }

        .container {
            max-width: 1380px;
            margin: auto;
            padding: 42px 35px 70px;
        }

        .hero {
            min-height: 350px;
            border-radius: 28px;
            padding: 55px;
            display: flex;
            align-items: center;
            position: relative;
            overflow: hidden;
            background:
                radial-gradient(circle at 90% 15%, rgba(255,255,255,0.18), transparent 30%),
                linear-gradient(125deg, #185d24, #2f8b38 55%, #55a958);
            color: #ffffff;
            box-shadow: 0 20px 50px rgba(34, 100, 42, 0.18);
            margin-bottom: 55px;
        }

        .hero-content {
            max-width: 650px;
            position: relative;
            z-index: 2;
        }

        .hero-label {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            background: rgba(255,255,255,0.14);
            border: 1px solid rgba(255,255,255,0.2);
            padding: 8px 13px;
            border-radius: 30px;
            font-size: 12px;
            font-weight: 700;
            margin-bottom: 20px;
        }

        .hero h1 {
            font-size: 48px;
            line-height: 1.1;
            letter-spacing: -1px;
            margin-bottom: 18px;
        }

        .hero p {
            max-width: 570px;
            font-size: 16px;
            line-height: 1.7;
            color: rgba(255,255,255,0.88);
        }

        .hero-shape {
            position: absolute;
            right: -70px;
            bottom: -100px;
            width: 330px;
            height: 330px;
            border-radius: 50%;
            background: rgba(255,255,255,0.08);
        }

        .hero-shape::after {
            content: "";
            position: absolute;
            width: 190px;
            height: 190px;
            border-radius: 50%;
            background: rgba(255,255,255,0.08);
            top: -80px;
            left: -80px;
        }

        .section-top {
            display: flex;
            align-items: flex-end;
            justify-content: space-between;
            margin-bottom: 25px;
        }

        .section-title small {
            color: #5e7163;
            font-size: 12px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 1.5px;
        }

        .section-title h2 {
            margin-top: 6px;
            font-size: 29px;
            letter-spacing: -0.5px;
        }

        .section-count {
            color: #718078;
            font-size: 13px;
        }

        .products-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 20px;
        }

        .product-card {
            background: linear-gradient(180deg, #ffffff 0%, #f8fcf9 100%);
            border: 1px solid #dfeae1;
            border-radius: 20px;
            overflow: hidden;
            text-decoration: none;
            color: inherit;
            transition: 0.3s ease;
            position: relative;
            box-shadow: 0 14px 32px rgba(26, 92, 54, 0.10);
        }

        .product-card:hover {
            transform: translateY(-6px);
            border-color: rgba(47, 143, 87, 0.38);
            box-shadow: 0 18px 38px rgba(26, 92, 54, 0.14);
        }

        .image-wrapper {
            height: 215px;
            position: relative;
            overflow: hidden;
            background: #edf5ed;
        }

        .product-image {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.45s ease;
        }

        .product-card:hover .product-image {
            transform: scale(1.05);
        }

        .no-image {
            width: 100%;
            height: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #6b7e6d;
            font-size: 42px;
        }

        .category {
            position: absolute;
            top: 14px;
            left: 14px;
            background: rgba(255,255,255,0.93);
            color: #1f6d44;
            padding: 7px 10px;
            border-radius: 8px;
            font-size: 10px;
            font-weight: 800;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            box-shadow: 0 8px 14px rgba(26, 92, 54, 0.08);
        }

        .product-content {
            padding: 19px;
        }

        .product-content h3 {
            font-size: 18px;
            margin-bottom: 8px;
        }

        .description {
            color: #748078;
            font-size: 13px;
            line-height: 1.55;
            min-height: 41px;
        }

        .product-bottom {
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-top: 1px solid #edf1ed;
            margin-top: 17px;
            padding-top: 15px;
        }

        .product-detail-link {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin: 0 0 17px;
            padding-top: 12px;
            border-top: 1px solid #edf1ed;
            color: #1f6d44;
            font-size: 12px;
            font-weight: 700;
        }

        .price {
            color: #1f6d44;
            font-size: 18px;
            font-weight: 800;
        }

        .stock {
            color: #7a877e;
            font-size: 11px;
            font-weight: 600;
        }

        .empty {
            background: #ffffff;
            border: 1px solid #e1eae1;
            border-radius: 20px;
            padding: 70px 30px;
            text-align: center;
            color: #718078;
        }

        .empty i {
            font-size: 45px;
            color: #4c9954;
            margin-bottom: 18px;
        }

        .empty h3 {
            color: #253329;
            margin-bottom: 8px;
        }

        body.dark {
            background: #000000;
            color: #ffffff;
        }

        body.dark .navbar {
            background: linear-gradient(135deg, rgba(10, 20, 15, 0.97), rgba(18, 44, 33, 0.96));
            border-color: #214a39;
            box-shadow: 0 10px 28px rgba(0, 0, 0, 0.24);
        }

        body.dark .logo {
            color: #7bd88f;
        }

        body.dark .logo-icon {
            background: #151f16;
            color: #7bd88f;
        }

        body.dark .nav-link {
            color: #bdbdbd;
        }

        body.dark .nav-link:hover,
        body.dark .nav-link.active {
            color: #7bd88f;
        }

        body.dark .cart-link {
            background: #121d14;
            color: #7bd88f;
        }

        body.dark .theme-btn {
            background: #0b0b0b;
            border-color: #292929;
            color: #cccccc;
        }

        body.dark .section-title small,
        body.dark .section-count {
            color: #999999;
        }

        body.dark .product-card,
        body.dark .empty {
            background: linear-gradient(180deg, #0d1d15 0%, #0b120e 100%);
            border-color: #214a39;
        }

        body.dark .product-card:hover {
            border-color: rgba(76, 208, 122, 0.4);
            box-shadow: 0 18px 40px rgba(0,0,0,0.35);
        }

        body.dark .image-wrapper,
        body.dark .no-image {
            background: #151515;
        }

        body.dark .description,
        body.dark .stock {
            color: #999999;
        }

        body.dark .product-bottom {
            border-color: #242424;
        }

        body.dark .price {
            color: #7bd88f;
        }

        body.dark .empty h3 {
            color: #ffffff;
        }

        @media (max-width: 1100px) {
            .products-grid {
                grid-template-columns: repeat(3, 1fr);
            }

            .hero h1 {
                font-size: 42px;
            }
        }

        @media (max-width: 850px) {
            .navbar {
                padding: 0 22px;
            }

            .nav-links {
                gap: 15px;
            }

            .container {
                padding: 30px 20px 60px;
            }

            .products-grid {
                grid-template-columns: repeat(2, 1fr);
            }

            .hero {
                padding: 42px;
            }
        }

        @media (max-width: 600px) {
            .navbar {
                height: auto;
                padding: 16px;
                flex-wrap: wrap;
                gap: 15px;
            }

            .nav-links {
                order: 3;
                width: 100%;
                justify-content: center;
                flex-wrap: wrap;
            }

            .hero {
                min-height: 310px;
                padding: 32px 25px;
            }

            .hero h1 {
                font-size: 34px;
            }

            .products-grid {
                grid-template-columns: 1fr;
            }

            .section-top {
                align-items: flex-start;
                gap: 10px;
                flex-direction: column;
            }
        }
    </style>
</head>

<body>

<nav class="navbar">

<x-brand-logo :href="route('customer.dashboard')" class="brand" />


    <div class="nav-links">

        <a href="{{ route('customer.dashboard') }}" class="nav-link active">
            Home
        </a>

        <a href="#products" class="nav-link">
            Products
        </a>

        <a href="{{ route('customer.orders') }}" class="nav-link">
            My Orders
        </a>

        <a href="{{ route('customer.cart') }}" class="cart-link">
            <i class="fa-solid fa-cart-shopping"></i>
            Cart
        </a>

        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button class="theme-btn" type="submit">Sign Out</button>
        </form>

    </div>

    <button class="theme-btn" onclick="toggleTheme()">
        <i class="fa-solid fa-moon"></i>
        Dark
    </button>

</nav>

<div class="container">

    <section class="hero">

        <div class="hero-content">

            <div class="hero-label">
                <i class="fa-solid fa-seedling"></i>
                Fresh • Local • Quality
            </div>

            <h1>Fresh food,<br>straight from farmers.</h1>

            <p>
                Discover quality vegetables, fruits, grains and organic products
                brought to you through eGreen Basket.
            </p>

        </div>

        <div class="hero-shape"></div>

    </section>

    <div class="section-top" id="products">

        <div class="section-title">
            <small>Shop fresh</small>
            <h2>Available Products</h2>
        </div>

        <div class="section-count">
            {{ $products->count() }} products available
        </div>

    </div>

    @if($products->count() > 0)

        <div class="products-grid">

            @foreach($products as $product)

                <a href="{{ route('customer.product', $product->id) }}" class="product-card">

                    <div class="image-wrapper">

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

                        <span class="category">
                            {{ $product->category->name ?? 'General' }}
                        </span>

                    </div>

                    <div class="product-content">

                        <h3>{{ $product->name }}</h3>

                        <p class="description">
                            {{ $product->description ?? 'Fresh quality food product.' }}
                        </p>

                        <div class="product-bottom">

                            <span class="price">
                                Rs. {{ number_format($product->price, 2) }}
                            </span>

                            <span class="stock">
                                {{ $product->stock }} in stock
                            </span>

                        </div>

                        <div class="product-detail-link">
                            View product
                            <i class="fa-solid fa-arrow-right" aria-hidden="true"></i>
                        </div>

                    </div>

                </a>

            @endforeach

        </div>

    @else

        <div class="empty">

            <i class="fa-solid fa-basket-shopping"></i>

            <h3>No products available</h3>

            <p>Approved products will appear here.</p>

        </div>

    @endif

</div>

<script>
    function toggleTheme() {
        document.body.classList.toggle("dark");

        if (document.body.classList.contains("dark")) {
            localStorage.setItem("egreen-theme", "dark");
        } else {
            localStorage.setItem("egreen-theme", "light");
        }
    }

    if (localStorage.getItem("egreen-theme") === "dark") {
        document.body.classList.add("dark");
    }
</script>

</body>
</html>
