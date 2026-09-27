<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Shop fresh produce from local MarketLink vendors.">
    <title>MarketLink | Fresh from local farms</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        :root { color-scheme: light; --ink: #1b2e24; --green: #2f8f57; --green-dark: #1f6d44; --green-soft: #e9f7ee; --green-deep: #12472c; --muted: #5d7167; --line: #d7e9dc; --paper: #f4faf5; --accent: #d87a5b; --card: #fff; --warm: #f6efe6; }
        * { box-sizing: border-box; }
        body { margin: 0; color: var(--ink); background: radial-gradient(circle at top left, rgba(47,143,87,0.12), transparent 18%), linear-gradient(180deg, #edf8f0 0%, #f7faf8 28%, #f5f0e8 100%); font-family: Georgia, 'Times New Roman', serif; }
        .site-nav { height: 76px; padding-inline: clamp(18px, 5vw, 72px); display: flex; align-items: center; justify-content: space-between; gap: 24px; background: linear-gradient(135deg, rgba(255,255,255,0.98), rgba(223,246,230,0.94)); border-bottom: 1px solid var(--line); box-shadow: 0 8px 24px rgba(25,84,53,0.08); }
        .site-nav .site-brand img { width: 164px !important; }
        .nav-actions { display: flex; align-items: center; gap: 22px; font-family: Arial, sans-serif; }
        .nav-actions a { color: var(--ink); text-decoration: none; font-size: 14px; }
        .nav-actions .sign-in { color: var(--green-dark); font-weight: 700; }
        .nav-actions .register { padding: 11px 16px; color: #fff; background: linear-gradient(135deg, var(--green), var(--green-dark)); border-radius: 10px; transition: transform .2s ease, box-shadow .2s ease; box-shadow: 0 10px 20px rgba(47,143,87,0.18); }
        .nav-actions .register:hover { background: linear-gradient(135deg, var(--green-dark), var(--green)); transform: translateY(-2px); box-shadow: 0 14px 28px rgba(47,143,87,0.22); }
        .hero { min-height: 590px; position: relative; display: flex; align-items: center; overflow: hidden; color: #fff; background: linear-gradient(135deg, #1d5c36 0%, #2a8b4d 55%, #58b868 100%); animation: slideGlow 10s ease-in-out infinite alternate; }
        .hero-photo { position: absolute; inset: 0; width: 100%; height: 100%; object-fit: cover; object-position: center 54%; }
        .hero-shade { position: absolute; inset: 0; background: linear-gradient(90deg, rgba(10, 31, 19, .8) 0%, rgba(10, 31, 19, .56) 48%, rgba(10, 31, 19, .13) 100%); }
        .hero-content { position: relative; width: min(1180px, 100%); margin: 0 auto; padding: 76px 32px 90px; animation: arrive .65s ease-out both; }
        @keyframes slideGlow {
            0% { background-position: 0% 50%; }
            100% { background-position: 100% 50%; }
        }
        .eyebrow { display: flex; align-items: center; gap: 10px; margin: 0 0 20px; font: 700 12px/1.3 Arial, sans-serif; text-transform: uppercase; letter-spacing: 0; }
        .eyebrow::before { content: ''; display: inline-block; width: 9px; height: 9px; background: #e99866; border-radius: 50%; }
        .hero h1 { max-width: 760px; margin: 0; font-size: clamp(43px, 7vw, 82px); font-weight: 500; line-height: 1.02; text-wrap: balance; }
        .hero-copy { max-width: 500px; margin: 22px 0 30px; font: 17px/1.7 Arial, sans-serif; color: rgba(255,255,255,.92); }
        .hero-cta { display: inline-flex; align-items: center; min-height: 50px; padding: 0 21px; color: #fff; background: linear-gradient(135deg, var(--accent), #b95a39); text-decoration: none; font: 700 14px Arial, sans-serif; border-radius: 12px; transition: transform .2s ease, box-shadow .2s ease; box-shadow: 0 12px 24px rgba(216,122,91,0.25); }
        .hero-cta:hover { color: #fff; background: linear-gradient(135deg, #b95a39, var(--accent)); transform: translateY(-2px); }
        .hero-caption { position: absolute; right: clamp(22px, 5vw, 72px); bottom: 22px; z-index: 1; color: rgba(255,255,255,.88); font: 700 11px Arial, sans-serif; text-transform: uppercase; letter-spacing: 0; }
        @keyframes arrive { from { opacity: 0; transform: translateY(12px); } to { opacity: 1; transform: translateY(0); } }
        .content-section { width: min(1180px, 100%); margin: 0 auto; padding: 58px 32px; }
        .section-heading { display: flex; justify-content: space-between; align-items: end; gap: 20px; margin-bottom: 24px; }
        .section-heading h2 { margin: 0; font-size: 32px; font-weight: 500; }
        .section-heading a { color: var(--green); font: 700 14px Arial, sans-serif; text-decoration: none; }
        .category-list {
            display: flex;
            gap: 14px;
            overflow-x: auto;
            padding: 4px 4px 10px;
            scroll-snap-type: x proximity;
            scrollbar-width: thin;
            scrollbar-color: rgba(47,143,87,0.45) rgba(47,143,87,0.08);
            animation: slideTrack 18s ease-in-out infinite alternate;
            will-change: transform;
        }
        .category-list:hover,
        .product-grid:hover {
            animation-play-state: paused;
        }
        .category-list::-webkit-scrollbar { height: 8px; }
        .category-list::-webkit-scrollbar-thumb { background: rgba(47,143,87,0.42); border-radius: 999px; }
        .category-link {
            flex: 0 0 230px;
            min-height: 76px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 17px 18px;
            color: var(--ink);
            background: linear-gradient(135deg, #ffffff 0%, #edf9f0 100%);
            text-decoration: none;
            font: 600 15px Arial, sans-serif;
            border: 1px solid var(--line);
            border-radius: 18px;
            scroll-snap-align: start;
            transition: border-color .2s ease, transform .2s ease, box-shadow .2s ease, background .2s ease;
            box-shadow: 0 12px 22px rgba(25,85,54,0.06);
        }
        .category-link span { color: var(--green); font-size: 18px; }
        .category-link:hover { color: var(--green-dark); border-color: rgba(47,143,87,0.35); background: linear-gradient(135deg, #f1faed 0%, #def4e5 100%); transform: translateY(-3px); box-shadow: 0 16px 28px rgba(25,85,54,0.10); }
        .product-grid {
            display: flex;
            gap: 18px;
            overflow-x: auto;
            padding: 8px 4px 12px;
            scroll-snap-type: x proximity;
            scrollbar-width: thin;
            scrollbar-color: rgba(47,143,87,0.45) rgba(47,143,87,0.08);
            animation: slideTrack 22s ease-in-out infinite alternate;
            will-change: transform;
        }
        @keyframes slideTrack {
            0% { transform: translateX(0px); }
            50% { transform: translateX(-12px); }
            100% { transform: translateX(0px); }
        }
        .product-grid::-webkit-scrollbar { height: 8px; }
        .product-grid::-webkit-scrollbar-thumb { background: rgba(47,143,87,0.42); border-radius: 999px; }
        .product-card { flex: 0 0 260px; min-width: 0; background: linear-gradient(180deg, #ffffff 0%, #f8fcf9 100%); border: 1px solid var(--line); border-radius: 18px; overflow: hidden; color: inherit; text-decoration: none; transition: transform .22s ease, box-shadow .22s ease, border-color .22s ease; box-shadow: 0 16px 32px rgba(26,92,54,0.10); scroll-snap-align: start; }
        .product-card:hover { color: inherit; transform: translateY(-6px); box-shadow: 0 18px 38px rgba(26,92,54,0.14); border-color: rgba(47,143,87,0.35); }
        .product-image-frame { position: relative; overflow: hidden; background: #e7eee5; }
        .product-card img, .product-placeholder { display: block; width: 100%; aspect-ratio: 4/3; object-fit: cover; transition: transform .35s ease; }
        .product-card:hover img { transform: scale(1.045); }
        .product-category { position: absolute; left: 12px; top: 12px; z-index: 1; padding: 7px 10px; color: var(--green-dark); background: rgba(255,254,250,.95); border: 1px solid rgba(220,225,216,.8); border-radius: 8px; font: 700 10px Arial, sans-serif; text-transform: uppercase; box-shadow: 0 8px 14px rgba(26,92,54,0.08); }
        .product-placeholder { display: grid; place-items: center; background: #e7eee5; color: var(--green); font: 14px Arial, sans-serif; }
        .product-info { padding: 17px; }
        .product-info h3 { min-height: 46px; margin: 0 0 10px; font-size: 19px; font-weight: 500; line-height: 1.25; }
        .product-meta { display: flex; justify-content: space-between; gap: 10px; color: var(--muted); font: 12px Arial, sans-serif; }
        .product-stock { display: inline-flex; align-items: center; gap: 6px; }
        .product-stock::before { content: ''; width: 7px; height: 7px; background: #658c53; border-radius: 50%; }
        .product-footer { display: flex; justify-content: space-between; align-items: center; gap: 8px; margin-top: 16px; padding-top: 13px; border-top: 1px solid var(--line); }
        .product-price { color: var(--green-dark); font: 700 15px Arial, sans-serif; }
        .product-action { color: var(--green); font: 700 12px Arial, sans-serif; }
        .empty-state { padding: 28px 0; color: var(--muted); font: 15px/1.6 Arial, sans-serif; }
        .vendor-band {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 24px;
            padding: 28px 30px;
            border: 1px solid rgba(47,143,87,0.12);
            border-radius: 22px;
            background: linear-gradient(135deg, rgba(233,247,238,0.9), rgba(250,245,236,0.9));
            box-shadow: 0 18px 34px rgba(18,71,44,0.08);
        }
        .vendor-band h2 { max-width: 650px; margin: 0; font-size: 30px; font-weight: 500; }
        .vendor-band a { flex: 0 0 auto; padding: 13px 18px; background: linear-gradient(135deg, var(--green), var(--green-dark)); color: white; text-decoration: none; font: 700 14px Arial, sans-serif; border-radius: 12px; transition: transform .2s ease, box-shadow .2s ease; box-shadow: 0 12px 24px rgba(47,143,87,0.18); }
        .vendor-band a:hover { background: linear-gradient(135deg, var(--green-dark), var(--green)); transform: translateY(-2px); }
        footer { padding: 24px 32px; color: var(--muted); background: #fff; border-top: 1px solid var(--line); font: 13px Arial, sans-serif; }
        .footer-inner { width: min(1180px, 100%); margin: auto; display: flex; justify-content: space-between; gap: 16px; }
        @media (max-width: 760px) {
            .site-nav { height: 66px; }
            .site-nav .site-brand img { width: 132px !important; }
            .nav-actions { gap: 12px; }
            .nav-actions .browse-link { display: none; }
            .hero { min-height: 510px; }
            .hero-content { padding-inline: 23px; }
            .hero-copy { font-size: 15px; }
            .hero-caption { left: 23px; right: auto; font-size: 10px; }
            .content-section { padding: 42px 22px; }
            .category-list { grid-template-columns: repeat(2, minmax(0,1fr)); }
            .category-link:nth-child(2) { border-right: 0; }
            .category-link:nth-child(n+3) { border-top: 1px solid var(--line); }
            .category-link:first-child { padding-left: 14px; }
            .product-grid { grid-template-columns: repeat(2, minmax(0,1fr)); gap: 12px; }
            .product-info { padding: 12px; }
            .product-info h3 { font-size: 16px; }
            .product-meta { display: block; line-height: 1.6; }
            .vendor-band { align-items: flex-start; flex-direction: column; }
            .vendor-band h2 { font-size: 25px; }
            .footer-inner { flex-direction: column; }
        }
        @media (max-width: 390px) {
            .nav-actions { gap: 8px; }
            .nav-actions .register { padding-inline: 11px; }
            .product-grid { grid-template-columns: 1fr; }
        }
        @media (prefers-reduced-motion: reduce) {
            *, *::before, *::after { animation-duration: .01ms !important; scroll-behavior: auto !important; transition-duration: .01ms !important; }
        }
    </style>
</head>
<body>
    <header class="site-nav">
        <x-brand-logo :href="route('home')" />
        <nav class="nav-actions" aria-label="Main navigation">
            <a class="browse-link" href="{{ route('products.index') }}">Shop product</a>
            @auth
                @php
                    $dashboardRoute = match (auth()->user()->role) {
                        'admin' => 'admin.dashboard',
                        'vendor', 'farmer' => 'vendor.dashboard',
                        default => 'customer.dashboard',
                    };
                @endphp
                <a class="sign-in" href="{{ route($dashboardRoute) }}">Dashboard</a>
            @else
                <a class="sign-in" href="{{ route('login') }}">Sign in</a>
                <a class="register" href="{{ route('register') }}">Create account</a>
            @endauth
        </nav>
    </header>

    <main>
        <section class="hero">
            <img class="hero-photo" src="https://images.unsplash.com/photo-1597362925123-77861d3fbac7?auto=format&fit=crop&w=2000&q=85" alt="Fresh green vegetables at a local produce market">
            <div class="hero-shade"></div>
            <div class="hero-content">
                <p class="eyebrow">MarketLink · Local food marketplace</p>
                <h1>Fresh from local farms.</h1>
                <p class="hero-copy">Discover seasonal produce from nearby growers, with clear stock and straightforward ordering.</p>
                <a class="hero-cta" href="{{ route('products.index') }}">Browse available products</a>
            </div>
            <div class="hero-caption">Local growers · Fresh market picks</div>
        </section>

        <section class="content-section" aria-labelledby="categories-title">
            <div class="section-heading">
                <h2 id="categories-title">Shop by category</h2>
                <a href="{{ route('products.index') }}">All products</a>
            </div>
            <div class="category-list">
                @forelse($categories as $category)
                    <a class="category-link" href="{{ route('products.index', ['category_id' => $category->id]) }}">{{ $category->name }} <span aria-hidden="true">→</span></a>
                @empty
                    <a class="category-link" href="{{ route('products.index') }}">Browse products <span aria-hidden="true">→</span></a>
                @endforelse
            </div>
        </section>

        <section class="content-section" aria-labelledby="featured-title">
            <div class="section-heading">
                <h2 id="featured-title">Available now</h2>
                <a href="{{ route('products.index') }}">View all products</a>
            </div>
            @if($products->isNotEmpty())
                <div class="product-grid">
                    @foreach($products as $product)
                        <a class="product-card" href="{{ route('customer.product', $product) }}">
                            <div class="product-image-frame">
                                @if($product->image)
                                    <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}">
                                @else
                                    <span class="product-placeholder">{{ $product->category->name ?? 'Local produce' }}</span>
                                @endif
                                <span class="product-category">{{ $product->category->name ?? 'Produce' }}</span>
                            </div>
                            <div class="product-info">
                                <h3>{{ $product->name }}</h3>
                                <div class="product-meta"><span class="product-stock">{{ $product->stock }} in stock</span></div>
                                <div class="product-footer"><span class="product-price">Rs. {{ number_format($product->price, 2) }}</span><span class="product-action">View details &rarr;</span></div>
                            </div>
                        </a>
                    @endforeach
                </div>
            @else
                <p class="empty-state">No approved products are listed yet. Check back soon for fresh arrivals.</p>
            @endif
        </section>

        <section class="content-section vendor-band">
            <h2>Grow with MarketLink. List your produce for local buyers.</h2>
            <a href="{{ route('register') }}">Join as a vendor</a>
        </section>
    </main>

    <footer>
        <div class="footer-inner"><span>© {{ date('Y') }} MarketLink</span><span>Local growers · Fresh produce · Simple ordering</span></div>
    </footer>
</body>
</html>