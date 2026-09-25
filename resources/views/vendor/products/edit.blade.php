<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Edit Product | eGreen Basket</title>

    <style>

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: Arial, sans-serif;
        }

        /* =========================
           THEME VARIABLES
        ========================== */

        :root {
            --bg-main: #f4f8f5;
            --bg-card: #ffffff;
            --bg-soft: #eef8f1;

            --text-main: #17251c;
            --text-secondary: #6b7280;

            --primary: #198754;
            --primary-dark: #12633d;
            --primary-light: #dff5e7;

            --border: #dce8df;

            --danger: #dc3545;

            --shadow: 0 10px 30px rgba(25, 135, 84, 0.08);
        }

        body.dark {
            --bg-main: #07150e;
            --bg-card: #0d2117;
            --bg-soft: #122d1f;

            --text-main: #f0fdf4;
            --text-secondary: #a9b9ae;

            --primary: #4ade80;
            --primary-dark: #22c55e;
            --primary-light: #163b27;

            --border: #203b2b;

            --shadow: 0 12px 35px rgba(0, 0, 0, 0.25);
        }

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
        ========================== */

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

            border-bottom: 1px solid var(--border);

            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.04);
        }

        .brand {
            display: flex;
            align-items: center;
            gap: 10px;

            text-decoration: none;

            color: var(--text-main);
        }

        .brand-icon {
            width: 38px;
            height: 38px;

            display: flex;
            align-items: center;
            justify-content: center;

            border-radius: 12px;

            background: var(--primary-light);

            font-size: 20px;

            transition: 0.3s ease;
        }

        .brand:hover .brand-icon {
            transform: rotate(-8deg) scale(1.08);
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

        .nav-link {
            text-decoration: none;

            color: var(--text-secondary);

            padding: 10px 14px;

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

            background: var(--bg-card);
            color: var(--text-main);

            padding: 9px 13px;

            border-radius: 9px;

            font-size: 14px;
            font-weight: bold;

            cursor: pointer;

            transition: 0.3s ease;
        }

        .theme-btn:hover {
            background: var(--primary-light);

            color: var(--primary);

            transform: translateY(-2px);
        }


        /* =========================
           MAIN
        ========================== */

        .container {
            width: 90%;
            max-width: 760px;

            margin: 42px auto 70px;
        }


        /* =========================
           HEADING
        ========================== */

        .page-heading {
            margin-bottom: 24px;
        }

        .page-heading small {
            display: inline-block;

            padding: 6px 11px;

            margin-bottom: 10px;

            background: var(--primary-light);
            color: var(--primary);

            border-radius: 20px;

            font-size: 11px;
            font-weight: 800;
        }

        .page-heading h1 {
            font-size: 32px;

            color: var(--text-main);

            margin-bottom: 7px;
        }

        .page-heading p {
            color: var(--text-secondary);

            font-size: 14px;
        }


        /* =========================
           FORM CARD
        ========================== */

        .form-card {
            background: var(--bg-card);

            border: 1px solid var(--border);

            padding: 32px;

            border-radius: 20px;

            box-shadow: var(--shadow);
        }


        /* =========================
           ERROR BOX
        ========================== */

        .error-box {
            background: #fff0f1;

            border: 1px solid #f3c4c8;

            color: #a51d2d;

            padding: 14px 16px;

            border-radius: 10px;

            margin-bottom: 22px;

            font-size: 13px;
        }

        body.dark .error-box {
            background: #35171b;

            border-color: #5a252b;

            color: #ff9da6;
        }

        .error-box strong {
            display: block;

            margin-bottom: 7px;
        }

        .error-box ul {
            padding-left: 18px;
        }

        .error-box li {
            margin-bottom: 3px;
        }


        /* =========================
           FORM
        ========================== */

        .form-group {
            margin-bottom: 20px;
        }

        label {
            display: block;

            margin-bottom: 8px;

            color: var(--text-main);

            font-size: 14px;

            font-weight: 700;
        }

        .required {
            color: var(--danger);
        }

        input,
        textarea,
        select {
            width: 100%;

            padding: 13px 14px;

            border: 1px solid var(--border);

            border-radius: 10px;

            background: var(--bg-main);

            color: var(--text-main);

            font-size: 14px;

            outline: none;

            transition:
                border-color 0.3s ease,
                box-shadow 0.3s ease,
                background 0.3s ease;
        }

        input::placeholder,
        textarea::placeholder {
            color: var(--text-secondary);
        }

        input:focus,
        textarea:focus,
        select:focus {
            border-color: var(--primary);

            background: var(--bg-card);

            box-shadow:
                0 0 0 3px var(--primary-light);
        }

        textarea {
            min-height: 125px;

            resize: vertical;

            line-height: 1.6;
        }

        select {
            cursor: pointer;
        }


        /* =========================
           CURRENT IMAGE
        ========================== */

        .current-image-box {
            padding: 18px;

            border: 1px solid var(--border);

            background: var(--bg-soft);

            border-radius: 14px;
        }

        .current-image {
            display: block;

            width: 220px;
            height: 150px;

            object-fit: cover;

            border-radius: 12px;

            border: 1px solid var(--border);

            margin-bottom: 10px;

            transition: 0.3s ease;
        }

        .current-image:hover {
            transform: scale(1.03);
        }

        .image-name {
            color: var(--text-secondary);

            font-size: 12px;
        }

        .no-image {
            color: var(--text-secondary);

            font-size: 13px;

            padding: 10px 0;
        }


        /* =========================
           UPLOAD
        ========================== */

        .upload-box {
            border: 1.5px dashed var(--border);

            background: var(--bg-soft);

            border-radius: 13px;

            padding: 20px;

            transition: 0.3s ease;
        }

        .upload-box:hover {
            border-color: var(--primary);

            background: var(--primary-light);
        }

        .upload-icon {
            font-size: 30px;

            margin-bottom: 8px;
        }

        .upload-text {
            color: var(--text-main);

            font-size: 13px;

            font-weight: 700;

            margin-bottom: 5px;
        }

        .upload-hint {
            color: var(--text-secondary);

            font-size: 11px;

            margin-bottom: 13px;
        }

        input[type="file"] {
            background: var(--bg-card);

            cursor: pointer;
        }


        /* =========================
           BUTTONS
        ========================== */

        .buttons {
            display: flex;

            gap: 10px;

            margin-top: 28px;
        }

        .btn {
            display: inline-flex;

            align-items: center;
            justify-content: center;

            padding: 12px 20px;

            border-radius: 10px;

            border: none;

            text-decoration: none;

            font-size: 14px;

            font-weight: 700;

            cursor: pointer;

            transition: all 0.3s ease;
        }

        .update {
            background: var(--primary);

            color: white;

            box-shadow:
                0 5px 15px rgba(25, 135, 84, 0.15);
        }

        .update:hover {
            background: var(--primary-dark);

            transform: translateY(-3px);

            box-shadow:
                0 10px 22px rgba(25, 135, 84, 0.22);
        }

        .back {
            background: var(--primary-light);

            color: var(--primary);
        }

        .back:hover {
            transform: translateY(-3px);

            background: var(--primary);

            color: white;
        }


        /* =========================
           RESPONSIVE
        ========================== */

        @media (max-width: 800px) {

            .nav-link {
                display: none;
            }

            .container {
                width: 92%;

                margin-top: 30px;
            }

        }

        @media (max-width: 550px) {

            .navbar {
                min-height: 70px;

                height: auto;

                padding: 12px 15px;
            }

            .brand-name {
                font-size: 18px;
            }

            .form-card {
                padding: 22px 18px;
            }

            .page-heading h1 {
                font-size: 27px;
            }

            .current-image {
                width: 100%;
                height: 190px;
            }

            .buttons {
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
    ========================== -->

    <nav class="navbar">

        <a
            href="{{ route('vendor.dashboard') }}"
            class="brand"
        >

            <div class="brand-icon">
                🌱
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
                🏠 Dashboard
            </a>

            <a
                href="{{ route('products.index') }}"
                class="nav-link"
            >
                🛒 My Products
            </a>

            <a
                href="{{ route('products.create') }}"
                class="nav-link"
            >
                ＋ Add Product
            </a>

            <button
                type="button"
                class="theme-btn"
                id="themeToggle"
            >
                🌙 Dark
            </button>

        </div>

    </nav>


    <!-- =========================
         MAIN CONTENT
    ========================== -->

    <div class="container">


        <div class="page-heading">
            <h1>
                Edit Product
            </h1>

            <p>
                Update your product information, price, stock or image.
            </p>

        </div>


        <div class="form-card">


            <!-- =========================
                 VALIDATION ERRORS
            ========================== -->

            @if($errors->any())

                <div class="error-box">

                    <strong>
                        Please fix the following:
                    </strong>

                    <ul>

                        @foreach($errors->all() as $error)

                            <li>
                                {{ $error }}
                            </li>

                        @endforeach

                    </ul>

                </div>

            @endif


            <!-- =========================
                 EDIT FORM
            ========================== -->

            <form
                action="{{ route('products.update', $product->id) }}"
                method="POST"
                enctype="multipart/form-data"
            >

                @csrf

                @method('PUT')


                <!-- Product Name -->

                <div class="form-group">

                    <label for="name">
                        Product Name
                        <span class="required">*</span>
                    </label>

                    <input
                        type="text"
                        id="name"
                        name="name"
                        value="{{ old('name', $product->name) }}"
                        placeholder="Enter product name"
                        required
                    >

                </div>


                <!-- Category -->

                <div class="form-group">

                    <label for="category_id">
                        Category
                        <span class="required">*</span>
                    </label>

                    <select
                        name="category_id"
                        id="category_id"
                        required
                    >

                        <option value="">
                            Select Product Category
                        </option>

                        @foreach($categories as $category)

                            <option
                                value="{{ $category->id }}"
                                {{ old('category_id', $product->category_id) == $category->id ? 'selected' : '' }}
                            >
                                {{ $category->name }}
                            </option>

                        @endforeach

                    </select>

                </div>


                <!-- Description -->

                <div class="form-group">

                    <label for="description">
                        Description
                    </label>

                    <textarea
                        name="description"
                        id="description"
                        placeholder="Describe your product..."
                    >{{ old('description', $product->description) }}</textarea>

                </div>


                <!-- Price -->

                <div class="form-group">

                    <label for="price">
                        Price (Rs.)
                        <span class="required">*</span>
                    </label>

                    <input
                        type="number"
                        id="price"
                        name="price"
                        value="{{ old('price', $product->price) }}"
                        step="0.01"
                        min="0"
                        placeholder="e.g. 250"
                        required
                    >

                </div>


                <!-- Stock -->

                <div class="form-group">

                    <label for="stock">
                        Stock Quantity
                        <span class="required">*</span>
                    </label>

                    <input
                        type="number"
                        id="stock"
                        name="stock"
                        value="{{ old('stock', $product->stock) }}"
                        min="0"
                        placeholder="e.g. 50"
                        required
                    >

                </div>


                <!-- Current Image -->

                <div class="form-group">

                    <label>
                        Current Product Image
                    </label>

                    <div class="current-image-box">

                        @if($product->image)

                            <img
                                src="{{ asset('storage/' . $product->image) }}"
                                alt="{{ $product->name }}"
                                class="current-image"
                            >

                            <div class="image-name">
                                Current image of {{ $product->name }}
                            </div>

                        @else

                            <div class="no-image">
                                🖼️ No image uploaded for this product.
                            </div>

                        @endif

                    </div>

                </div>


                <!-- Change Image -->

                <div class="form-group">

                    <label for="image">
                        Change Product Image
                    </label>

                    <div class="upload-box">

                        <div class="upload-icon">
                            🖼️
                        </div>

                        <div class="upload-text">
                            Upload a new product image
                        </div>

                        <div class="upload-hint">
                            JPG, JPEG, PNG or WEBP — maximum 2MB
                        </div>

                        <input
                            type="file"
                            id="image"
                            name="image"
                            accept=".jpg,.jpeg,.png,.webp"
                        >

                    </div>

                </div>


                <!-- Buttons -->

                <div class="buttons">

                    <button
                        type="submit"
                        class="btn update"
                    >
                        ✏️ Update Product
                    </button>

                    <a
                        href="{{ route('products.index') }}"
                        class="btn back"
                    >
                        ← Back to Products
                    </a>

                </div>

            </form>

        </div>

    </div>


    <!-- =========================
         DARK / LIGHT MODE
    ========================== -->

    <script>

        const themeToggle =
            document.getElementById("themeToggle");

        // Saved theme check karna
        const savedTheme =
            localStorage.getItem("egreen-theme");


        if (savedTheme === "dark") {

            document.body.classList.add("dark");

            themeToggle.innerHTML = "☀️ Light";

        }


        themeToggle.addEventListener("click", function () {

            document.body.classList.toggle("dark");

            // Dark mode save karna
            if (document.body.classList.contains("dark")) {

                localStorage.setItem(
                    "egreen-theme",
                    "dark"
                );

                themeToggle.innerHTML = "☀️ Light";

            } else {

                localStorage.setItem(
                    "egreen-theme",
                    "light"
                );

                themeToggle.innerHTML = "🌙 Dark";

            }

        });

    </script>


</body>

</html>

