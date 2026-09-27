<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vendor Profile | MarketLink</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css">
    <style>
        body { background: #f3f7f2; color: #263328; }
        .panel { background: #fff; border: 1px solid #dfe8df; border-radius: 8px; }
        .text-green { color: #47734b; }
        #marketMap { height: 340px; border: 1px solid #dce5dc; border-radius: 6px; }
        .map-help { color: #627267; font-size: 13px; }
    </style>
</head>
<body>
    <nav class="navbar bg-white border-bottom px-3 py-3"><div class="container-fluid"><x-brand-logo :href="route('vendor.dashboard')" class="navbar-brand" /><div class="d-flex gap-3"><a href="{{ route('vendor.orders.index') }}">Orders</a><a href="{{ route('markets.index') }}">Market map</a></div></div></nav>
    <main class="container py-4" style="max-width:700px">
        <h1 class="h3 mb-4">Profile</h1>
        @if(session('success')) <div class="alert alert-success">{{ session('success') }}</div> @endif
        @if($errors->any()) <div class="alert alert-danger">{{ $errors->first() }}</div> @endif
        <form class="panel p-4" action="{{ route('vendor.profile.update') }}" method="POST">
            @csrf
            @method('PUT')
            <div class="mb-3"><label class="form-label" for="name">Name</label><input class="form-control" id="name" name="name" value="{{ old('name', $user->name) }}" required></div>
            <div class="mb-3"><label class="form-label" for="email">Email</label><input class="form-control" type="email" id="email" name="email" value="{{ old('email', $user->email) }}" required></div>
            <hr>
            <h2 class="h5">Market location</h2>
            <p class="map-help">Set your public market pin so customers can find your location. Click the map or drag the pin to adjust it.</p>
            <div class="mb-3"><label class="form-label" for="market_name">Market name</label><input class="form-control" id="market_name" name="market_name" value="{{ old('market_name', $user->market_name) }}" maxlength="150" placeholder="Farm or market name"></div>
            <div class="mb-3"><label class="form-label" for="market_day">Operating day</label>
                <select class="form-select" id="market_day" name="market_day">
                    <option value="">Select a day</option>
                    @foreach(['Monday','Tuesday','Wednesday','Thursday','Friday','Saturday','Sunday'] as $day)
                        <option value="{{ $day }}" {{ old('market_day', $user->market_day) === $day ? 'selected' : '' }}>{{ $day }}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3"><label class="form-label" for="market_address">Market address</label><input class="form-control" id="market_address" name="market_address" value="{{ old('market_address', $user->market_address) }}" maxlength="255" placeholder="Street, town, city"></div>
            <div id="marketMap" class="mb-2" aria-label="Choose your market location on the map"></div>
            <div class="row g-2 mb-3">
                <div class="col-sm-6"><label class="form-label" for="market_latitude">Latitude</label><input class="form-control" id="market_latitude" name="market_latitude" type="number" step="any" min="-90" max="90" value="{{ old('market_latitude', $user->market_latitude) }}"></div>
                <div class="col-sm-6"><label class="form-label" for="market_longitude">Longitude</label><input class="form-control" id="market_longitude" name="market_longitude" type="number" step="any" min="-180" max="180" value="{{ old('market_longitude', $user->market_longitude) }}"></div>
            </div>
            <hr>
            <p class="text-muted">Leave password fields empty to keep your current password.</p>
            <div class="mb-3"><label class="form-label" for="password">New password</label><input class="form-control" type="password" id="password" name="password" autocomplete="new-password"></div>
            <div class="mb-3"><label class="form-label" for="password_confirmation">Confirm new password</label><input class="form-control" type="password" id="password_confirmation" name="password_confirmation" autocomplete="new-password"></div>
            <button class="btn btn-success" type="submit">Save Profile</button>
        </form>
    </main>
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
    <script>
        const latitudeInput = document.getElementById('market_latitude');
        const longitudeInput = document.getElementById('market_longitude');
        const hasLocation = latitudeInput.value !== '' && longitudeInput.value !== '';
        const initialPoint = hasLocation
            ? [Number(latitudeInput.value), Number(longitudeInput.value)]
            : [30.3753, 69.3451];
        const map = L.map('marketMap').setView(initialPoint, hasLocation ? 12 : 5);
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            maxZoom: 19,
            attribution: '&copy; OpenStreetMap contributors',
        }).addTo(map);

        let marker = null;
        const updateLocation = (point) => {
            latitudeInput.value = point.lat.toFixed(7);
            longitudeInput.value = point.lng.toFixed(7);

            if (marker) {
                marker.setLatLng(point);
            } else {
                marker = L.marker(point, { draggable: true }).addTo(map);
                marker.on('dragend', (event) => updateLocation(event.target.getLatLng()));
            }
        };

        if (hasLocation) {
            updateLocation(L.latLng(initialPoint[0], initialPoint[1]));
        }

        map.on('click', (event) => updateLocation(event.latlng));
    </script>
</body>
</html>