<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shopping Cart - eGreen Basket</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <style>
        :root {
            --bg-main: #edf5ee;
            --bg-card: #ffffff;
            --bg-soft: #edf4ee;
            --text-main: #1f3128;
            --text-secondary: #586d5d;
            --primary: #2a8c54;
            --primary-dark: #1f6d43;
            --primary-light: #dfeee2;
            --border: #d7e4d9;
            --danger: #d9484a;
            --shadow: 0 14px 30px rgba(35, 98, 62, 0.08);
        }

        * { box-sizing: border-box; }

        body {
            background: linear-gradient(180deg, #f3f7f2 0%, #edf6ee 100%);
            color: var(--text-main);
            min-height: 100vh;
            font-family: Arial, sans-serif;
        }

        .navbar {
            max-width: 1100px;
            background: rgba(255,255,255,0.9);
            border: 1px solid var(--border);
            border-radius: 16px;
            box-shadow: var(--shadow);
            backdrop-filter: blur(8px);
        }

        .panel {
            background: linear-gradient(180deg, #ffffff 0%, #f9fbf9 100%);
            border: 1px solid var(--border);
            border-radius: 16px;
            box-shadow: var(--shadow);
            transition: transform 0.25s ease, box-shadow 0.25s ease;
        }

        .panel:hover {
            transform: translateY(-3px);
            box-shadow: 0 18px 34px rgba(42, 140, 84, 0.1);
        }

        .text-green {
            color: var(--primary-dark);
        }

        .btn-green {
            color: #fff;
            background: linear-gradient(135deg, var(--primary), var(--primary-dark));
            border: none;
            border-radius: 12px;
            font-weight: 700;
            padding: 12px 16px;
            transition: all 0.25s ease;
        }

        .btn-green:hover {
            color: #fff;
            background: linear-gradient(135deg, var(--primary-dark), var(--primary));
            transform: translateY(-2px);
            box-shadow: 0 14px 24px rgba(31, 109, 67, 0.18);
        }

        .product-image {
            width: 78px;
            height: 78px;
            object-fit: cover;
            border-radius: 12px;
            border: 1px solid var(--border);
            box-shadow: 0 10px 18px rgba(35, 98, 62, 0.08);
        }

        .cart-item {
            border: 1px solid var(--border);
            border-radius: 16px;
            background: linear-gradient(180deg, #fff, #f9fbf9);
            box-shadow: var(--shadow);
            gap: 16px;
            padding: 18px 18px;
        }

        .cart-item h2 {
            font-size: 1.1rem;
            font-weight: 700;
            color: var(--text-main);
        }

        .cart-item .text-muted {
            color: var(--text-secondary) !important;
            font-size: 0.95rem;
        }

        .summary-box {
            padding: 22px 18px;
            border-radius: 16px;
        }

        .summary-box h2 {
            font-size: 1.7rem;
            font-weight: 700;
            margin-bottom: 16px;
            color: var(--text-main);
        }

        .summary-total {
            border-top: 1px solid var(--border);
            padding-top: 16px;
            margin-top: 12px;
            margin-bottom: 18px;
            font-size: 1.1rem;
        }

        .summary-total strong {
            color: var(--text-main);
        }

        .summary-total .text-green {
            font-size: 1.35rem;
        }

        .btn-remove {
            border: 1px solid rgba(217, 72, 74, 0.4);
            background: #fff7f7;
            color: var(--danger);
            border-radius: 10px;
            padding: 8px 10px;
            transition: all 0.2s ease;
        }

        .btn-remove:hover {
            background: var(--danger);
            color: #fff;
            border-color: var(--danger);
        }

        .empty-box {
            border-radius: 18px;
            background: linear-gradient(180deg, #ffffff 0%, #f8fbf8 100%);
            border: 1px solid var(--border);
            box-shadow: var(--shadow);
        }
    </style>
</head>
<body>
    <nav class="navbar mx-auto mt-3 px-3 py-2" style="max-width: 1100px">
        <x-brand-logo :href="route('products.index')" class="navbar-brand" />
        <a class="btn btn-outline-success btn-sm" href="{{ route('products.index') }}">Continue Shopping</a>
    </nav>
    <main class="container py-4" style="max-width: 1100px">
        <h1 class="h3 mb-4">Shopping Cart</h1>
        @if(session('success')) <div class="alert alert-success">{{ session('success') }}</div> @endif
        @if(session('error')) <div class="alert alert-danger">{{ session('error') }}</div> @endif
        @if($cartItems->isNotEmpty())
            <div class="row g-4">
                <section class="col-lg-8">
                    @foreach($cartItems as $item)
                        <div class="panel cart-item mb-3 d-flex align-items-center">
                            @if($item['image'])
                                <img class="product-image" src="{{ asset('storage/' . $item['image']) }}" alt="{{ $item['name'] }}">
                            @else
                                <div class="product-image bg-light d-flex align-items-center justify-content-center"><i class="bi bi-leaf text-green"></i></div>
                            @endif
                            <div class="flex-grow-1">
                                <h2 class="mb-1">{{ $item['name'] }}</h2>
                                <div class="text-muted">Rs. {{ number_format($item['price'], 2) }} x {{ $item['quantity'] }}</div>
                            </div>
                            <strong class="text-green">Rs. {{ number_format($item['price'] * $item['quantity'], 2) }}</strong>
                            <form action="{{ route('customer.cart.remove', $item['id']) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-remove btn-sm" aria-label="Remove {{ $item['name'] }}"><i class="bi bi-trash"></i></button>
                            </form>
                        </div>
                    @endforeach
                </section>
                <aside class="col-lg-4">
                    <div class="panel summary-box">
                        <h2>Order Summary</h2>
                        <div class="summary-total d-flex justify-content-between align-items-center">
                            <strong>Total</strong>
                            <strong class="text-green">Rs. {{ number_format($total, 2) }}</strong>
                        </div>
                        <a class="btn btn-green w-100" href="{{ route('customer.checkout') }}">Proceed to Checkout</a>
                    </div>
                </aside>
            </div>
        @else
            <div class="panel empty-box text-center p-5">
                <i class="bi bi-cart3 text-green fs-1"></i>
                <h2 class="h5 mt-3">Your cart is empty</h2>
                <a class="btn btn-green mt-2" href="{{ route('products.index') }}">Browse Products</a>
            </div>
        @endif
    </main>
</body>
</html>
