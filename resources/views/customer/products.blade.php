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

        .catalog-product {
            border: 1px solid #dce5dc;
            border-radius: 7px;
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }

        .catalog-product:hover {
            transform: translateY(-4px);
            box-shadow: 0 14px 26px rgba(38, 67, 43, 0.12);
        }

        .catalog-image-wrap {
            position: relative;
            overflow: hidden;
            background: #e8eee5;
        }

        .catalog-image {
            width: 100%;
            aspect-ratio: 4 / 3;
            object-fit: cover;
            transition: transform 0.35s ease;
        }

        .catalog-product:hover .catalog-image {
            transform: scale(1.04);
        }

        .catalog-category {
            position: absolute;
            top: 12px;
            left: 12px;
            padding: 6px 9px;
            color: #28613b;
            background: rgba(255, 255, 255, 0.95);
            border: 1px solid #dce5dc;
            border-radius: 4px;
            font-size: 10px;
            font-weight: 700;
            text-transform: uppercase;
        }

        .catalog-price {
            color: #b6543b;
            font-size: 19px;
            font-weight: 700;
        }

        .catalog-stock {
            color: #627267;
            font-size: 12px;
        }

        .catalog-action {
            margin-top: auto;
            padding-top: 14px;
            border-top: 1px solid #edf1ed;
        }

        .catalog-pagination {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 18px;
            margin: 12px 0 44px;
            padding: 16px 0;
            border-top: 1px solid #dce5dc;
        }

        .pagination-summary {
            color: #627267;
            font-size: 13px;
        }

        .pagination-summary strong {
            color: #263328;
        }

        .pagination-controls,
        .pagination-pages {
            display: flex;
            align-items: center;
            gap: 6px;
            margin: 0;
            padding: 0;
            list-style: none;
        }

        .pagination-link,
        .pagination-current,
        .pagination-disabled,
        .pagination-ellipsis {
            min-width: 38px;
            height: 38px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            padding: 0 10px;
            border: 1px solid #dce5dc;
            border-radius: 5px;
            color: #33473a;
            background: #fff;
            font-size: 13px;
            font-weight: 600;
            text-decoration: none;
        }

        .pagination-link:hover {
            color: #fff;
            background: #28613b;
            border-color: #28613b;
        }

        .pagination-current {
            color: #fff;
            background: #28613b;
            border-color: #28613b;
        }

        .pagination-disabled,
        .pagination-ellipsis {
            color: #9aa49b;
            background: transparent;
            border-color: transparent;
        }

        .pagination-step { gap: 7px; padding-inline: 12px; }

        @media (max-width: 575.98px) {
            .catalog-pagination { align-items: flex-start; flex-direction: column; }
            .pagination-controls { width: 100%; justify-content: space-between; gap: 3px; }
            .pagination-link, .pagination-current, .pagination-disabled, .pagination-ellipsis { min-width: 34px; height: 36px; padding-inline: 8px; }
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
            <x-brand-logo :href="route('products.index')" class="navbar-brand" />
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
                <div class="col-md-3">
                    <select name="category_id" class="form-select">
                        <option value="">All Categories</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}" {{ request('category_id') == $category->id ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-2">
                    <select name="market" class="form-select">
                        <option value="">All Markets</option>
                        @foreach($markets as $market)
                            <option value="{{ $market->id }}" {{ request('market') == $market->id ? 'selected' : '' }}>
                                {{ $market->market_name ?: $market->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-2">
                    <select name="day" class="form-select">
                        <option value="">All Days</option>
                        @foreach(['Monday','Tuesday','Wednesday','Thursday','Friday','Saturday','Sunday'] as $day)
                            <option value="{{ $day }}" {{ request('day') == $day ? 'selected' : '' }}>{{ $day }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-2">
                    <input type="number" step="0.01" min="0" name="price_min" class="form-control" placeholder="Min price" value="{{ request('price_min') }}">
                </div>

                <div class="col-md-2">
                    <input type="number" step="0.01" min="0" name="price_max" class="form-control" placeholder="Max price" value="{{ request('price_max') }}">
                </div>

                <!-- Search Filter & Reset Buttons -->
                <div class="col-md-1 d-flex gap-2">
                    <button type="submit" class="btn btn-green w-100">
                        <i class="bi bi-search"></i>
                    </button>
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
                <div class="col-lg-4 col-md-6 col-sm-6 mb-4">
                    <div class="card card-custom catalog-product h-100 overflow-hidden">
                        <!-- Product Image -->
                        <div class="catalog-image-wrap">
                            @if($product->image)
                                <img src="{{ asset('storage/' . $product->image) }}" class="catalog-image" alt="{{ $product->name }}">
                            @else
                                <div class="catalog-image bg-light text-muted d-flex align-items-center justify-content-center"><i class="bi bi-leaf fs-1"></i></div>
                            @endif
                            <span class="catalog-category">{{ $product->category->name ?? 'Produce' }}</span>
                        </div>

                        <div class="card-body d-flex flex-column">
                            <h5 class="card-title fw-bold mb-2">{{ $product->name }}</h5>
                            <p class="catalog-stock mb-1">{{ $product->stock }} in stock</p>
                            <p class="catalog-price mb-3">Rs. {{ number_format($product->price, 2) }}</p>

                            <!-- Add To Cart Form -->
                            <form action="{{ route('cart.add', $product->id) }}" method="POST" class="catalog-action">
                                @csrf
                                <div class="input-group mb-2">
                                    <span class="input-group-text bg-light text-muted">Qty</span>
                                    <input type="number" name="quantity" value="1" min="1" class="form-control text-center">
                                </div>
                                <div class="d-flex gap-2 mb-2">
                                    <button type="submit" class="btn btn-green flex-grow-1" @disabled($product->stock < 1)>
                                        <i class="bi bi-bag-plus"></i> Add to Cart
                                    </button>
                                    <button type="submit" class="btn btn-outline-success" title="Favorite this product" form="favorite-product-{{ $product->id }}">
                                        <i class="bi bi-heart"></i>
                                    </button>
                                </div>
                            </form>
                            <form id="favorite-product-{{ $product->id }}" action="{{ route('favorites.toggle', ['type' => 'product', 'id' => $product->id]) }}" method="POST" class="d-none">
                                @csrf
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

        @if($products->lastPage() > 1)
            @php
                $startPage = max(1, $products->currentPage() - 2);
                $endPage = min($products->lastPage(), $products->currentPage() + 2);
            @endphp
            <nav class="catalog-pagination" aria-label="Product pages">
                <p class="pagination-summary mb-0">
                    Showing <strong>{{ $products->firstItem() }}–{{ $products->lastItem() }}</strong>
                    of <strong>{{ $products->total() }}</strong> products
                </p>
                <div class="pagination-controls">
                    @if($products->onFirstPage())
                        <span class="pagination-disabled pagination-step" aria-disabled="true">
                            <i class="bi bi-arrow-left" aria-hidden="true"></i>
                            <span class="d-none d-sm-inline">Previous</span>
                        </span>
                    @else
                        <a class="pagination-link pagination-step" href="{{ $products->previousPageUrl() }}" rel="prev" aria-label="Previous page">
                            <i class="bi bi-arrow-left" aria-hidden="true"></i>
                            <span class="d-none d-sm-inline">Previous</span>
                        </a>
                    @endif

                    <ul class="pagination-pages">
                        @if($startPage > 1)
                            <li><a class="pagination-link" href="{{ $products->url(1) }}" aria-label="Page 1">1</a></li>
                            @if($startPage > 2)<li><span class="pagination-ellipsis" aria-hidden="true">…</span></li>@endif
                        @endif

                        @foreach(range($startPage, $endPage) as $page)
                            <li>
                                @if($page === $products->currentPage())
                                    <span class="pagination-current" aria-current="page">{{ $page }}</span>
                                @else
                                    <a class="pagination-link" href="{{ $products->url($page) }}" aria-label="Page {{ $page }}">{{ $page }}</a>
                                @endif
                            </li>
                        @endforeach

                        @if($endPage < $products->lastPage())
                            @if($endPage < $products->lastPage() - 1)<li><span class="pagination-ellipsis" aria-hidden="true">…</span></li>@endif
                            <li><a class="pagination-link" href="{{ $products->url($products->lastPage()) }}" aria-label="Page {{ $products->lastPage() }}">{{ $products->lastPage() }}</a></li>
                        @endif
                    </ul>

                    @if($products->hasMorePages())
                        <a class="pagination-link pagination-step" href="{{ $products->nextPageUrl() }}" rel="next" aria-label="Next page">
                            <span class="d-none d-sm-inline">Next</span>
                            <i class="bi bi-arrow-right" aria-hidden="true"></i>
                        </a>
                    @else
                        <span class="pagination-disabled pagination-step" aria-disabled="true">
                            <span class="d-none d-sm-inline">Next</span>
                            <i class="bi bi-arrow-right" aria-hidden="true"></i>
                        </span>
                    @endif
                </div>
            </nav>
        @endif

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>