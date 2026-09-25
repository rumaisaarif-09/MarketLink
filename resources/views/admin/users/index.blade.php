<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Users | eGreen Basket</title>

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
            --shadow: 0 12px 30px rgba(0, 0, 0, 0.45);
        }

        body {
            background: var(--bg-main);
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
            background: var(--bg-card);
            border-bottom: 1px solid var(--border);
            box-shadow: 0 4px 18px rgba(0, 0, 0, 0.06);
        }

        .brand {
            text-decoration: none;
            color: var(--text-main);
        }

        .brand-name {
            font-size: 21px;
            font-weight: 800;
            letter-spacing: -0.4px;
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

        .nav-link:hover,
        .nav-link.active {
            color: var(--primary);
            background: var(--primary-light);
            transform: translateY(-2px);
        }

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

        .theme-btn:hover {
            background: var(--primary);
            color: #ffffff;
            transform: translateY(-2px);
        }

        .container {
            width: 90%;
            max-width: 1200px;
            margin: 42px auto 60px;
        }

        .page-header {
            margin-bottom: 30px;
        }

        .page-header h1 {
            font-size: 35px;
            margin-bottom: 8px;
            letter-spacing: -1px;
        }

        .page-header h1 span {
            color: var(--primary);
        }

        .page-header p {
            color: var(--text-secondary);
            font-size: 15px;
        }

        .users-card {
            background: var(--bg-card);
            border: 1px solid var(--border);
            border-radius: 18px;
            padding: 25px;
            box-shadow: var(--shadow);
            overflow-x: auto;
        }

        .card-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 22px;
        }

        .card-title {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .card-icon {
            width: 40px;
            height: 40px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 10px;
            background: var(--primary-light);
            color: var(--primary);
        }

        .card-title h2 {
            font-size: 20px;
        }

        .user-count {
            color: var(--text-secondary);
            font-size: 13px;
        }

        .users-table {
            width: 100%;
            border-collapse: collapse;
            min-width: 650px;
        }

        .users-table th {
            text-align: left;
            padding: 15px;
            background: var(--bg-soft);
            color: var(--text-secondary);
            font-size: 13px;
            font-weight: 700;
        }

        .users-table th:first-child {
            border-radius: 10px 0 0 10px;
        }

        .users-table th:last-child {
            border-radius: 0 10px 10px 0;
        }

        .users-table td {
            padding: 17px 15px;
            border-bottom: 1px solid var(--border);
            color: var(--text-main);
            font-size: 14px;
        }

        .users-table tbody tr {
            transition: 0.25s ease;
        }

        .users-table tbody tr:hover {
            background: var(--bg-soft);
        }

        .user-id {
            color: var(--text-secondary) !important;
            font-weight: 600;
        }

        .user-name {
            font-weight: 700;
        }

        .user-email {
            color: var(--text-secondary) !important;
        }

        .date {
            color: var(--text-secondary) !important;
        }

        .empty-users {
            text-align: center;
            padding: 50px 20px;
            color: var(--text-secondary);
        }

        .empty-users i {
            font-size: 35px;
            color: var(--primary);
            margin-bottom: 15px;
        }

        .empty-users h3 {
            margin-bottom: 7px;
            color: var(--text-main);
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
                font-size: 29px;
            }

            .users-card {
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

            <a href="{{ route('admin.products') }}" class="nav-link">
                Products
            </a>

            <a href="{{ route('admin.users') }}" class="nav-link active">
                Users
            </a>

            <button type="button" class="theme-btn" id="themeToggle">
                Dark Mode
            </button>

        </div>

    </nav>

    <main class="container">

        <section class="page-header">

            <h1>
                Manage <span>Users</span>
            </h1>

            <p>
                View all registered users and their account information.
            </p>

        </section>

        <section class="users-card">

            <div class="card-header">

                <div class="card-title">

                    <div class="card-icon">
                        <i class="fa-solid fa-users"></i>
                    </div>

                    <h2>Registered Users</h2>

                </div>

                <span class="user-count">
                    {{ $users->count() }} Users
                </span>

            </div>

            @if($users->count() > 0)

                <table class="users-table">

                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Registered Date</th>
                        </tr>
                    </thead>

                    <tbody>

                        @foreach($users as $user)

                            <tr>

                                <td class="user-id">
                                    #{{ $user->id }}
                                </td>

                                <td class="user-name">
                                    {{ $user->name }}
                                </td>

                                <td class="user-email">
                                    {{ $user->email }}
                                </td>

                                <td class="date">
                                    {{ $user->created_at ? $user->created_at->format('d M Y') : 'N/A' }}
                                </td>

                            </tr>

                        @endforeach

                    </tbody>

                </table>

            @else

                <div class="empty-users">

                    <i class="fa-solid fa-users"></i>

                    <h3>No Users Found</h3>

                    <p>
                        There are currently no registered users.
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
