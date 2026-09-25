<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Orders - eGreen Basket</title>

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
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 30px;
        }

        .page-header h1 {
            font-size: 30px;
            margin-bottom: 8px;
        }

        .page-header p {
            color: #718078;
        }

        .table-box {
            background: #ffffff;
            border: 1px solid #dfe8df;
            border-radius: 16px;
            overflow-x: auto;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            min-width: 950px;
        }

        th,
        td {
            padding: 17px 18px;
            text-align: left;
            border-bottom: 1px solid #edf1ed;
        }

        th {
            background: #f5f8f5;
            color: #405148;
            font-size: 14px;
        }

        td {
            font-size: 14px;
        }

        tr:last-child td {
            border-bottom: none;
        }

        .status {
            display: inline-block;
            padding: 6px 12px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 700;
        }

        .pending {
            background: #fff3cd;
            color: #856404;
        }

        .approved,
        .completed {
            background: #dff4e2;
            color: #28733a;
        }

        .rejected,
        .cancelled {
            background: #fde2e2;
            color: #a12a2a;
        }

        .empty {
            text-align: center;
            padding: 50px;
            color: #718078;
        }

        body.dark {
            background: #000000;
            color: #ffffff;
        }

        body.dark .navbar,
        body.dark .table-box {
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

        body.dark th {
            background: #151515;
            color: #dddddd;
        }

        body.dark td {
            border-color: #242424;
        }

        @media (max-width: 768px) {
            .navbar {
                padding: 0 20px;
            }

            .nav-links {
                gap: 12px;
            }

            .container {
                padding: 25px 20px;
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
        <a href="{{ route('admin.orders') }}" class="nav-link active">Orders</a>
    </div>

    <button class="theme-btn" onclick="toggleTheme()">
        <i class="fa-solid fa-moon"></i> Dark Mode
    </button>
</nav>

<div class="container">

    <div class="page-header">
        <div>
            <h1>Manage Orders</h1>
            <p>View and monitor customer orders.</p>
        </div>
    </div>

    <div class="table-box">
        <table>
            <thead>
                <tr>
                    <th>Order ID</th>
                    <th>User</th>
                    <th>Total Amount</th>
                    <th>Payment</th>
                    <th>Status</th>
                    <th>Phone</th>
                    <th>Shipping Address</th>
                    <th>Date</th>
                </tr>
            </thead>

            <tbody>
                @forelse($orders as $order)
                    <tr>
                        <td>#{{ $order->id }}</td>

                        <td>
                            {{ $order->user->name ?? 'N/A' }}
                        </td>

                        <td>
                            Rs. {{ number_format($order->total_amount, 2) }}
                        </td>

                        <td>
                            {{ $order->payment_method ?? 'N/A' }}
                        </td>

                        <td>
                            <span class="status {{ strtolower($order->status) }}">
                                {{ ucfirst($order->status) }}
                            </span>
                        </td>

                        <td>
                            {{ $order->phone ?? 'N/A' }}
                        </td>

                        <td>
                            {{ $order->shipping_address ?? 'N/A' }}
                        </td>

                        <td>
                            {{ $order->created_at->format('d M Y') }}
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="8" class="empty">
                            No orders found.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
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
