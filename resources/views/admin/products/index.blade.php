<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Manage Products | eGreen Basket</title>

    <link
        rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"
    >

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: Arial, sans-serif;
        }

        :root {
            --bg-main: #f3f7f2;
            --bg-card: #ffffff;
            --bg-soft: #e9f0e7;
            --text-main: #263328;
            --text-secondary: #68746a;
            --primary: #588157;
            --primary-dark: #456a47;
            --primary-light: #dce8d9;
            --border: #d5dfd2;
            --danger: #c94c4c;
            --warning: #c58a24;
            --shadow: 0 8px 25px rgba(53, 78, 55, 0.08);
        }

        body.dark {
            --bg-main: #000000;
            --bg-card: #111111;
            --bg-soft: #181818;
            --text-main: #f5f5f5;
            --text-secondary: #a7a7a7;
            --primary: #588157;
            --primary-dark: #456a47;
            --primary-light: #263b29;
            --border: #292929;
            --danger: #ef6b6b;
            --warning: #e0a63b;
            --shadow: 0 12px 30px rgba(0, 0, 0, 0.45);
        }

        body {
            background: var(--bg-main);
            color: var(--text-main);
            min-height: 100vh;
            transition: 0.35s ease;
        }

        .navbar {
            min-height: 72px;
            padding: 0 5%;
            display: flex;
            align-items: center;
            justify-content: space-between;
            background: var(--bg-card);
            border-bottom: 1px solid var(--border);
        }

        .brand {
            text-decoration: none;
            color: var(--text-main);
        }

        .brand-name {
            font-size: 21px;
            font-weight: 800;
        }

        .brand-name span {
            color: var(--primary);
        }

        .nav-right {
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .nav-link,
        .theme-btn {
            text-decoration: none;
            color: var(--text-secondary);
            padding: 10px 13px;
            border-radius: 9px;
            font-size: 14px;
            font-weight: 700;
            border: 0;
            background: transparent;
            cursor: pointer;
            transition: 0.3s ease;
        }

        .nav-link:hover,
        .nav-link.active,
        .theme-btn:hover {
            color: var(--primary);
            background: var(--primary-light);
        }

        .container {
            width: 90%;
            max-width: 1250px;
            margin: 42px auto 60px;
        }

        .page-header {
            margin-bottom: 28px;
        }

        .page-header h1 {
            font-size: 34px;
            margin-bottom: 8px;
        }

        .page-header h1 span {
            color: var(--primary);
        }

        .page-header p {
            color: var(--text-secondary);
            font-size: 15px;
        }

        .success-message {
            margin-bottom: 20px;
            padding: 13px 16px;
            border: 1px solid rgba(88, 129, 87, 0.3);
            background: var(--primary-light);
            color: var(--primary);
            border-radius: 10px;
            font-size: 14px;
            font-weight: 700;
        }

        .table-card {
            background: var(--bg-card);
            border: 1px solid var(--border);
            border-radius: 18px;
            box-shadow: var(--shadow);
            overflow: hidden;
        }

        .table-top {
            padding: 20px 24px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-bottom: 1px solid var(--border);
        }

        .table-top h2 {
            font-size: 19px;
        }

        .count {
            color: var(--text-secondary);
            font-size: 13px;
        }

        .table-wrapper {
            overflow-x: auto;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            min-width: 1050px;
        }

        th {
            padding: 15px 18px;
            text-align: left;
            background: var(--bg-soft);
            color: var(--text-secondary);
            font-size: 12px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        td {
            padding: 16px 18px;
            border-top: 1px solid var(--border);
            color: var(--text-main);
            font-size: 14px;
        }

        tr:hover td {
            background: var(--bg-soft);
        }

        .product-info {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .product-image {
            width: 50px;
            height: 50px;
            border-radius: 10px;
            object-fit: cover;
            background: var(--bg-soft);
            border: 1px solid var(--border);
        }

        .no-image {
            width: 50px;
            height: 50px;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: var(--primary-light);
            color: var(--primary);
        }

        .product-name {
            font-weight: 700;
            margin-bottom: 4px;
        }

        .product-id {
            color: var(--text-secondary);
            font-size: 11px;
        }

        .category {
            display: inline-block;
            padding: 6px 10px;
            border-radius: 20px;
            background: var(--primary-light);
            color: var(--primary);
            font-size: 12px;
            font-weight: 700;
        }

        .status {
            display: inline-block;
            padding: 6px 10px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 700;
        }

        .status.pending {
            background: rgba(197, 138, 36, 0.15);
            color: var(--warning);
        }

        .status.approved {
            background: rgba(88, 129, 87, 0.15);
            color: var(--primary);
        }

        .status.rejected {
            background: rgba(201, 76, 76, 0.15);
            color: var(--danger);
        }

        .price {
            font-weight: 800;
            color: var(--primary);
        }

        .actions {
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .action-btn {
            border: 0;
            border-radius: 8px;
            padding: 8px 11px;
            font-size: 12px;
            font-weight: 700;
            cursor: pointer;
            transition: 0.3s ease;
        }

        .approve-btn {
            background: var(--primary-light);
            color: var(--primary);
        }

        .approve-btn:hover {
            background: var(--primary);
            color: #ffffff;
            transform: translateY(-2px);
        }

        .reject-btn {
            background: rgba(201, 76, 76, 0.12);
            color: var(--danger);
        }

        .reject-btn:hover {
            background: var(--danger);
            color: #ffffff;
            transform: translateY(-2px);
        }

        .action-done {
            color: var(--text-secondary);
            font-size: 12px;
            font-weight: 700;
        }

        .empty {
            padding: 55px 20px;
            text-align: center;
            color: var(--text-secondary);
        }

        .empty i {
            font-size: 38px;
            color: var(--primary);
            margin-bottom: 14px;
        }

        .empty h3 {
            color: var(--text-main);
            margin-bottom: 7px;
        }

        @media (max-width: 700px) {
            .navbar {
                padding: 12px 20px;
            }

            .nav-link {
                display: none;
            }

            .container {
                width: 92%;
                margin-top: 28px;
            }

            .page-header h1 {
                font-size: 28px;
            }

            .table-top {
                padding: 18px;
            }
        }
    </style>
</head>

<body>

    <nav class="navbar">

        <a href="{{ route('admin.dashboard') }}" class="brand">
            <div class="brand-name">
                eGreen <span>Basket</span>
            </div>
        </a>

        <div class="nav-right">

            <a href="{{ route('admin.dashboard') }}" class="nav-link">
                Dashboard
            </a>

            <a href="{{ route('admin.products') }}" class="nav-link active">
                Products
            </a>

            <button type="button" class="theme-btn" id="themeToggle">
                Dark Mode
            </button>

        </div>

    </nav>

    <main class="container">

        <section class="page-header">
            <h1>
                Manage <span>Products</span>
            </h1>

            <p>
                View and monitor all products added by farmers.
            </p>
        </section>

        @if(session('success'))

            <div class="success-message">
                <i class="fa-solid fa-circle-check"></i>
                {{ session('success') }}
            </div>

        @endif

        <section class="table-card">

            <div class="table-top">
                <h2>All Products</h2>

                <span class="count">
                    {{ $products->count() }} Products
                </span>
            </div>

            @if($products->count() > 0)

                <div class="table-wrapper">

                    <table>

                        <thead>

                            <tr>
                                <th>Product</th>
                                <th>Farmer</th>
                                <th>Category</th>
                                <th>Price</th>
                                <th>Stock</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>

                        </thead>

                        <tbody>

                            @foreach($products as $product)

                                <tr>

                                    <td>

                                        <div class="product-info">

                                            @if($product->image)

                                                <img
                                                    src="{{ asset('storage/' . $product->image) }}"
                                                    alt="{{ $product->name }}"
                                                    class="product-image"
                                                >

                                            @else

                                                <div class="no-image">
                                                    <i class="fa-solid fa-box"></i>
                                                </div>

                                            @endif

                                            <div>

                                                <div class="product-name">
                                                    {{ $product->name }}
                                                </div>

                                                <div class="product-id">
                                                    Product #{{ $product->id }}
                                                </div>

                                            </div>

                                        </div>

                                    </td>

                                    <td>
                                        {{ $product->farmer->name ?? 'Unknown' }}
                                    </td>

                                    <td>
                                        <span class="category">
                                            {{ $product->category->name ?? 'Uncategorized' }}
                                        </span>
                                    </td>

                                    <td>
                                        <span class="price">
                                            Rs. {{ number_format($product->price, 2) }}
                                        </span>
                                    </td>

                                    <td>
                                        {{ $product->stock }}
                                    </td>

                                    <td>
                                        <span class="status {{ $product->status }}">
                                            {{ ucfirst($product->status) }}
                                        </span>
                                    </td>

                                    <td>

                                        @if($product->status === 'pending')

                                            <div class="actions">

                                                <form
                                                    action="{{ route('admin.products.approve', $product->id) }}"
                                                    method="POST"
                                                >
                                                    @csrf
                                                    @method('PATCH')

                                                    <button
                                                        type="submit"
                                                        class="action-btn approve-btn"
                                                    >
                                                        <i class="fa-solid fa-check"></i>
                                                        Approve
                                                    </button>

                                                </form>

                                                <form
                                                    action="{{ route('admin.products.reject', $product->id) }}"
                                                    method="POST"
                                                >
                                                    @csrf
                                                    @method('PATCH')

                                                    <button
                                                        type="submit"
                                                        class="action-btn reject-btn"
                                                    >
                                                        <i class="fa-solid fa-xmark"></i>
                                                        Reject
                                                    </button>

                                                </form>

                                            </div>

                                        @else

                                            <span class="action-done">
                                                No action required
                                            </span>

                                        @endif

                                    </td>

                                </tr>

                            @endforeach

                        </tbody>

                    </table>

                </div>

            @else

                <div class="empty">

                    <i class="fa-solid fa-box-open"></i>

                    <h3>No Products Found</h3>

                    <p>
                        There are currently no products in the system.
                    </p>

                </div>

            @endif

        </section>

    </main>

    <script>
        const themeToggle = document.getElementById("themeToggle");

        const savedTheme = localStorage.getItem("egreen-theme");

        if (savedTheme === "dark") {
            document.body.classList.add("dark");
            themeToggle.textContent = "Light Mode";
        }

        themeToggle.addEventListener("click", function () {

            document.body.classList.toggle("dark");

            if (document.body.classList.contains("dark")) {
                localStorage.setItem("egreen-theme", "dark");
                themeToggle.textContent = "Light Mode";
            } else {
                localStorage.setItem("egreen-theme", "light");
                themeToggle.textContent = "Dark Mode";
            }

        });
    </script>

</body>

</html>