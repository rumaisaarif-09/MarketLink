<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>eGreen Basket</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        :root {
            --bg-color: #F3F7F2;
            --card-bg: #FFFFFF;
            --primary-green: #588157;
            --text-color: #263328;
        }

        body {
            background-color: var(--bg-color);
            color: var(--text-color);
            font-family: Arial, sans-serif;
        }

        .navbar-custom {
            background-color: var(--card-bg);
            border-bottom: 1px solid #e2e8f0;
        }

        .btn-green {
            background-color: var(--primary-green) !important;
            color: #ffffff !important;
            border-radius: 8px;
            border: none;
        }

        .btn-green:hover {
            background-color: #466745 !important;
        }

        .card {
            background-color: var(--card-bg);
            border-radius: 12px;
            border: none;
            box-shadow: 0 2px 8px rgba(0,0,0,0.04);
        }
    </style>
</head>
<body>

    <nav class="navbar navbar-expand-lg navbar-custom px-4 py-3 mb-4">
        <a class="navbar-brand fw-bold fs-4" style="color: var(--primary-green);" href="/">eGreen Basket</a>
        <div class="ms-auto">
            <a href="/products" class="btn btn-outline-success btn-sm me-2">Products</a>
            <a href="/cart" class="btn btn-outline-success btn-sm me-2">Cart</a>
            <a href="/admin/orders" class="btn btn-green btn-sm">Admin Orders</a>
        </div>
    </nav>

    <div class="container">
        @yield('content')
    </div>

</body>
</html>