<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Add Product | eGreen Basket</title>

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

            --primary: #588157;
            --primary-dark: #456a47;
            --primary-light: #263b29;

            --border: #292929;

            --danger: #ef5350;

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

            color: #ffffff;

            transform: translateY(-2px);
        }


        /* =========================
           MAIN CONTAINER
        ========================= */

        .container {
            width: 90%;

            max-width: 760px;

            margin: 42px auto 70px;
        }


        /* =========================
           PAGE HEADING
        ========================= */

        .page-heading {
            margin-bottom: 24px;
        }


        .page-heading small {
            display: inline-flex;

            align-items: center;

            gap: 7px;

            padding: 7px 12px;

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
        ========================= */

        .form-card {
            background: var(--bg-card);

            border: 1px solid var(--border);

            padding: 32px;

            border-radius: 20px;

            box-shadow: var(--shadow);

            transition: 0.35s ease;
        }


        /* =========================
           ERROR BOX
        ========================= */

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
            background: #241416;

            border-color: #4d2428;

            color: #ff9da6;
        }


        .error-title {
            display: flex;

            align-items: center;

            gap: 8px;

            margin-bottom: 8px;
        }


        .error-box strong {
            font-size: 13px;
        }


        .error-box ul {
            padding-left: 22px;
        }


        .error-box li {
            margin-bottom: 4px;
        }


        /* =========================
           FORM GROUP
        ========================= */

        .form-group {
            margin-bottom: 21px;
        }


        label {
            display: flex;

            align-items: center;

            gap: 7px;

            margin-bottom: 8px;

            color: var(--text-main);

            font-size: 14px;

            font-weight: 700;
        }


        label i {
            color: var(--primary);

            font-size: 13px;
        }


        .required {
            color: var(--danger);
        }


        /* =========================
           INPUTS
        ========================= */

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
           IMAGE UPLOAD
        ========================= */

        .upload-box {
            position: relative;

            border: 1.5px dashed var(--border);

            background: var(--bg-soft);

            border-radius: 13px;

            padding: 22px;

            transition: 0.3s ease;
        }


        .upload-box:hover {
            border-color: var(--primary);

            background: var(--primary-light);
        }


        .upload-icon {
            width: 48px;
            height: 48px;

            display: flex;

            align-items: center;
            justify-content: center;

            border-radius: 12px;

            background: var(--primary-light);

            color: var(--primary);

            font-size: 21px;

            margin-bottom: 11px;
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


        input[type="file"]::file-selector-button {
            border: none;

            background: var(--primary);

            color: white;

            padding: 8px 12px;

            border-radius: 7px;

            margin-right: 10px;

            cursor: pointer;

            font-weight: 700;
        }


        /* =========================
           BUTTONS
        ========================= */

        .buttons {
            display: flex;

            gap: 10px;

            margin-top: 28px;
        }


        .btn {
            display: inline-flex;

            align-items: center;

            justify-content: center;

            gap: 8px;

            padding: 12px 20px;

            border-radius: 10px;

            border: none;

            text-decoration: none;

            font-size: 14px;

            font-weight: 700;

            cursor: pointer;

            transition: 0.3s ease;
        }


        .save {
            background: var(--primary);

            color: white;

            box-shadow:
                0 5px 15px rgba(88, 129, 87, 0.18);
        }


        .save:hover {
            background: var(--primary-dark);

            transform: translateY(-3px);

            box-shadow:
                0 10px 22px rgba(88, 129, 87, 0.25);
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
        ========================= */

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
                class="nav-link"
            >
                <i class="fa-solid fa-box-open"></i>
                My Products
            </a>


            <a
                href="{{ route('products.create') }}"
                class="nav-link active"
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


        <!-- PAGE HEADING -->

        <div class="page-heading">

           
            <h1>
                Add New Product
            </h1>


            <p>
                Add your fresh food item to your eGreen Basket store.
            </p>

        </div>


        <!-- FORM CARD -->

        <div class="form-card">


            <!-- =========================
                 VALIDATION ERRORS
            ========================== -->

            @if($errors->any())

                <div class="error-box">

                    <div class="error-title">

                        <i class="fa-solid fa-circle-exclamation"></i>

                        <strong>
                            Please fix the following:
                        </strong>

                    </div>


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
                 PRODUCT FORM
            ========================== -->

            <form
                action="{{ route('products.store') }}"
                method="POST"
                enctype="multipart/form-data"
            >

                @csrf


                <!-- Product Name -->

                <div class="form-group">

                    <label for="name">

                        <i class="fa-solid fa-tag"></i>

                        Product Name

                        <span class="required">*</span>

                    </label>


                    <input
                        type="text"
                        id="name"
                        name="name"
                        value="{{ old('name') }}"
                        placeholder="e.g. Fresh Tomatoes"
                        required
                    >

                </div>


                <!-- Category -->

                <div class="form-group">

                    <label for="category_id">

                        <i class="fa-solid fa-layer-group"></i>

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
                                {{ old('category_id') == $category->id ? 'selected' : '' }}
                            >
                                {{ $category->name }}
                            </option>

                        @endforeach

                    </select>

                </div>


                <!-- Description -->

                <div class="form-group">

                    <label for="description">

                        <i class="fa-solid fa-align-left"></i>

                        Description

                    </label>


                    <textarea
                        name="description"
                        id="description"
                        placeholder="Describe your product, freshness, quality and usage..."
                    >{{ old('description') }}</textarea>

                </div>


                <!-- Price -->

                <div class="form-group">

                    <label for="price">

                        <i class="fa-solid fa-money-bill-wave"></i>

                        Price (Rs.)

                        <span class="required">*</span>

                    </label>


                    <input
                        type="number"
                        id="price"
                        name="price"
                        value="{{ old('price') }}"
                        step="0.01"
                        min="0"
                        placeholder="e.g. 250"
                        required
                    >

                </div>


                <!-- Stock -->

                <div class="form-group">

                    <label for="stock">

                        <i class="fa-solid fa-boxes-stacked"></i>

                        Stock Quantity

                        <span class="required">*</span>

                    </label>


                    <input
                        type="number"
                        id="stock"
                        name="stock"
                        value="{{ old('stock') }}"
                        min="0"
                        placeholder="e.g. 50"
                        required
                    >

                </div>


                <!-- Product Image -->

                <div class="form-group">

                    <label for="image">

                        <i class="fa-solid fa-image"></i>

                        Product Image

                    </label>


                    <div class="upload-box">

                        <div class="upload-icon">

                            <i class="fa-solid fa-cloud-arrow-up"></i>

                        </div>


                        <div class="upload-text">
                            Upload your product image
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
                        class="btn save"
                    >

                        <i class="fa-solid fa-circle-plus"></i>

                        Add Product

                    </button>


                    <a
                        href="{{ route('products.index') }}"
                        class="btn back"
                    >

                        <i class="fa-solid fa-arrow-left"></i>

                        Back to Products

                    </a>

                </div>

            </form>

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
