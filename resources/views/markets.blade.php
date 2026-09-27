<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Find MarketLink vendors and their local produce markets on the map.">
    <title>Markets & Map | MarketLink</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css">
    <style>
        :root { --ink:#1e2c22; --green:#28613b; --muted:#68756b; --line:#dce1d8; --paper:#f7f6ef; --accent:#c15d40; }
        * { box-sizing:border-box; }
        body { margin:0; color:var(--ink); background:var(--paper); font-family:Georgia,'Times New Roman',serif; }
        .site-nav { min-height:76px; padding:12px clamp(18px,5vw,72px); display:flex; align-items:center; justify-content:space-between; gap:20px; background:#fffefa; border-bottom:1px solid var(--line); }
        .site-nav .site-brand img { width:164px !important; }
        .nav-links { display:flex; align-items:center; gap:20px; font:14px Arial,sans-serif; }
        .nav-links a { color:var(--ink); text-decoration:none; }
        .nav-links .nav-cta { padding:11px 15px; color:white; background:var(--green); border-radius:4px; }
        .page-intro { padding:38px clamp(22px,5vw,72px) 28px; background:#fffefa; border-bottom:1px solid var(--line); }
        .page-intro-inner { width:min(1380px,100%); margin:auto; }
        .eyebrow { margin:0 0 10px; color:var(--accent); font:700 11px Arial,sans-serif; text-transform:uppercase; }
        h1 { margin:0; font-size:clamp(34px,5vw,54px); font-weight:500; }
        .intro-copy { margin:10px 0 0; color:var(--muted); font:15px/1.6 Arial,sans-serif; }
        .map-layout { width:min(1380px,100%); margin:auto; padding:28px clamp(16px,4vw,54px) 44px; display:grid; grid-template-columns:minmax(0,1fr) 350px; gap:18px; align-items:stretch; }
        .map-panel { min-width:0; min-height:560px; position:relative; overflow:hidden; background:#e7eee5; border:1px solid var(--line); border-radius:6px; }
        #marketMap { position:absolute; inset:0; min-height:560px; }
        .map-count { position:absolute; z-index:500; top:14px; left:58px; padding:9px 12px; color:var(--ink); background:#fffefa; border:1px solid var(--line); border-radius:4px; box-shadow:0 2px 8px #1e2c2214; font:700 12px Arial,sans-serif; }
        .directory { max-height:620px; overflow:auto; background:#fffefa; border:1px solid var(--line); border-radius:6px; }
        .directory-header { position:sticky; z-index:2; top:0; padding:16px; background:#fffefa; border-bottom:1px solid var(--line); }
        .directory-header h2 { margin:0 0 12px; font-size:21px; font-weight:500; }
        .directory-header input { width:100%; height:42px; padding:0 12px; color:var(--ink); background:#fff; border:1px solid var(--line); border-radius:4px; font:14px Arial,sans-serif; }
        .market-list { padding:8px; }
        .market-item { width:100%; display:block; padding:14px; color:var(--ink); background:transparent; border:0; border-bottom:1px solid #edf0e9; text-align:left; cursor:pointer; }
        .market-item:hover,.market-item[aria-current="true"] { background:#f1f4ed; }
        .market-item:last-child { border-bottom:0; }
        .market-name { display:block; margin-bottom:6px; font-weight:700; font-size:16px; }
        .market-meta { display:block; color:var(--muted); font:12px/1.5 Arial,sans-serif; }
        .market-products { display:inline-block; margin-top:9px; padding:5px 8px; color:var(--green); background:#eaf0e7; border-radius:3px; font:700 11px Arial,sans-serif; }
        .empty-locations { padding:28px 16px; color:var(--muted); font:14px/1.65 Arial,sans-serif; }
        .leaflet-popup-content-wrapper { border-radius:5px; }
        .popup-title { margin:0 0 5px; color:var(--ink); font:700 15px Arial,sans-serif; }
        .popup-copy { margin:0 0 8px; color:var(--muted); font:12px/1.5 Arial,sans-serif; }
        .popup-link { color:var(--green); font:700 12px Arial,sans-serif; }
        footer { padding:20px clamp(18px,5vw,72px); color:var(--muted); background:#fffefa; border-top:1px solid var(--line); font:13px Arial,sans-serif; }
        .footer-inner { width:min(1380px,100%); margin:auto; display:flex; justify-content:space-between; gap:14px; }
        @media(max-width:900px) { .map-layout { grid-template-columns:1fr; } .directory { max-height:350px; } .map-panel,#marketMap { min-height:440px; } }
        @media(max-width:560px) { .site-nav { min-height:66px; } .site-nav .site-brand img { width:135px !important; } .nav-links { gap:12px; font-size:13px; } .page-intro { padding-top:30px; } .map-layout { padding-inline:12px; } .map-panel,#marketMap { min-height:390px; } .footer-inner { flex-direction:column; } }
    </style>
</head>
<body>
    <header class="site-nav">
        <x-brand-logo :href="route('home')" />
        <nav class="nav-links" aria-label="Main navigation">
            <a href="{{ route('products.index') }}">Shop produce</a>
            @auth
                <a class="nav-cta" href="{{ match(auth()->user()->role) { 'admin' => route('admin.dashboard'), 'vendor', 'farmer' => route('vendor.dashboard'), default => route('customer.dashboard') } }}">Dashboard</a>
            @else
                <a href="{{ route('login') }}">Sign in</a>
                <a class="nav-cta" href="{{ route('register') }}">Join</a>
            @endauth
        </nav>
    </header>
    <main>
        <section class="page-intro">
            <div class="page-intro-inner">
                <p class="eyebrow">Local market directory</p>
                <h1>Markets & map</h1>
                <p class="intro-copy">Find a MarketLink vendor near you and see what they have available.</p>
            </div>
        </section>
        <section class="map-layout" aria-label="Market locations">
            <div class="map-panel">
                <div id="marketMap" data-locations="{{ $locations->toJson() }}" role="application" aria-label="Map of MarketLink vendor locations"></div>
                <div class="map-count" id="mapCount">{{ $markets->count() }} mapped {{ \Illuminate\Support\Str::plural('market', $markets->count()) }}</div>
            </div>
            <aside class="directory">
                <div class="directory-header">
                    <h2>Nearby vendors</h2>
                    <input id="marketSearch" type="search" placeholder="Search market or address" aria-label="Search markets">
                </div>
                @if($markets->isNotEmpty())
                    <div class="market-list" id="marketList">
                        @foreach($markets as $index => $market)
                            <button class="market-item" type="button" data-market-index="{{ $index }}" data-search="{{ strtolower($market->market_name . ' ' . $market->market_address . ' ' . $market->name) }}">
                                <span class="market-name">{{ $market->market_name }}</span>
                                <span class="market-meta">{{ $market->market_address ?: $market->name }}</span>
                                <span class="market-products">{{ $market->available_products_count }} approved {{ \Illuminate\Support\Str::plural('product', $market->available_products_count) }}</span>
                            </button>
                        @endforeach
                    </div>
                    <p class="empty-locations d-none" id="noSearchResults">No markets match that search.</p>
                @else
                    <p class="empty-locations">No vendors have added a market location yet. Vendors can set a pin from their Profile page.</p>
                @endif
            </aside>
        </section>
    </main>
    <footer><div class="footer-inner"><span>© {{ date('Y') }} MarketLink</span><span>Vendor locations are shared by vendors.</span></div></footer>
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
    <script>
        const markets = JSON.parse(document.getElementById('marketMap').dataset.locations || '[]');
        const pakistanBounds = L.latLngBounds([23.5, 60.8], [37.2, 77.8]);
        const map = L.map('marketMap');
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            maxZoom: 19,
            attribution: '&copy; OpenStreetMap contributors',
        }).addTo(map);
        const markers = [];
        markets.forEach((market, index) => {
            const marker = L.marker([market.latitude, market.longitude]).addTo(map);
            const popup = document.createElement('div');
            const title = document.createElement('p');
            title.className = 'popup-title';
            title.textContent = market.name;
            const address = document.createElement('p');
            address.className = 'popup-copy';
            address.textContent = market.address;
            const count = document.createElement('p');
            count.className = 'popup-copy';
            count.textContent = `${market.products} approved products`;
            const link = document.createElement('a');
            link.className = 'popup-link';
            link.href = market.url;
            link.textContent = 'Browse produce';
            popup.append(title, address, count, link);
            marker.bindPopup(popup);
            markers.push(marker);

            const item = document.querySelector(`[data-market-index="${index}"]`);
            item?.addEventListener('click', () => {
                map.setView(marker.getLatLng(), 13);
                marker.openPopup();
                document.querySelectorAll('.market-item').forEach(button => button.removeAttribute('aria-current'));
                item.setAttribute('aria-current', 'true');
            });
        });

        if (markers.length > 1) {
            map.fitBounds(L.featureGroup(markers).getBounds().pad(0.18));
        } else if (markers.length === 1) {
            map.setView(markers[0].getLatLng(), 12);
        } else {
            map.fitBounds(pakistanBounds, { padding: [16, 16] });
        }

        const search = document.getElementById('marketSearch');
        search?.addEventListener('input', () => {
            const query = search.value.trim().toLowerCase();
            let visible = 0;
            document.querySelectorAll('.market-item').forEach((item, index) => {
                const matches = item.dataset.search.includes(query);
                item.classList.toggle('d-none', !matches);
                markers[index]?.setOpacity(matches ? 1 : 0.2);
                visible += matches ? 1 : 0;
            });
            document.getElementById('noSearchResults')?.classList.toggle('d-none', visible > 0);
        });
    </script>
</body>
</html>
