<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Vendor Dashboard | eGreen Basket</title>

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
            --text-muted: #7f8da5;

            --primary: #588157;
            --primary-dark: #456a47;
            --primary-light: #dce8d9;

            --border: #d5dfd2;

            --shadow:
                0 8px 25px rgba(53, 78, 55, 0.08);
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

            --shadow:
                0 12px 30px rgba(0, 0, 0, 0.45);
        }



        body {

            background: var(--bg-main);
            color: var(--text-main);

            min-height: 100vh;

            transition:
                background 0.35s ease,
                color 0.35s ease;
        }


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
                0 4px 18px rgba(0, 0, 0, 0.06);

            transition: 0.35s ease;
        }


        /* =========================
           BRAND
        ========================= */

        .brand {

            display: flex;
            align-items: center;

            text-decoration: none;

            color: var(--text-main);
        }


     
.brand img {
    width: 150px;
    height: auto;
    display: block;
}




        .brand-name span {

            color: var(--primary);
        }


        /* =========================
           NAV RIGHT
        ========================= */

        .nav-right {

            display: flex;
            align-items: center;

            gap: 7px;
        }


        /* =========================
           NAV LINKS
        ========================= */

        .nav-link {

            text-decoration: none;

            color: var(--text-secondary);

            padding: 10px 13px;

            border-radius: 9px;

            font-size: 14px;

            font-weight: 700;

            transition: 0.3s ease;
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

            border:
                1px solid var(--border);

            background: var(--bg-soft);

            color: var(--text-main);

            padding: 9px 13px;

            border-radius: 9px;

            font-size: 13px;

            font-weight: 700;

            cursor: pointer;

            transition: 0.3s ease;
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

            margin: 42px auto 60px;
        }


        /* =========================
           WELCOME SECTION
        ========================= */

        .welcome {

            margin-bottom: 30px;
        }


        .welcome h1 {

            font-size: 35px;

            margin-bottom: 8px;

            color: var(--text-main);

            letter-spacing: -1px;
        }


        .welcome h1 span {

            color: var(--primary);
        }


        .welcome p {

            color: var(--text-secondary);

            font-size: 15px;
        }


        /* =========================
           STAT CARDS
        ========================= */

        .cards {

            display: grid;

            grid-template-columns:
                repeat(3, 1fr);

            gap: 20px;

            margin-bottom: 28px;
        }


        .card {

            position: relative;

            overflow: hidden;

            background: var(--bg-card);

            border:
                1px solid var(--border);

            border-radius: 18px;

            padding: 25px;

            box-shadow: var(--shadow);

            transition:
                transform 0.3s ease,
                box-shadow 0.3s ease,
                border 0.3s ease;
        }


        .card:hover {

            transform: translateY(-7px);

            border-color: var(--primary);

            box-shadow:
                0 16px 35px rgba(0, 0, 0, 0.16);
        }


        .card-icon {

            width: 44px;
            height: 44px;

            display: flex;

            align-items: center;
            justify-content: center;

            margin-bottom: 17px;

            border-radius: 11px;

            background: var(--primary-light);

            color: var(--primary);

            font-size: 18px;
        }


        .card h3 {

            color: var(--text-secondary);

            font-size: 14px;

            margin-bottom: 10px;
        }


        .number {

            color: var(--primary);

            font-size: 35px;

            font-weight: 800;
        }


        /* =========================
           ACTION BUTTONS
        ========================= */

        .actions {

            display: flex;

            gap: 12px;

            margin-bottom: 30px;
        }


        .btn {

            display: inline-flex;

            align-items: center;

            justify-content: center;

            gap: 8px;

            padding: 12px 19px;

            border-radius: 10px;

            text-decoration: none;

            font-size: 14px;

            font-weight: 700;

            transition: 0.3s ease;
        }


        .btn-primary {

            background: var(--primary);

            color: #ffffff;

            box-shadow:
                0 6px 16px rgba(88, 129, 87, 0.20);
        }


        .btn-primary:hover {

            background: var(--primary-dark);

            transform: translateY(-3px);

            box-shadow:
                0 10px 22px rgba(88, 129, 87, 0.28);
        }


        .btn-secondary {

            background: var(--primary-light);

            color: var(--primary);
        }


        .btn-secondary:hover {

            background: var(--primary);

            color: #ffffff;

            transform: translateY(-3px);
        }


        /* =========================
           PRODUCTS BOX
        ========================= */

        .products-box {

            background: var(--bg-card);

            border:
                1px solid var(--border);

            border-radius: 18px;

            padding: 25px;

            box-shadow: var(--shadow);

            transition: 0.35s ease;
        }


        .products-header {

            display: flex;

            justify-content: space-between;

            align-items: center;

            margin-bottom: 22px;
        }


        .products-title {

            display: flex;

            align-items: center;

            gap: 10px;
        }


        .products-title-icon {

            width: 38px;
            height: 38px;

            display: flex;

            align-items: center;
            justify-content: center;

            border-radius: 10px;

            background: var(--primary-light);

            color: var(--primary);
        }


        .products-header h2 {

            font-size: 21px;

            color: var(--text-main);
        }


        .products-header span {

            color: var(--text-secondary);

            font-size: 13px;
        }


        /* =========================
           TABLE
        ========================= */

        .table-wrapper {

            overflow-x: auto;
        }


        table {

            width: 100%;

            min-width: 650px;

            border-collapse: collapse;
        }


        th,
        td {

            padding: 15px 13px;

            border-bottom:
                1px solid var(--border);

            text-align: left;

            font-size: 14px;
        }


        th {

            background: var(--bg-soft);

            color: var(--primary);

            font-size: 12px;

            text-transform: uppercase;

            letter-spacing: 0.5px;
        }


        td {

            color: var(--text-main);
        }


        tbody tr {

            transition: 0.25s ease;
        }


        tbody tr:hover {

            background: var(--bg-soft);
        }


        /* =========================
           STATUS BADGES
        ========================= */

        .status {

            display: inline-block;

            padding: 6px 11px;

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
           EMPTY STATE
        ========================= */

        .empty {

            text-align: center;

            padding: 45px 20px;

            color: var(--text-secondary);
        }


        .empty-icon {

            width: 58px;
            height: 58px;

            display: flex;

            align-items: center;
            justify-content: center;

            margin: 0 auto 15px;

            border-radius: 50%;

            background: var(--primary-light);

            color: var(--primary);

            font-size: 23px;
        }


        .empty p {

            margin-bottom: 20px;
        }


        /* =========================
           RESPONSIVE
        ========================= */

        @media (max-width: 850px) {

            .navbar {

                padding: 0 20px;
            }


            .nav-link {

                display: none;
            }


            .cards {

                grid-template-columns: 1fr;
            }


            .welcome h1 {

                font-size: 29px;
            }
        }


        @media (max-width: 600px) {

            .navbar {

                padding: 12px 15px;
            }


            .brand-name {

                font-size: 18px;
            }


            .theme-btn {

                padding: 8px 10px;
            }


            .container {

                width: 92%;

                margin-top: 28px;
            }


            .actions {

                flex-direction: column;
            }


            .btn {

                width: 100%;
            }


            .products-box {

                padding: 18px;
            }


            .products-header {

                flex-direction: column;

                align-items: flex-start;

                gap: 10px;
            }
        }

    </style>

</head>


<body>


    <!-- =========================
         NAVBAR
    ========================= -->

    <nav class="navbar">

     
<a href="{{ route('vendor.dashboard') }}" class="brand">
    <img src="{{ asset('images/MarketLink_logo_transparent.png') }}" alt="MarketLink Logo">
</a>




        <div class="nav-right">

            <a
                href="{{ route('vendor.dashboard') }}"
                class="nav-link active"
            >
                Dashboard
            </a>


            <a
                href="{{ route('products.index') }}"
                class="nav-link"
            >
                My Products
            </a>


            <a
                href="{{ route('products.create') }}"
                class="nav-link"
            >
                Add Product
            </a>


            <button
                type="button"
                class="theme-btn"
                id="themeToggle"
            >
                Dark Mode
            </button>

        </div>

    </nav>


    <!-- =========================
         MAIN CONTENT
    ========================= -->

    <main class="container">


        <!-- =========================
             WELCOME
        ========================= -->

        <section class="welcome">

            <h1>

                Welcome to vendor

                <span>Dashboard</span>

            </h1>


            <p>

                Manage your fresh products, stock and listings
                from one simple place.

            </p>

        </section>


        <!-- =========================
             STATISTICS
        ========================= -->

        <section class="cards">


            <div class="card">

                <div class="card-icon">

                    <i class="fa-solid fa-boxes-stacked"></i>

                </div>


                <h3>

                    Total Products

                </h3>


                <div class="number">

                    {{ $totalProducts }}

                </div>

            </div>


            <div class="card">

                <div class="card-icon">

                    <i class="fa-solid fa-clock"></i>

                </div>


                <h3>

                    Pending Products

                </h3>


                <div class="number">

                    {{ $pendingProducts }}

                </div>

            </div>


            <div class="card">

                <div class="card-icon">

                    <i class="fa-solid fa-circle-check"></i>

                </div>


                <h3>

                    Approved Products

                </h3>


                <div class="number">

                    {{ $approvedProducts }}

                </div>

            </div>


        </section>


        <!-- =========================
             QUICK ACTIONS
        ========================= -->

        <div class="actions">


            <a
                href="{{ route('products.create') }}"
                class="btn btn-primary"
            >

                <i class="fa-solid fa-plus"></i>

                Add New Product

            </a>


            <a
                href="{{ route('products.index') }}"
                class="btn btn-secondary"
            >

                <i class="fa-solid fa-box-open"></i>

                View All Products

            </a>


        </div>


        <!-- =========================
             MY PRODUCTS
        ========================= -->

        <section class="products-box">


            <div class="products-header">


                <div class="products-title">


                    <div class="products-title-icon">

                        <i class="fa-solid fa-basket-shopping"></i>

                    </div>


                    <h2>

                        My Products

                    </h2>

                </div>


                <span>

                    Your latest food listings

                </span>


            </div>


            @if($products->count() > 0)


                <div class="table-wrapper">


                    <table>


                        <thead>

                            <tr>

                                <th>
                                    Product
                                </th>

                                <th>
                                    Category
                                </th>

                                <th>
                                    Price
                                </th>

                                <th>
                                    Stock
                                </th>

                                <th>
                                    Status
                                </th>

                            </tr>

                        </thead>


                        <tbody>


                            @foreach($products as $product)


                                <tr>


                                    <td>

                                        {{ $product->name }}

                                    </td>


                                    <td>

                                        {{ $product->category->name ?? 'N/A' }}

                                    </td>


                                    <td>

                                        Rs.

                                        {{ number_format($product->price, 2) }}

                                    </td>


                                    <td>

                                        {{ $product->stock }}

                                    </td>


                                    <td>

                                        <span
                                            class="status {{ $product->status }}"
                                        >

                                            {{ ucfirst($product->status) }}

                                        </span>

                                    </td>


                                </tr>


                            @endforeach


                        </tbody>


                    </table>


                </div>


            @else


                <div class="empty">


                    <div class="empty-icon">

                        <i class="fa-solid fa-box-open"></i>

                    </div>


                    <p>

                        No products added yet.

                    </p>


                    <a
                        href="{{ route('products.create') }}"
                        class="btn btn-primary"
                    >

                        <i class="fa-solid fa-plus"></i>

                        Add Your First Product

                    </a>


                </div>


            @endif


        </section>


    </main>


    <!-- =========================
         THEME JAVASCRIPT
    ========================= -->

    <script>

        const themeToggle =
            document.getElementById("themeToggle");


        // Browser mein saved theme check karna

        const savedTheme =
            localStorage.getItem("egreen-theme");


        if (savedTheme === "dark") {

            document.body.classList.add("dark");

            themeToggle.innerHTML =
                "Light Mode";

        }


        // Button click par theme change karna

        themeToggle.addEventListener(
            "click",
            function () {

                document.body.classList.toggle("dark");


                // Dark theme save karna

                if (
                    document.body.classList.contains("dark")
                ) {

                    localStorage.setItem(
                        "egreen-theme",
                        "dark"
                    );

                    themeToggle.innerHTML =
                        "Light Mode";

                }


                // Light theme save karna

                else {

                    localStorage.setItem(
                        "egreen-theme",
                        "light"
                    );

                    themeToggle.innerHTML =
                        "Dark Mode";

                }

            }
        );

    </script>


</body>

</html>
