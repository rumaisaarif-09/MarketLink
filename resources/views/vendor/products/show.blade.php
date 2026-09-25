<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>{{ $product->name }} | eGreen Basket</title>

    <!-- Font Awesome Icons -->
    <link
        rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"
    >

    <style>

        /* =========================
           RESET
        ========================= */

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: Arial, sans-serif;
        }


        /* =========================
           LIGHT THEME
        ========================= */

        :root {
            --bg-main: #f3f7f2;
            --bg-card: #ffffff;
            --bg-soft: #e9f0e7;

            --text-main: #263328;
            --text-secondary: #68746a;
            --text-muted: #7f8a81;

            --primary: #588157;
            --primary-dark: #456a47;
            --primary-light: #dce8d9;

            --border: #d5dfd2;

            --danger: #dc3545;
            --danger-light: #fbe7e9;

            --shadow:
                0 10px 30px rgba(53, 78, 55, 0.08);
        }


        /* =========================
           PURE BLACK DARK THEME
        ========================= */

        body.dark {
            --bg-main: #000000;
            --bg-card: #111111;
            --bg-soft: #181818;

            --text-main: #f5f5f5;
            --text-secondary: #a7a7a7;
            --text-muted: #858585;

            --primary: #588157;
            --primary-dark: #456a47;
            --primary-light: #263b29;

            --border: #292929;

            --danger: #ef5350;
            --danger-light: #301719;

            --shadow:
                0 12px 35px rgba(0, 0, 0, 0.45);
        }


        /* =========================
           BODY
        ========================= */

        body {
            background: var(--bg-main);
            color: var(--text-main);
            min-height: 100vh;

            transition:
                background 0.35s ease,
                color 0.35s ease;
        }


        /* =========================
           NAVBAR
        ========================= */

        .navbar {
            position: sticky;
            top: 0;
            z-index: 1000;

            min-height: 72px;

            padding: 0 5%;

            display: flex;
            align-items: center;
            justify-content: space-between;

            background: var(--bg-card);

            border-bottom:
                1px solid var(--border);

            box-shadow:
                0 4px 20px rgba(0, 0, 0, 0.05);
        }


        .brand {
            display: flex;
            align-items: center;

            gap: 10px;

            text-decoration: none;

            color: var(--text-main);
        }


        .brand-icon {
            width: 40px;
            height: 40px;

            display: flex;
            align-items: center;
            justify-content: center;

            border-radius: 11px;

            background: var(--primary-light);

            color: var(--primary);

            font-size: 18px;

            transition: 0.3s ease;
        }


        .brand:hover .brand-icon {
            transform:
                rotate(-8deg)
                scale(1.08);
        }


        .brand-name {
            font-size: 21px;
            font-weight: 800;

            letter-spacing: -0.5px;
        }


        .brand-name span {
            color: var(--primary);
        }


        .nav-right {
            display: flex;
            align-items: center;
            gap: 7px;
        }


        .nav-link {
            text-decoration: none;

            color: var(--text-secondary);

            padding: 10px 13px;

            border-radius: 9px;

            font-size: 14px;
            font-weight: 700;

            transition: 0.3s ease;
        }


        .nav-link i {
            margin-right: 6px;
        }


        .nav-link:hover,
        .nav-link.active {
            color: var(--primary);

            background: var(--primary-light);

            transform: translateY(-2px);
        }


        /* =========================
           THEME BUTTON
        ========================= */

        .theme-btn {
            border: 1px solid var(--border);

            background: var(--bg-soft);

            color: var(--text-main);

            padding: 9px 13px;

            border-radius: 9px;

            font-size: 13px;
            font-weight: 700;

            cursor: pointer;

            transition: 0.3s ease;
        }


        .theme-btn i {
            margin-right: 6px;
        }


        .theme-btn:hover {
            background: var(--primary);

            color: white;

            transform: translateY(-2px);
        }


        /* =========================
           CONTAINER
        ========================= */

        .container {
            width: 90%;
            max-width: 1050px;

            margin: 42px auto 70px;
        }


        /* =========================
           PAGE HEADER
        ========================= */

        .page-header {
            margin-bottom: 24px;
        }


        .page-label {
            display: inline-flex;

            align-items: center;

            gap: 7px;

            padding: 7px 12px;

            margin-bottom: 10px;

            border-radius: 20px;

            background: var(--primary-light);

            color: var(--primary);

            font-size: 11px;

            font-weight: 800;
        }


        .page-header h1 {
            font-size: 31px;

            margin-bottom: 7px;

            color: var(--text-main);
        }


        .page-header p {
            color: var(--text-secondary);

            font-size: 14px;
        }


        /* =========================
           PRODUCT CARD
        ========================= */

        .product-card {
            display: grid;

            grid-template-columns:
                minmax(320px, 0.95fr)
                minmax(320px, 1.05fr);

            background: var(--bg-card);

            border:
                1px solid var(--border);

            border-radius: 20px;

            overflow: hidden;

            box-shadow: var(--shadow);

            transition: 0.35s ease;
        }


        .product-card:hover {
            transform: translateY(-3px);

            box-shadow:
                0 16px 38px rgba(53, 78, 55, 0.12);
        }


        /* =========================
           PRODUCT IMAGE
        ========================= */

        .image-section {
            min-height: 430px;

            display: flex;

            align-items: center;
            justify-content: center;

            padding: 30px;

            background: var(--bg-soft);

            border-right:
                1px solid var(--border);
        }


        .product-image {
            width: 100%;
            height: 370px;

            object-fit: cover;

            border-radius: 15px;

            border:
                1px solid var(--border);

            box-shadow:
                0 10px 25px rgba(0, 0, 0, 0.08);
        }


        .no-image {
            width: 100%;
            height: 370px;

            display: flex;

            flex-direction: column;

            align-items: center;
            justify-content: center;

            gap: 12px;

            border-radius: 15px;

            border:
                1px dashed var(--border);

            background: var(--bg-card);

            color: var(--text-muted);

            font-size: 13px;
        }


        .no-image i {
            font-size: 45px;

            color: var(--primary);
        }


        /* =========================
           PRODUCT INFORMATION
        ========================= */

        .details-section {
            padding: 34px;
        }


        .category-badge {
            display: inline-flex;

            align-items: center;

            gap: 7px;

            padding: 7px 12px;

            border-radius: 20px;

            background: var(--primary-light);

            color: var(--primary);

            font-size: 11px;

            font-weight: 800;

            margin-bottom: 15px;
        }


        .details-section h2 {
            font-size: 28px;

            line-height: 1.25;

            color: var(--text-main);

            margin-bottom: 12px;
        }


        .description {
            color: var(--text-secondary);

            font-size: 14px;

            line-height: 1.7;

            margin-bottom: 25px;
        }


        /* =========================
           INFO BOXES
        ========================= */

        .info-grid {
            display: grid;

            grid-template-columns:
                repeat(2, 1fr);

            gap: 12px;

            margin-bottom: 22px;
        }


        .info-box {
            padding: 16px;

            border:
                1px solid var(--border);

            border-radius: 12px;

            background: var(--bg-main);

            transition: 0.3s ease;
        }


        .info-box:hover {
            transform: translateY(-2px);

            border-color: var(--primary);
        }


        .info-icon {
            width: 34px;
            height: 34px;

            display: flex;

            align-items: center;
            justify-content: center;

            border-radius: 9px;

            background: var(--primary-light);

            color: var(--primary);

            margin-bottom: 9px;
        }


        .info-label {
            color: var(--text-muted);

            font-size: 11px;

            margin-bottom: 4px;
        }


        .info-value {
            color: var(--text-main);

            font-size: 17px;

            font-weight: 800;
        }


        /* =========================
           STATUS
        ========================= */

        .status-row {
            display: flex;

            align-items: center;

            justify-content: space-between;

            gap: 15px;

            padding: 14px 16px;

            background: var(--bg-soft);

            border:
                1px solid var(--border);

            border-radius: 12px;

            margin-bottom: 25px;
        }


        .status-title {
            display: flex;

            align-items: center;

            gap: 8px;

            color: var(--text-main);

            font-size: 13px;

            font-weight: 700;
        }


        .status-title i {
            color: var(--primary);
        }


        .status-badge {
            padding: 6px 11px;

            border-radius: 20px;

            font-size: 11px;

            font-weight: 800;

            text-transform: capitalize;

            background: var(--primary-light);

            color: var(--primary);
        }


        /* =========================
           ACTION BUTTONS
        ========================= */

        .actions {
            display: flex;

            gap: 10px;

            flex-wrap: wrap;
        }


        .btn {
            display: inline-flex;

            align-items: center;

            justify-content: center;

            gap: 8px;

            padding: 11px 18px;

            border-radius: 10px;

            border: none;

            text-decoration: none;

            font-size: 13px;

            font-weight: 700;

            cursor: pointer;

            transition: 0.3s ease;
        }


        .edit-btn {
            background: var(--primary);

            color: white;
        }


        .edit-btn:hover {
            background: var(--primary-dark);

            transform: translateY(-3px);
        }


        .back-btn {
            background: var(--primary-light);

            color: var(--primary);
        }


        .back-btn:hover {
            background: var(--primary);

            color: white;

            transform: translateY(-3px);
        }


        .delete-btn {
            background: var(--danger-light);

            color: var(--danger);
        }


        .delete-btn:hover {
            background: var(--danger);

            color: white;

            transform: translateY(-3px);
        }


        /* =========================
           RESPONSIVE
        ========================= */

        @media (max-width: 850px) {

            .nav-link {
                display: none;
            }


            .product-card {
                grid-template-columns: 1fr;
            }


            .image-section {
                border-right: none;

                border-bottom:
                    1px solid var(--border);

                min-height: auto;
            }


            .product-image,
            .no-image {
                height: 350px;
            }
        }


        @media (max-width: 550px) {

            .navbar {
                min-height: 70px;

                padding: 12px 15px;
            }


            .brand-name {
                font-size: 18px;
            }


            .container {
                width: 92%;

                margin-top: 30px;
            }


            .details-section {
                padding: 23px 18px;
            }


            .image-section {
                padding: 18px;
            }


            .product-image,
            .no-image {
                height: 280px;
            }


            .details-section h2 {
                font-size: 24px;
            }


            .info-grid {
                grid-template-columns: 1fr;
            }


            .actions {
                flex-direction: column;
            }


            .btn {
                width: 100%;
            }
        }

    </style>

