<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reports - eGreen Basket</title>

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
            transition: background 0.35s ease, color 0.35s ease;
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

        .nav-links {
            display: flex;
            gap: 28px;
        }

        .nav-link {
            text-decoration: none;
            color: #425247;
            font-weight: 500;
        }

        .nav-link:hover,
        .nav-link.active {
            color: #2e7d32;
            font-weight: 700;
        }

        .theme-btn {
            border: none;
            background: transparent;
            color: #425247;
            font-size: 16px;
            cursor: pointer;
        }

        .container {
            padding: 40px;
        }

        .page-header {
            margin-bottom: 30px;
        }

        .page-header h1 {
            font-size: 30px;
            margin-bottom: 8px;
        }

        .page-header p {
            color: #718078;
        }

        .report-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 22px;
        }

        .report-card {
            background: #ffffff;
            border: 1px solid #dfe8df;
            border-radius: 16px;
            padding: 25px;
        }

        .report-icon {
            width: 45px;
            height: 45px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 12px;
            background: #e5f5e7;
            color: #2e7d32;
            font-size: 19px;
            margin-bottom: 18px;
        }

        .report-card h3 {
            font-size: 15px;
            color: #68756d;
            margin-bottom: 10px;
        }

        .report-card strong {
            font-size: 28px;
        }

        body.dark {
            background: #000000;
            color: #ffffff;
        }

        body.dark .navbar,
        body.dark .report-card {
            background: #0b0b0b;
            border-color: #242424;
        }

        body.dark .nav-link,
        body.dark .theme-btn {
            color: #cccccc;
        }

        body.dark .nav-link:hover,
        body.dark .nav-link.active {
            color: #7bd88f;
        }

        body.dark .page-header p {
            color: #aaaaaa;
        }

        body.dark .report-icon {
            background: #152518;
            color: #7bd88f;
        }

        body.dark .report-card h3 {
            color: #aaaaaa;
        }

        @media (max-width: 900px) {
            .report-grid {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        @media (max-width: 600px) {
            .navbar {
                padding: 0 20px;
            }

            .nav-links {
                gap: 12px;
            }

            .container {
                padding: 25px 20px;
            }

            .report-grid {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>

<body>

<nav class="navbar">
    <div class="logo">eGreen Basket</div>

    <div class="nav-links">
        <a href="{{ route('admin.dashboard') }}" class="nav-link">Dashboard</a>
        <a href="{{ route('admin.products') }}" class="nav-link">Products</a>
        <a href="{{ route('admin.users') }}" class="nav-link">Users</a>
        <a href="{{ route('admin.farmers') }}" class="nav-link">Farmers</a>
        <a href="{{ route('admin.orders') }}" class="nav-link">Orders</a>
        <a href="{{ route('admin.reports') }}" class="nav-link active">Reports</a>
    </div>

    <button class="theme-btn" onclick="toggleTheme()">
        <i class="fa-solid fa-moon"></i> Dark Mode
    </button>
</nav>

<div class="container">

    <div class="page-header">
        <h1>Reports</h1>
        <p>Overview of eGreen Basket activity and performance.</p>
    </div>

    <div class="report-grid">

        <div class="report-card">
            <div class="report-icon">
                <i class="fa-solid fa-cart-shopping"></i>
            </div>
            <h3>Total Orders</h3>
            <strong>{{ $totalOrders }}</strong>
        </div>

        <div class="report-card">
            <div class="report-icon">
                <i class="fa-solid fa-money-bill-wave"></i>
            </div>
            <h3>Total Sales</h3>
            <strong>Rs. {{ number_format($totalSales, 2) }}</strong>
        </div>

        <div class="report-card">
            <div class="report-icon">
                <i class="fa-solid fa-clock"></i>
            </div>
            <h3>Pending Orders</h3>
            <strong>{{ $pendingOrders }}</strong>
        </div>

        <div class="report-card">
            <div class="report-icon">
                <i class="fa-solid fa-circle-check"></i>
            </div>
            <h3>Completed Orders</h3>
            <strong>{{ $completedOrders }}</strong>
        </div>

        <div class="report-card">
            <div class="report-icon">
                <i class="fa-solid fa-box"></i>
            </div>
            <h3>Total Products</h3>
            <strong>{{ $totalProducts }}</strong>
        </div>

        <div class="report-card">
            <div class="report-icon">
                <i class="fa-solid fa-users"></i>
            </div>
            <h3>Total Users</h3>
            <strong>{{ $totalUsers }}</strong>
        </div>

    </div>

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