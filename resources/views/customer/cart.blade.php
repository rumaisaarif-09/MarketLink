<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shopping Cart - eGreen Basket</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <style>
        body { background: #f3f7f2; color: #263328; }
        .navbar, .panel { background: #fff; border: 1px solid #e0e8df; border-radius: 8px; }
        .text-green { color: #47734b; }
        .btn-green { color: #fff; background: #47734b; }
        .btn-green:hover { color: #fff; background: #365c3a; }
        .product-image { width: 72px; height: 72px; object-fit: cover; border-radius: 6px; }
    </style>
</head>
<body>
    <nav class="navbar mx-auto mt-3 px-3 py-2" style="max-width: 1100px">
        <a class="navbar-brand fw-bold text-green" href="{{ route('products.index') }}">eGreen Basket</a>
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
                        <div class="panel p-3 mb-3 d-flex align-items-center gap-3">
                            @if($item['image'])
                                <img class="product-image" src="{{ asset('storage/' . $item['image']) }}" alt="{{ $item['name'] }}">
                            @else
                                <div class="product-image bg-light d-flex align-items-center justify-content-center"><i class="bi bi-leaf text-green"></i></div>
                            @endif
                            <div class="flex-grow-1">
                                <h2 class="h6 mb-1">{{ $item['name'] }}</h2>
                                <div class="text-muted">Rs. {{ number_format($item['price'], 2) }} x {{ $item['quantity'] }}</div>
                            </div>
                            <strong class="text-green">Rs. {{ number_format($item['price'] * $item['quantity'], 2) }}</strong>
                            <form action="{{ route('customer.cart.remove', $item['id']) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-outline-danger btn-sm" aria-label="Remove {{ $item['name'] }}"><i class="bi bi-trash"></i></button>
                            </form>
                        </div>
                    @endforeach
                </section>
                <aside class="col-lg-4">
                    <div class="panel p-3">
                        <h2 class="h5">Order Summary</h2>
                        <div class="d-flex justify-content-between border-top pt-3 mt-3 mb-3">
                            <strong>Total</strong><strong class="text-green">Rs. {{ number_format($total, 2) }}</strong>
                        </div>
                        <a class="btn btn-green w-100" href="{{ route('customer.checkout') }}">Proceed to Checkout</a>
                    </div>
                </aside>
            </div>
        @else
            <div class="panel text-center p-5">
                <i class="bi bi-cart3 text-green fs-1"></i>
                <h2 class="h5 mt-3">Your cart is empty</h2>
                <a class="btn btn-green mt-2" href="{{ route('products.index') }}">Browse Products</a>
            </div>
        @endif
    </main>
</body>
</html>
