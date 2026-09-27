<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vendor Orders | MarketLink</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background: #f3f7f2; color: #263328; }
        .panel { background: #fff; border: 1px solid #dfe8df; border-radius: 8px; }
        .text-green { color: #47734b; }
    </style>
</head>
<body>
    <nav class="navbar bg-white border-bottom px-3 py-3">
        <div class="container-fluid"><x-brand-logo :href="route('vendor.dashboard')" class="navbar-brand" /><div class="d-flex gap-3"><a href="{{ route('vendor.reviews.index') }}">Reviews</a><a href="{{ route('vendor.profile.edit') }}">Profile</a></div></div>
    </nav>
    <main class="container py-4">
        <h1 class="h3 mb-4">Orders for your products</h1>
        @if(session('success')) <div class="alert alert-success">{{ session('success') }}</div> @endif
        <div class="panel table-responsive">
            <table class="table align-middle mb-0">
                <thead class="table-light"><tr><th>Order</th><th>Buyer</th><th>Your items</th><th>Order status</th><th>Placed</th></tr></thead>
                <tbody>
                    @forelse($orders as $order)
                        <tr>
                            <td>#{{ $order->id }}</td>
                            <td>{{ $order->user?->name ?? 'Customer' }}<br><small>{{ $order->phone }}</small><br><small>{{ $order->shipping_address }}</small></td>
                            <td>
                                @foreach($order->items as $item)
                                    <div>{{ $item->product?->name ?? 'Product' }} x {{ $item->quantity }} · Rs. {{ number_format($item->price * $item->quantity, 2) }}</div>
                                @endforeach
                            </td>
                            <td>
                                <div class="d-flex align-items-center gap-2 flex-wrap">
                                    <span class="badge text-bg-secondary">{{ str_replace('_', ' ', ucfirst($order->status)) }}</span>
                                    <form action="{{ route('vendor.orders.updateStatus', $order) }}" method="POST" class="d-inline">
                                        @csrf
                                        <select name="status" class="form-select form-select-sm" onchange="this.form.submit()" aria-label="Update order status">
                                            @foreach(['pending','accepted','ready_for_pickup','completed','cancelled'] as $status)
                                                <option value="{{ $status }}" {{ $order->status === $status ? 'selected' : '' }}>{{ str_replace('_', ' ', ucfirst($status)) }}</option>
                                            @endforeach
                                        </select>
                                    </form>
                                </div>
                            </td>
                            <td>{{ $order->created_at->format('d M Y') }}</td>
                        </tr>
                    @empty
                        <tr><td colspan="5" class="text-center text-muted py-5">No orders include your products yet.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </main>
</body>
</html>