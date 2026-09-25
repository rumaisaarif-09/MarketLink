<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Categories | eGreen Basket</title>

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
            --danger: #b94a48;
            --danger-light: #f4dddd;
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
            --danger: #e0706d;
            --danger-light: #321817;
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
            max-width: 1100px;
            margin: 42px auto 60px;
        }

        .page-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 20px;
            margin-bottom: 30px;
        }

        .page-title h1 {
            font-size: 34px;
            margin-bottom: 8px;
            letter-spacing: -1px;
        }

        .page-title h1 span {
            color: var(--primary);
        }

        .page-title p {
            color: var(--text-secondary);
            font-size: 14px;
        }

        .category-count {
            background: var(--primary-light);
            color: var(--primary);
            padding: 10px 15px;
            border-radius: 10px;
            font-size: 13px;
            font-weight: 700;
            white-space: nowrap;
        }

        .success-message {
            margin-bottom: 20px;
            padding: 14px 17px;
            border-radius: 12px;
            background: var(--primary-light);
            color: var(--primary-dark);
            border: 1px solid var(--border);
            font-size: 14px;
            font-weight: 700;
        }

        .content-grid {
            display: grid;
            grid-template-columns: 330px 1fr;
            gap: 22px;
            align-items: start;
        }

        .panel {
            background: var(--bg-card);
            border: 1px solid var(--border);
            border-radius: 18px;
            padding: 24px;
            box-shadow: var(--shadow);
        }

        .panel h2 {
            font-size: 19px;
            margin-bottom: 7px;
        }

        .panel-description {
            color: var(--text-secondary);
            font-size: 13px;
            line-height: 1.6;
            margin-bottom: 20px;
        }

        .form-group {
            margin-bottom: 17px;
        }

        .form-group label {
            display: block;
            margin-bottom: 8px;
            color: var(--text-main);
            font-size: 13px;
            font-weight: 700;
        }

        .form-group input {
            width: 100%;
            padding: 12px 13px;
            border: 1px solid var(--border);
            border-radius: 10px;
            background: var(--bg-soft);
            color: var(--text-main);
            outline: none;
            font-size: 14px;
            transition: 0.3s ease;
        }

        .form-group input:focus {
            border-color: var(--primary);
        }

        .error-message {
            margin-top: 6px;
            color: var(--danger);
            font-size: 12px;
        }

        .add-btn {
            width: 100%;
            border: none;
            padding: 12px 16px;
            border-radius: 10px;
            background: var(--primary);
            color: #ffffff;
            font-size: 14px;
            font-weight: 700;
            cursor: pointer;
            transition: 0.3s ease;
        }

        .add-btn:hover {
            background: var(--primary-dark);
            transform: translateY(-2px);
        }

        .table-wrapper {
            overflow-x: auto;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th {
            padding: 14px 12px;
            text-align: left;
            color: var(--text-secondary);
            background: var(--bg-soft);
            font-size: 12px;
            text-transform: uppercase;
            letter-spacing: 0.4px;
        }

        th:first-child {
            border-radius: 10px 0 0 10px;
        }

        th:last-child {
            border-radius: 0 10px 10px 0;
        }

        td {
            padding: 16px 12px;
            border-bottom: 1px solid var(--border);
            color: var(--text-main);
            font-size: 14px;
        }

        tr:last-child td {
            border-bottom: none;
        }

        .category-name {
            display: flex;
            align-items: center;
            gap: 10px;
            font-weight: 700;
        }

        .category-icon {
            width: 34px;
            height: 34px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 9px;
            background: var(--primary-light);
            color: var(--primary);
        }

        .slug {
            color: var(--text-secondary);
            font-size: 13px;
        }

        .delete-btn {
            border: 1px solid var(--danger);
            background: transparent;
            color: var(--danger);
            padding: 8px 11px;
            border-radius: 8px;
            font-size: 12px;
            font-weight: 700;
            cursor: pointer;
            transition: 0.3s ease;
        }

        .delete-btn:hover {
            background: var(--danger);
            color: #ffffff;
        }

        .empty-state {
            text-align: center;
            padding: 45px 20px;
            color: var(--text-secondary);
        }

        .empty-state i {
            font-size: 35px;
            color: var(--primary);
            margin-bottom: 12px;
        }

        .empty-state p {
            font-size: 14px;
        }

        @media (max-width: 850px) {
            .content-grid {
                grid-template-columns: 1fr;
            }
        }

        @media (max-width: 600px) {
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

            .page-header {
                flex-direction: column;
                align-items: flex-start;
            }

            .page-title h1 {
                font-size: 29px;
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

            <a href="{{ route('admin.categories') }}" class="nav-link active">
                Categories
            </a>

            <button type="button" class="theme-btn" id="themeToggle">
                Dark Mode
            </button>
        </div>
    </nav>

    <main class="container">

        <div class="page-header">
            <div class="page-title">
                <h1>
                    Manage <span>Categories</span>
                </h1>

                <p>
                    Create and manage product categories for the platform.
                </p>
            </div>

            <div class="category-count">
                {{ $categories->count() }} Categories
            </div>
        </div>

        @if(session('success'))
            <div class="success-message">
                {{ session('success') }}
            </div>
        @endif

        <div class="content-grid">

            <div class="panel">
                <h2>Add Category</h2>

                <p class="panel-description">
                    Add a new category that farmers can use when creating products.
                </p>

                <form action="{{ route('admin.categories.store') }}" method="POST">
                    @csrf

                    <div class="form-group">
                        <label for="name">Category Name</label>

                        <input
                            type="text"
                            id="name"
                            name="name"
                            placeholder="e.g. Dairy"
                            value="{{ old('name') }}"
                            required
                        >

                        @error('name')
                            <div class="error-message">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <button type="submit" class="add-btn">
                        <i class="fa-solid fa-plus"></i>
                        Add Category
                    </button>
                </form>
            </div>

            <div class="panel">
                <h2>All Categories</h2>

                <p class="panel-description">
                    Categories currently available in eGreen Basket.
                </p>

                <div class="table-wrapper">

                    @if($categories->count() > 0)

                        <table>
                            <thead>
                                <tr>
                                    <th>Category</th>
                                    <th>Slug</th>
                                    <th>Action</th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach($categories as $category)
                                    <tr>
                                        <td>
                                            <div class="category-name">
                                                <div class="category-icon">
                                                    <i class="fa-solid fa-tag"></i>
                                                </div>

                                                {{ $category->name }}
                                            </div>
                                        </td>

                                        <td>
                                            <span class="slug">
                                                {{ $category->slug }}
                                            </span>
                                        </td>

                                        <td>
                                            <form
                                                action="{{ route('admin.categories.destroy', $category->id) }}"
                                                method="POST"
                                                onsubmit="return confirm('Are you sure you want to delete this category?');"
                                            >
                                                @csrf
                                                @method('DELETE')

                                                <button type="submit" class="delete-btn">
                                                    <i class="fa-solid fa-trash"></i>
                                                    Delete
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>

                    @else

                        <div class="empty-state">
                            <i class="fa-solid fa-tags"></i>
                            <p>No categories found.</p>
                        </div>

                    @endif

                </div>
            </div>

        </div>

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
