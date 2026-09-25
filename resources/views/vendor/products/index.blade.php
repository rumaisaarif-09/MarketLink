
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>My Products | eGreen Basket</title>

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

            --primary: #588157;
            --primary-dark: #456a47;
            --primary-light: #dce8d9;

            --border: #d5dfd2;

            --danger: #dc3545;

            --shadow:
                0 8px 25px rgba(53, 78, 55, 0.08);
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

            --primary: #588157;
            --primary-dark: #456a47;
            --primary-light: #263b29;

            --border: #292929;

            --danger: #ef5350;

            --shadow:
                0 12px 30px rgba(0, 0, 0, 0.45);
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

            justify-content: space-between;

            align-items: center;

            background: var(--bg-card);

            border-bottom:
                1px solid var(--border);

            box-shadow:
                0 4px 20px rgba(0, 0, 0, 0.05);

            transition: 0.35s ease;
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

            font-size: 14px;

            font-weight: 700;

            padding: 10px 13px;

            border-radius: 9px;

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

            color: #ffffff;

            transform: translateY(-2px);
        }


        /* =========================
           MAIN CONTAINER
        ========================= */

        .container {
            width: 90%;

            max-width: 1200px;

            margin: 40px auto 70px;
        }


        /* =========================
           PAGE HEADER
        ========================= */

        .page-header {
            display: flex;

            justify-content: space-between;

            align-items: center;

            margin-bottom: 30px;
        }


        .page-heading small {
            display: inline-flex;

            align-items: center;

            gap: 7px;

            margin-bottom: 9px;

            padding: 7px 12px;

            border-radius: 20px;

            background: var(--primary-light);

            color: var(--primary);

            font-size: 11px;

            font-weight: 800;
        }


        .page-heading h1 {
            color: var(--text-main);

            font-size: 34px;

            letter-spacing: -1px;

            margin-bottom: 7px;
        }


        .page-heading p {
            color: var(--text-secondary);

            font-size: 14px;
        }


        /* =========================
           ADD BUTTON
        ========================= */

        .add-btn {
            display: inline-flex;

            align-items: center;

            gap: 8px;

            background: var(--primary);

            color: white;

            padding: 12px 18px;

            text-decoration: none;

            border-radius: 10px;

            font-size: 14px;

            font-weight: 700;

            box-shadow:
                0 5px 15px rgba(88, 129, 87, 0.18);

            transition: 0.3s ease;
        }


        .add-btn:hover {
            background: var(--primary-dark);

            transform: translateY(-3px);

            box-shadow:
                0 10px 22px rgba(88, 129, 87, 0.25);
        }


        /* =========================
           SUCCESS MESSAGE
        ========================= */

        .message {
            display: flex;

            align-items: center;

            gap: 10px;

            background: var(--primary-light);

            color: var(--primary);

            padding: 13px 16px;

            border: 1px solid var(--border);

            border-radius: 11px;

            margin-bottom: 28px;

            font-size: 14px;

            font-weight: 700;
        }


        /* =========================
           CATEGORY SECTION
        ========================= */

        .category-section {
            margin-bottom: 48px;
        }


        .category-header {
            display: flex;

            align-items: center;

            justify-content: space-between;

            margin-bottom: 18px;
        }


        .category-title {
            display: flex;

            align-items: center;

            gap: 10px;

            color: var(--text-main);

            font-size: 23px;
        }


        .category-title i {
            color: var(--primary);

            font-size: 19px;
        }


        .category-line {
            flex: 1;

            height: 1px;

            margin-left: 18px;

            background: var(--border);
        }


        /* =========================
           PRODUCTS GRID
        ========================= */

        .products {
            display: grid;

            grid-template-columns:
                repeat(4, minmax(0, 1fr));

            gap: 20px;
        }


        /* =========================
           PRODUCT CARD
        ========================= */

        .card {
            position: relative;

            overflow: hidden;

            background: var(--bg-card);

            border: 1px solid var(--border);

            border-radius: 18px;

            padding: 15px;

            box-shadow: var(--shadow);

            transition:
                transform 0.35s ease,
                box-shadow 0.35s ease,
                border-color 0.35s ease;
        }


        .card:hover {
            transform: translateY(-8px);

            border-color: var(--primary);

            box-shadow:
                0 18px 35px rgba(88, 129, 87, 0.16);
        }


        /* =========================
           IMAGE
        ========================= */

        .image-wrapper {
            position: relative;

            width: 100%;

            height: 190px;

            overflow: hidden;

            border-radius: 13px;

            background: var(--bg-soft);

            margin-bottom: 16px;
        }


        .card img {
            width: 100%;

            height: 100%;

            object-fit: cover;

            transition:
                transform 0.5s ease,
                filter 0.5s ease;
        }


        .card:hover img {
            transform: scale(1.08);

            filter: brightness(1.05);
        }


        .no-image {
            width: 100%;

            height: 100%;

            display: flex;

            align-items: center;

            justify-content: center;

            flex-direction: column;

            gap: 8px;

            color: var(--text-secondary);

            font-size: 13px;
        }


        .no-image i {
            font-size: 28px;

            color: var(--primary);
        }


        /* =========================
           PRODUCT INFO
        ========================= */

        .card h3 {
            color: var(--text-main);

            font-size: 18px;

            margin-bottom: 8px;

            transition: 0.3s ease;
        }


        .card:hover h3 {
            color: var(--primary);

            transform: translateX(2px);
        }


        .description {
            color: var(--text-secondary);

            font-size: 13px;

            line-height: 1.6;

            min-height: 42px;

            margin-bottom: 12px;
        }


        .price {
            color: var(--primary);

            font-size: 20px;

            font-weight: 800;

            margin-bottom: 8px;
        }


        .stock {
            color: var(--text-secondary);

            font-size: 13px;

            margin-bottom: 8px;
        }


        .stock i {
            color: var(--primary);

            margin-right: 5px;
        }


        /* =========================
           STATUS
        ========================= */

        .status-row {
            margin-bottom: 14px;
        }


        .status {
            display: inline-block;

            padding: 5px 10px;

            border-radius: 20px;

            font-size: 11px;

            font-weight: 800;
        }


        .pending {
            background: #fef3c7;

            color: #92400e;
        }


        .approved {
            background: #dcfce7;

            color: #166534;
        }


        .rejected {
            background: #fee2e2;

            color: #991b1b;
        }


        /* =========================
           ACTION BUTTONS
        ========================= */

        .actions {
            display: grid;

            grid-template-columns: 1fr 1fr;

            gap: 7px;

            margin-top: 10px;
        }


        .actions a,
        .actions button {
            display: flex;

            align-items: center;

            justify-content: center;

            gap: 6px;

            padding: 9px 7px;

            border: none;

            border-radius: 8px;

            text-decoration: none;

            font-size: 12px;

            font-weight: 700;

            cursor: pointer;

            transition: 0.3s ease;
        }


        .view {
            background: var(--primary-light);

            color: var(--primary);
        }


        .edit {
            background: var(--primary);

            color: white;
        }


        .delete {
            grid-column: span 2;

            background: #fff0f1;

            color: var(--danger);
        }


        body.dark .delete {
            background: #241416;
        }


        .view:hover,
        .edit:hover,
        .delete:hover {
            transform: translateY(-2px);
        }


        .view:hover {
            background: var(--primary);

            color: white;
        }


        .edit:hover {
            background: var(--primary-dark);
        }


        .delete:hover {
            background: var(--danger);

            color: white;
        }


        /* =========================
           EMPTY STATE
        ========================= */

        .empty {
            background: var(--bg-card);

            border: 1px dashed var(--border);

            border-radius: 15px;

            padding: 28px;

            color: var(--text-secondary);

            text-align: center;

            font-size: 13px;
        }


        .empty i {
            display: block;

            color: var(--primary);

            font-size: 25px;

            margin-bottom: 10px;
        }


        /* =========================
           RESPONSIVE
        ========================= */

        @media (max-width: 1050px) {

            .products {
                grid-template-columns:
                    repeat(3, minmax(0, 1fr));
            }
        }


        @media (max-width: 800px) {

            .products {
                grid-template-columns:
                    repeat(2, minmax(0, 1fr));
            }


            .nav-link {
                display: none;
            }


            .page-header {
                align-items: flex-start;

                flex-direction: column;

                gap: 18px;
            }


            .add-btn {
                width: 100%;

                justify-content: center;
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

                margin-top: 28px;
            }


            .products {
                grid-template-columns: 1fr;
            }


            .page-heading h1 {
                font-size: 28px;
            }


            .category-title {
                font-size: 20px;
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
         MAIN
    ========================= -->

    <div class="container">


        <!-- =========================
             PAGE HEADER
        ========================= -->

        <div class="page-header">

            <div class="page-heading">
                <h1>
                    My Products
                </h1>


                <p>
                    Manage your fresh food items and keep your store updated.
                </p>

            </div>


            <a
                href="{{ route('products.create') }}"
                class="add-btn"
            >
                <i class="fa-solid fa-plus"></i>
                Add Product
            </a>

        </div>


        <!-- =========================
             SUCCESS MESSAGE
        ========================= -->

        @if(session('success'))

            <div class="message">

                <i class="fa-solid fa-circle-check"></i>

                {{ session('success') }}

            </div>

        @endif


        <!-- =========================
             VEGETABLES
        ========================= -->

        @php

            // Vegetables category ke products filter karna
            $vegetables = $products->filter(function ($product) {

                return strtolower(
                    $product->category->name ?? ''
                ) === 'vegetables';

            });

        @endphp


        <div class="category-section">

            <div class="category-header">

                <h2 class="category-title">

                    <i class="fa-solid fa-carrot"></i>

                    Vegetables

                </h2>

                <div class="category-line"></div>

            </div>


            <div class="products">

                @forelse($vegetables as $product)

                    <div class="card">


                        <div class="image-wrapper">

                            @if($product->image)

                                <img
                                    src="{{ asset('storage/' . $product->image) }}"
                                    alt="{{ $product->name }}"
                                >

                            @else

                                <div class="no-image">

                                    <i class="fa-solid fa-image"></i>

                                    No Image

                                </div>

                            @endif

                        </div>


                        <h3>
                            {{ $product->name }}
                        </h3>


                        <p class="description">
                            {{ $product->description }}
                        </p>


                        <p class="price">
                            Rs. {{ number_format($product->price, 2) }}
                        </p>


                        <p class="stock">

                            <i class="fa-solid fa-boxes-stacked"></i>

                            Stock: {{ $product->stock }}

                        </p>


                        <div class="status-row">

                            <span
                                class="status {{ $product->status }}"
                            >
                                {{ ucfirst($product->status) }}
                            </span>

                        </div>


                        <div class="actions">

                            <a
                                href="{{ route('products.show', $product->id) }}"
                                class="view"
                            >
                                <i class="fa-solid fa-eye"></i>
                                View
                            </a>


                            <a
                                href="{{ route('products.edit', $product->id) }}"
                                class="edit"
                            >
                                <i class="fa-solid fa-pen-to-square"></i>
                                Edit
                            </a>


                            <form
                                action="{{ route('products.destroy', $product->id) }}"
                                method="POST"
                                style="display: contents;"
                            >

                                @csrf

                                @method('DELETE')

                                <button
                                    type="submit"
                                    class="delete"
                                    onclick="return confirm('Are you sure you want to delete this product?')"
                                >
                                    <i class="fa-solid fa-trash"></i>
                                    Delete
                                </button>

                            </form>

                        </div>

                    </div>

                @empty

                    <div class="empty">

                        <i class="fa-solid fa-carrot"></i>

                        No vegetable products added yet.

                    </div>

                @endforelse

            </div>

        </div>


        <!-- =========================
             FRUITS
        ========================= -->

        @php

            // Fruits category ke products filter karna
            $fruits = $products->filter(function ($product) {

                return strtolower(
                    $product->category->name ?? ''
                ) === 'fruits';

            });

        @endphp


        <div class="category-section">

            <div class="category-header">

                <h2 class="category-title">

                    <i class="fa-solid fa-apple-whole"></i>

                    Fruits

                </h2>

                <div class="category-line"></div>

            </div>


            <div class="products">

                @forelse($fruits as $product)

                    <div class="card">


                        <div class="image-wrapper">

                            @if($product->image)

                                <img
                                    src="{{ asset('storage/' . $product->image) }}"
                                    alt="{{ $product->name }}"
                                >

                            @else

                                <div class="no-image">

                                    <i class="fa-solid fa-image"></i>

                                    No Image

                                </div>

                            @endif

                        </div>


                        <h3>
                            {{ $product->name }}
                        </h3>


                        <p class="description">
                            {{ $product->description }}
                        </p>


                        <p class="price">
                            Rs. {{ number_format($product->price, 2) }}
                        </p>


                        <p class="stock">

                            <i class="fa-solid fa-boxes-stacked"></i>

                            Stock: {{ $product->stock }}

                        </p>


                        <div class="status-row">

                            <span
                                class="status {{ $product->status }}"
                            >
                                {{ ucfirst($product->status) }}
                            </span>

                        </div>


                        <div class="actions">

                            <a
                                href="{{ route('products.show', $product->id) }}"
                                class="view"
                            >
                                <i class="fa-solid fa-eye"></i>
                                View
                            </a>


                            <a
                                href="{{ route('products.edit', $product->id) }}"
                                class="edit"
                            >
                                <i class="fa-solid fa-pen-to-square"></i>
                                Edit
                            </a>


                            <form
                                action="{{ route('products.destroy', $product->id) }}"
                                method="POST"
                                style="display: contents;"
                            >

                                @csrf

                                @method('DELETE')

                                <button
                                    type="submit"
                                    class="delete"
                                    onclick="return confirm('Are you sure you want to delete this product?')"
                                >
                                    <i class="fa-solid fa-trash"></i>
                                    Delete
                                </button>

                            </form>

                        </div>

                    </div>

                @empty

                    <div class="empty">

                        <i class="fa-solid fa-apple-whole"></i>

                        No fruit products added yet.

                    </div>

                @endforelse

            </div>

        </div>


        <!-- =========================
             GRAINS
        ========================= -->

        @php

            // Grains category ke products filter karna
            $grains = $products->filter(function ($product) {

                return strtolower(
                    $product->category->name ?? ''
                ) === 'grains';

            });

        @endphp


        <div class="category-section">

            <div class="category-header">

                <h2 class="category-title">

                    <i class="fa-solid fa-wheat-awn"></i>

                    Grains

                </h2>

                <div class="category-line"></div>

            </div>


            <div class="products">

                @forelse($grains as $product)

                    <div class="card">


                        <div class="image-wrapper">

                            @if($product->image)

                                <img
                                    src="{{ asset('storage/' . $product->image) }}"
                                    alt="{{ $product->name }}"
                                >

                            @else

                                <div class="no-image">

                                    <i class="fa-solid fa-image"></i>

                                    No Image

                                </div>

                            @endif

                        </div>


                        <h3>
                            {{ $product->name }}
                        </h3>


                        <p class="description">
                            {{ $product->description }}
                        </p>


                        <p class="price">
                            Rs. {{ number_format($product->price, 2) }}
                        </p>


                        <p class="stock">

                            <i class="fa-solid fa-boxes-stacked"></i>

                            Stock: {{ $product->stock }}

                        </p>


                        <div class="status-row">

                            <span
                                class="status {{ $product->status }}"
                            >
                                {{ ucfirst($product->status) }}
                            </span>

                        </div>


                        <div class="actions">

                            <a
                                href="{{ route('products.show', $product->id) }}"
                                class="view"
                            >
                                <i class="fa-solid fa-eye"></i>
                                View
                            </a>


                            <a
                                href="{{ route('products.edit', $product->id) }}"
                                class="edit"
                            >
                                <i class="fa-solid fa-pen-to-square"></i>
                                Edit
                            </a>


                            <form
                                action="{{ route('products.destroy', $product->id) }}"
                                method="POST"
                                style="display: contents;"
                            >

                                @csrf

                                @method('DELETE')

                                <button
                                    type="submit"
                                    class="delete"
                                    onclick="return confirm('Are you sure you want to delete this product?')"
                                >
                                    <i class="fa-solid fa-trash"></i>
                                    Delete
                                </button>

                            </form>

                        </div>

                    </div>

                @empty

                    <div class="empty">

                        <i class="fa-solid fa-wheat-awn"></i>

                        No grain products added yet.

                    </div>

                @endforelse

            </div>

        </div>


        <!-- =========================
             ORGANIC
        ========================= -->

        @php

            // Organic category ke products filter karna
            $organic = $products->filter(function ($product) {

                return strtolower(
                    $product->category->name ?? ''
                ) === 'organic';

            });

        @endphp


        <div class="category-section">

            <div class="category-header">

                <h2 class="category-title">

                    <i class="fa-solid fa-leaf"></i>

                    Organic

                </h2>

                <div class="category-line"></div>

            </div>


            <div class="products">

                @forelse($organic as $product)

                    <div class="card">


                        <div class="image-wrapper">

                            @if($product->image)

                                <img
                                    src="{{ asset('storage/' . $product->image) }}"
                                    alt="{{ $product->name }}"
                                >

                            @else

                                <div class="no-image">

                                    <i class="fa-solid fa-image"></i>

                                    No Image

                                </div>

                            @endif

                        </div>


                        <h3>
                            {{ $product->name }}
                        </h3>


                        <p class="description">
                            {{ $product->description }}
                        </p>


                        <p class="price">
                            Rs. {{ number_format($product->price, 2) }}
                        </p>


                        <p class="stock">

                            <i class="fa-solid fa-boxes-stacked"></i>

                            Stock: {{ $product->stock }}

                        </p>


                        <div class="status-row">

                            <span
                                class="status {{ $product->status }}"
                            >
                                {{ ucfirst($product->status) }}
                            </span>

                        </div>


                        <div class="actions">

                            <a
                                href="{{ route('products.show', $product->id) }}"
                                class="view"
                            >
                                <i class="fa-solid fa-eye"></i>
                                View
                            </a>


                            <a
                                href="{{ route('products.edit', $product->id) }}"
                                class="edit"
                            >
                                <i class="fa-solid fa-pen-to-square"></i>
                                Edit
                            </a>


                            <form
                                action="{{ route('products.destroy', $product->id) }}"
                                method="POST"
                                style="display: contents;"
                            >

                                @csrf

                                @method('DELETE')

                                <button
                                    type="submit"
                                    class="delete"
                                    onclick="return confirm('Are you sure you want to delete this product?')"
                                >
                                    <i class="fa-solid fa-trash"></i>
                                    Delete
                                </button>

                            </form>

                        </div>

                    </div>

                @empty

                    <div class="empty">

                        <i class="fa-solid fa-leaf"></i>

                        No organic products added yet.

                    </div>

                @endforelse

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
