<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'MarketLink | eGreen Basket')</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
    <!-- Leaflet OpenStreetMap CSS -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />

    <style>
        body {
            font-family: 'Poppins', sans-serif;
        }
        .bg-gradient-success {
            background: linear-gradient(135deg, #198754, #20c997);
        }
        .product-card {
            transition: all 0.3s ease;
        }
        .product-card:hover {
            transform: translateY(-5px);
        }
    </style>
    @stack('styles')
</head>
<body>

    <!-- NAVBAR -->
    <nav class="navbar navbar-expand-lg navbar-light bg-white fixed-top shadow-sm">
        <div class="container">
            <x-brand-logo :href="route('home')" class="navbar-brand" />
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mainNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="mainNav">
                <ul class="navbar-nav mx-auto fw-medium">
                    <li class="nav-item"><a class="nav-link" href="{{ url('/home') }}">Home</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ url('/markets') }}">Markets & Map</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ url('/products') }}">Products</a></li>
                </ul>
                <div class="d-flex gap-2 align-items-center">
                    @auth
                        @php($role = Auth::user()->role)
                        @if($role === 'buyer')
                            <a href="{{ route('customer.dashboard') }}" class="btn btn-outline-success btn-sm rounded-pill px-3">Customer Panel</a>
                        @elseif(in_array($role, ['vendor', 'farmer'], true))
                            <a href="{{ route('vendor.dashboard') }}" class="btn btn-outline-success btn-sm rounded-pill px-3">Vendor Panel</a>
                        @elseif($role === 'admin')
                            <a href="{{ route('admin.dashboard') }}" class="btn btn-outline-success btn-sm rounded-pill px-3">Admin Panel</a>
                        @endif

                        <form method="POST" action="{{ route('logout') }}" class="d-inline">
                            @csrf
                            <button type="submit" class="btn btn-light border btn-sm rounded-pill px-3 ms-2">Logout</button>
                        </form>
                    @else
                        <a href="{{ route('login') }}" class="btn btn-success btn-sm rounded-pill px-3">Login</a>
                    @endauth
                </div>
            </div>
        </div>
    </nav>

    <!-- MAIN CONTENT BODY -->
    <div style="margin-top: 80px; min-height: 80vh;">
        @yield('content')
    </div>

    <!-- FOOTER -->
    <footer class="bg-dark text-light pt-4 pb-3 mt-5">
        <div class="container text-center">
            <p class="text-muted small mb-0">&copy; 2026 MarketLink | eGreen Basket. TechWiz Solution.</p>
        </div>
    </footer>

    <!-- JS Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
    <script>
        document.getElementById('chatbotToggleBtn').addEventListener('click', function() {
            document.getElementById('chatbotBox').classList.toggle('d-none');
        });
        document.getElementById('closeChatbot').addEventListener('click', function() {
            document.getElementById('chatbotBox').classList.add('d-none');
        });
    </script>
    @stack('scripts')
</body>
</html>