</head>


<body>


    <!-- =========================
         NAVBAR
    ========================= -->

    <nav class="navbar">

        <a
            href="{{ route('vendor.dashboard') }}"
            class="brand"
        >

            <div class="brand-icon">
                <i class="fa-solid fa-leaf"></i>
            </div>


            <div class="brand-name">
                eGreen <span>Basket</span>
            </div>

        </a>


        <div class="nav-right">

            <a
                href="{{ route('vendor.dashboard') }}"
                class="nav-link"
            >
                <i class="fa-solid fa-house"></i>
                Dashboard
            </a>


            <a
                href="{{ route('products.index') }}"
                class="nav-link active"
            >
                <i class="fa-solid fa-box-open"></i>
                My Products
            </a>


            <a
                href="{{ route('products.create') }}"
                class="nav-link"
            >
                <i class="fa-solid fa-plus"></i>
                Add Product
            </a>


            <button
                type="button"
                class="theme-btn"
                id="themeToggle"
            >
                <i class="fa-solid fa-moon"></i>
                Dark Mode
            </button>

        </div>

    </nav>


    <!-- =========================
         MAIN CONTENT
    ========================= -->

    <div class="container">


        <!-- PAGE HEADER -->

        <div class="page-header">

            <h1>
                View Product
            </h1>


            <p>
                Complete information about your selected product.
            </p>

        </div>


        <!-- =========================
             PRODUCT CARD
        ========================= -->

        <div class="product-card">


            <!-- PRODUCT IMAGE -->

            <div class="image-section">

                @if($product->image)

                    <img
                        src="{{ asset('storage/' . $product->image) }}"
                        alt="{{ $product->name }}"
                        class="product-image"
                    >

                @else

                    <div class="no-image">

                        <i class="fa-regular fa-image"></i>

                        <span>
                            No product image available
                        </span>

                    </div>

                @endif

            </div>


            <!-- PRODUCT DETAILS -->

            <div class="details-section">


                <!-- CATEGORY -->

                <div class="category-badge">

                    <i class="fa-solid fa-layer-group"></i>

                    {{ $product->category->name ?? 'Uncategorized' }}

                </div>


                <!-- PRODUCT NAME -->

                <h2>
                    {{ $product->name }}
                </h2>


                <!-- DESCRIPTION -->

                <div class="description">

                    @if($product->description)

                        {{ $product->description }}

                    @else

                        No description has been added for this product.

                    @endif

                </div>


                <!-- INFO GRID -->

                <div class="info-grid">


                    <!-- PRICE -->

                    <div class="info-box">

                        <div class="info-icon">

                            <i class="fa-solid fa-money-bill-wave"></i>

                        </div>


                        <div class="info-label">
                            Price
                        </div>


                        <div class="info-value">
                            Rs. {{ number_format($product->price, 2) }}
                        </div>

                    </div>


                    <!-- STOCK -->

                    <div class="info-box">

                        <div class="info-icon">

                            <i class="fa-solid fa-boxes-stacked"></i>

                        </div>


                        <div class="info-label">
                            Stock
                        </div>


                        <div class="info-value">
                            {{ $product->stock }} units
                        </div>

                    </div>

                </div>


                <!-- STATUS -->

                <div class="status-row">

                    <div class="status-title">

                        <i class="fa-solid fa-circle-check"></i>

                        Product Status

                    </div>


                    <div class="status-badge">

                        {{ $product->status }}

                    </div>

                </div>


                <!-- ACTIONS -->

                <div class="actions">


                    <a
                        href="{{ route('products.edit', $product->id) }}"
                        class="btn edit-btn"
                    >

                        <i class="fa-solid fa-pen-to-square"></i>

                        Edit Product

                    </a>


                    <a
                        href="{{ route('products.index') }}"
                        class="btn back-btn"
                    >

                        <i class="fa-solid fa-arrow-left"></i>

                        Back to Products

                    </a>


                    <form
                        action="{{ route('products.destroy', $product->id) }}"
                        method="POST"
                        style="display: inline;"
                        onsubmit="return confirm('Are you sure you want to delete this product?');"
                    >

                        @csrf

                        @method('DELETE')


                        <button
                            type="submit"
                            class="btn delete-btn"
                        >

                            <i class="fa-solid fa-trash"></i>

                            Delete Product

                        </button>

                    </form>

                </div>

            </div>

        </div>

    </div>


    <!-- =========================
         DARK / LIGHT MODE
    ========================= -->

    <script>

        const themeToggle =
            document.getElementById("themeToggle");


        // Saved theme check karna
        const savedTheme =
            localStorage.getItem("egreen-theme");


        if (savedTheme === "dark") {

            document.body.classList.add("dark");

            themeToggle.innerHTML =
                '<i class="fa-solid fa-sun"></i> Light Mode';

        }


        // Button click par theme change karna
        themeToggle.addEventListener(
            "click",
            function () {

                document.body.classList.toggle("dark");


                // Dark mode save karna
                if (
                    document.body.classList.contains("dark")
                ) {

                    localStorage.setItem(
                        "egreen-theme",
                        "dark"
                    );

                    themeToggle.innerHTML =
                        '<i class="fa-solid fa-sun"></i> Light Mode';

                }


                // Light mode save karna
                else {

                    localStorage.setItem(
                        "egreen-theme",
                        "light"
                    );

                    themeToggle.innerHTML =
                        '<i class="fa-solid fa-moon"></i> Dark Mode';

                }

            }
        );

    </script>


</body>

</html>

