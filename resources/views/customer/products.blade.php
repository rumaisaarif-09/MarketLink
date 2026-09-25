<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>eGreen Basket - Products</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">

    <!-- eGreen Basket Theme Styling -->
    <style>
        :root {
            --bg-color: #F3F7F2;
            --card-bg: #FFFFFF;
            --primary-green: #588157;
            --text-color: #263328;
            --hover-green: #466745;
        }

        body {
            background-color: var(--bg-color);
            color: var(--text-color);
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        /* Navbar Theme */
        .navbar-custom {
            background-color: var(--card-bg);
            border-bottom: 1px solid #e0e0e0;
        }

        /* Theme Cards */
        .card-custom {
            background-color: var(--card-bg);
            border: none;
            border-radius: 12px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.03);
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }

        .card-custom:hover {
            transform: translateY(-3px);
            box-shadow: 0 6px 16px rgba(0, 0, 0, 0.06);
        }

        /* Dynamic Green Buttons */
        .btn-green {
            background-color: var(--primary-green) !important;
            color: #ffffff !important;
            border: none !important;
            border-radius: 8px;
            font-weight: 500;
        }

        .btn-green:hover {
            background-color: var(--hover-green) !important;
            color: #ffffff !important;
        }

        .btn-outline-green {
            color: var(--primary-green) !important;
            border: 1px solid var(--primary-green) !important;
            border-radius: 8px;
        }

        .btn-outline-green:hover {
            background-color: var(--primary-green) !important;
            color: #ffffff !important;
        }

        .text-green {
            color: var(--primary-green) !important;
        }

        /* Form Inputs Customization */
        .form-control, .form-select, .input-group-text {
            border-radius: 8px;
            border: 1px solid #dcdcdc;
        }

        .form-control:focus, .form-select:focus {
            border-color: var(--primary-green);
            box-shadow: 0 0 0 0.25rem rgba(88, 129, 87, 0.25);
        }
    </style>
</head>

<body>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-custom px-4 py-3 mb-4">
        <div class="container-fluid">
            <a class="navbar-brand fw-bold fs-4 text-green" href="{{ route('products.index') }}">eGreen Basket</a>
            <div>
                <a href="{{ route('cart.index') }}" class="btn btn-outline-green position-relative">
                    <i class="bi bi-cart3"></i> View Cart
                    @if(session('cart'))
                        <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                            {{ count(session('cart')) }}
                        </span>
                    @endif
                </a>
            </div>
        </div>
    </nav>

    <div class="container py-2">

        <!-- Flash Messages -->
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show border-0 shadow-sm" role="alert" style="border-radius: 10px;">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show border-0 shadow-sm" role="alert" style="border-radius: 10px;">
                {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        <!-- Search Bar & Reset Section -->
        <div class="card card-custom p-3 mb-4">
            <form action="{{ route('products.index') }}" method="GET" class="row g-3">

                <!-- Search Input -->
                <div class="col-md-5">
                    <input type="text" name="search" class="form-control" placeholder="Search products by name..." value="{{ request('search') }}">
                </div>

                <!-- Category Filter Dropdown -->
                <div class="col-md-4">
                    <select name="category_id" class="form-select">
                        <option value="">All Categories</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}" {{ request('category_id') == $category->id ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- Search Filter & Reset Buttons -->
                <div class="col-md-3 d-flex gap-2">
                    <button type="submit" class="btn btn-green w-100">
                        <i class="bi bi-search"></i> Search
                    </button>
                    <!-- Reset Button -->
                    <a href="{{ route('products.index') }}" class="btn btn-outline-secondary" style="border-radius: 8px;">
                        Reset
                    </a>
                </div>

            </form>
        </div>

        <!-- Products Grid -->
        <h3 class="mb-4 fw-bold text-green">Products List</h3>

        <div class="row">
            @forelse($products as $product)
                <div class="col-md-3 col-sm-6 mb-4">
                    <div class="card card-custom h-100 overflow-hidden">
                        <!-- Product Image -->
                        @if($product->image)
                            <img src="{{ asset('storage/' . $product->image) }}" class="card-img-top" style="height: 180px; object-fit: cover;" alt="{{ $product->name }}">
                        @else
                            <div class="bg-light text-muted text-center py-5 d-flex align-items-center justify-content-center" style="height: 180px;">
                                <i class="bi bi-image fs-1 me-2"></i> No Image
                            </div>
                        @endif

                        <div class="card-body d-flex flex-column">
                            <h5 class="card-title text-truncate fw-bold mb-1">{{ $product->name }}</h5>
                            <p class="card-text text-green fw-bold fs-5 mb-3">Rs. {{ number_format($product->price, 2) }}</p>

                            <!-- Add To Cart Form -->
                            <form action="{{ route('cart.add', $product->id) }}" method="POST" class="mt-auto">
                                @csrf
                                <div class="input-group mb-2">
                                    <span class="input-group-text bg-light text-muted">Qty</span>
                                    <input type="number" name="quantity" value="1" min="1" class="form-control text-center">
                                </div>
                                <button type="submit" class="btn btn-green w-100">
                                    <i class="bi bi-bag-plus"></i> Add to Cart
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12 text-center py-5 card card-custom">
                    <i class="bi bi-basket text-muted" style="font-size: 3.5rem;"></i>
                    <p class="fs-4 text-muted mt-3 mb-0">No products found!</p>
                </div>
            @endforelse
        </div>

        <!-- Pagination -->
        <div class="d-flex justify-content-center mt-3">
            {{ $products->links() }}
        </div>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>