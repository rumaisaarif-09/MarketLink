<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard | eGreen Basket</title>

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
            --bg-main: #eefaf1;
            --bg-card: #ffffff;
            --bg-soft: #edf7ee;
            --text-main: #183327;
            --text-secondary: #58715d;
            --primary: #2f8f57;
            --primary-dark: #1f6d44;
            --primary-light: #def6e6;
            --primary-soft: #bcebcf;
            --border: #d7e9dc;
            --shadow: 0 14px 32px rgba(26, 92, 54, 0.10);
        }

        body.dark {
            --bg-main: #071a13;
            --bg-card: #0f251a;
            --bg-soft: #122d21;
            --text-main: #edf9f1;
            --text-secondary: #b7d4c1;
            --primary: #4cd07a;
            --primary-dark: #2ca861;
            --primary-light: #173b2a;
            --primary-soft: #1b4e39;
            --border: #214a39;
            --shadow: 0 16px 36px rgba(0, 0, 0, 0.38);
        }

        body {
            background:
                radial-gradient(circle at top left, rgba(47, 143, 87, 0.12), transparent 24%),
                linear-gradient(180deg, var(--bg-main) 0%, #f8fbf9 100%);
            color: var(--text-main);
            min-height: 100vh;
            transition: background 0.35s ease, color 0.35s ease;
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
            background: linear-gradient(135deg, rgba(255,255,255,0.98), rgba(223,246,230,0.94));
            backdrop-filter: blur(8px);
            border-bottom: 1px solid var(--border);
            box-shadow: 0 8px 24px rgba(25, 84, 53, 0.08);
        }

        .brand {
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

        .nav-right {
            display: flex;
            align-items: center;
            gap: 7px;
        }

        .nav-link {
            text-decoration: none;
            color: var(--text-secondary);
            padding: 10px 13px;
            border-radius: 10px;
            font-size: 14px;
            font-weight: 700;
            transition: 0.3s ease;
        }

        .nav-link:hover,
        .nav-link.active {
            color: var(--primary-dark);
            background: linear-gradient(135deg, var(--primary-light), rgba(188, 235, 207, 0.8));
            transform: translateY(-2px);
            box-shadow: inset 0 0 0 1px rgba(47, 143, 87, 0.06);
        }

        .theme-btn {
            border: 1px solid var(--border);
            background: linear-gradient(135deg, var(--bg-soft), #ffffff);
            color: var(--text-main);
            padding: 9px 13px;
            border-radius: 10px;
            font-size: 13px;
            font-weight: 700;
            cursor: pointer;
            transition: 0.3s ease;
            box-shadow: 0 10px 18px rgba(47, 143, 87, 0.06);
        }

        .theme-btn:hover {
            background: linear-gradient(135deg, var(--primary), var(--primary-dark));
            color: #ffffff;
            transform: translateY(-2px);
        }

        .container {
            width: 90%;
            max-width: 1200px;
            margin: 42px auto 60px;
        }

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
            text-shadow: 0 8px 18px rgba(47, 143, 87, 0.18);
        }

        .welcome p {
            color: var(--text-secondary);
            font-size: 15px;
            max-width: 640px;
        }

        .cards {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 20px;
            margin-bottom: 30px;
        }

        .card {
            position: relative;
            overflow: hidden;
            background: linear-gradient(180deg, #ffffff 0%, #f7fcf8 100%);
            border: 1px solid var(--border);
            border-radius: 20px;
            padding: 24px;
            box-shadow: var(--shadow);
            transition: 0.3s ease;
        }

        .card::before {
            content: "";
            position: absolute;
            inset: 0 auto auto 0;
            width: 100%;
            height: 4px;
            background: linear-gradient(90deg, var(--primary), rgba(47, 143, 87, 0.15));
        }

        .card:hover {
            transform: translateY(-6px);
            border-color: rgba(47, 143, 87, 0.45);
            box-shadow: 0 16px 35px rgba(26, 88, 52, 0.14);
        }

        .card-icon {
            width: 48px;
            height: 48px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 17px;
            border-radius: 14px;
            background: linear-gradient(135deg, var(--primary-light), var(--primary-soft));
            color: var(--primary-dark);
            font-size: 18px;
            box-shadow: inset 0 0 0 1px rgba(47, 143, 87, 0.08);
        }

        .card h3 {
            color: var(--text-secondary);
            font-size: 14px;
            margin-bottom: 10px;
        }

        .number {
            color: var(--primary);
            font-size: 32px;
            font-weight: 800;
        }

        .content-grid {
            display: grid;
            grid-template-columns: 1.5fr 1fr;
            gap: 20px;
        }

        .panel {
            position: relative;
            background: linear-gradient(180deg, rgba(255,255,255,0.97), rgba(241,249,244,0.96));
            border: 1px solid var(--border);
            border-radius: 22px;
            padding: 25px;
            box-shadow: var(--shadow);
        }

        .panel::before {
            content: "";
            position: absolute;
            inset: 0 0 auto 0;
            height: 5px;
            background: linear-gradient(90deg, var(--primary), rgba(47, 143, 87, 0.2));
            border-radius: 22px 22px 0 0;
        }

        .panel-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 22px;
        }

        .panel-title {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .panel-title-icon {
            width: 38px;
            height: 38px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 10px;
            background: var(--primary-light);
            color: var(--primary);
        }

        .panel h2 {
            font-size: 20px;
            color: var(--text-main);
        }

        .panel-header span {
            color: var(--text-secondary);
            font-size: 13px;
        }

        .admin-links {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 12px;
        }

        .admin-link {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 15px;
            text-decoration: none;
            color: var(--text-main);
            background: linear-gradient(135deg, var(--bg-soft), #ffffff);
            border: 1px solid var(--border);
            border-radius: 12px;
            transition: 0.3s ease;
            box-shadow: 0 10px 18px rgba(47, 143, 87, 0.04);
        }

        .admin-link:hover {
            border-color: rgba(47, 143, 87, 0.35);
            color: var(--primary-dark);
            transform: translateY(-3px);
            background: linear-gradient(135deg, var(--primary-light), #ebf8ef);
        }

        .admin-link i {
            color: var(--primary);
            font-size: 17px;
            width: 22px;
            text-align: center;
        }

        .activity {
            display: flex;
            flex-direction: column;
            gap: 15px;
        }

        .activity-item {
            display: flex;
            align-items: center;
            gap: 13px;
            padding: 13px;
            background: linear-gradient(135deg, var(--bg-soft), #ffffff);
            border-radius: 11px;
            border: 1px solid rgba(47, 143, 87, 0.05);
        }

        .activity-icon {
            width: 38px;
            height: 38px;
            min-width: 38px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 10px;
            background: var(--primary-light);
            color: var(--primary);
        }

        .activity-item h4 {
            color: var(--text-main);
            font-size: 14px;
            margin-bottom: 4px;
        }

        .activity-item p {
            color: var(--text-secondary);
            font-size: 12px;
        }

        @media (max-width: 1000px) {
            .cards {
                grid-template-columns: repeat(2, 1fr);
            }

            .content-grid {
                grid-template-columns: 1fr;
            }
        }

        @media (max-width: 700px) {
            .navbar {
                padding: 12px 20px;
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

            .admin-links {
                grid-template-columns: 1fr;
            }
        }

        @media (max-width: 500px) {
            .navbar {
                padding: 12px 15px;
            }

            .brand-name {
                font-size: 18px;
            }

            .container {
                width: 92%;
                margin-top: 28px;
            }

            .panel {
                padding: 18px;
            }
        }
    </style>
</head>

<body>

    <nav class="navbar">

      
<x-brand-logo :href="route('admin.dashboard')" class="brand" />



        <div class="nav-right">

            <a href="{{ route('admin.dashboard') }}" class="nav-link active">
                Dashboard
            </a>

            <a href="{{ route('admin.products') }}" class="nav-link">
                Products
            </a>

            <a href="{{ route('admin.users') }}" class="nav-link">
                Users
            </a>

            <a href="{{ route('admin.farmers') }}" class="nav-link">
                Farmers
            </a>

            <a href="{{ route('admin.reviews.index') }}" class="nav-link">Reviews</a>

            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button class="theme-btn" type="submit">Sign Out</button>
            </form>

            <button type="button" class="theme-btn" id="themeToggle">
                Dark Mode
            </button>

        </div>

    </nav>

    <main class="container">

        <section class="welcome">

            <h1>
                Welcome to Admin
                <span>Dashboard</span>
            </h1>

            <p>
                Manage products, farmers, users and platform activities from one place.
            </p>

        </section>

        <section class="cards">

            <div class="card">

                <div class="card-icon">
                    <i class="fa-solid fa-users"></i>
                </div>

                <h3>Total Users</h3>

                <div class="number">
                    {{ $totalUsers }}
                </div>

            </div>

            <div class="card">

                <div class="card-icon">
                    <i class="fa-solid fa-tractor"></i>
                </div>

                <h3>Total Farmers</h3>

                <div class="number">
                    {{ $totalFarmers }}
                </div>

            </div>

            <div class="card">

                <div class="card-icon">
                    <i class="fa-solid fa-boxes-stacked"></i>
                </div>

                <h3>Total Products</h3>

                <div class="number">
                    {{ $totalProducts }}
                </div>

            </div>

            <div class="card">

                <div class="card-icon">
                    <i class="fa-solid fa-clock"></i>
                </div>

                <h3>Pending Products</h3>

                <div class="number">
                    {{ $pendingProducts }}
                </div>

            </div>

        </section>

        <section class="content-grid">

            <div class="panel">

                <div class="panel-header">

                    <div class="panel-title">

                        <div class="panel-title-icon">
                            <i class="fa-solid fa-layer-group"></i>
                        </div>

                        <h2>Management</h2>

                    </div>

                    <span>Admin controls</span>

                </div>

                <div class="admin-links">

                    <a href="{{ route('admin.products') }}" class="admin-link">
                        <i class="fa-solid fa-box"></i>
                        <span>Manage Products</span>
                    </a>

                    <a href="{{ route('admin.users') }}" class="admin-link">
                        <i class="fa-solid fa-users"></i>
                        <span>Manage Users</span>
                    </a>

                    <a href="{{ route('admin.farmers') }}" class="admin-link">
                        <i class="fa-solid fa-tractor"></i>
                        <span>Manage Farmers</span>
                    </a>

                    <a href="{{ route('admin.categories') }}" class="admin-link">
                        <i class="fa-solid fa-tags"></i>
                        <span>Manage Categories</span>
                    </a>

                    <a href="{{ route('admin.users') }}" class="admin-link">
                        <i class="fa-solid fa-cart-shopping"></i>
                        <span>Manage Orders</span>
                    </a>

                    <a href="{{ route('admin.users') }}" class="admin-link">
                        <i class="fa-solid fa-chart-line"></i>
                        <span>Reports</span>
                    </a>

                </div>

            </div>

            <div class="panel">

                <div class="panel-header">

                    <div class="panel-title">

                        <div class="panel-title-icon">
                            <i class="fa-solid fa-bell"></i>
                        </div>

                        <h2>Activity</h2>

                    </div>

                    <span>Overview</span>

                </div>

                <div class="activity">

                    <div class="activity-item">

                        <div class="activity-icon">
                            <i class="fa-solid fa-clock"></i>
                        </div>

                        <div>
                            <h4>Pending Products</h4>
                            <p>Products waiting for approval</p>
                        </div>

                    </div>

                    <div class="activity-item">

                        <div class="activity-icon">
                            <i class="fa-solid fa-user-plus"></i>
                        </div>

                        <div>
                            <h4>New Farmers</h4>
                            <p>Recently registered farmers</p>
                        </div>

                    </div>

                    <div class="activity-item">

                        <div class="activity-icon">
                            <i class="fa-solid fa-cart-shopping"></i>
                        </div>

                        <div>
                            <h4>Recent Orders</h4>
                            <p>Latest customer orders</p>
                        </div>

                    </div>

                </div>

            </div>

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
