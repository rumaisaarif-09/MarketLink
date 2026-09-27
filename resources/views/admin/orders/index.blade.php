<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Orders - eGreen Basket</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background: #f3f7f2; color: #263328; }
        .text-green { color: #47734b; }
        .panel { background: #fff; border: 1px solid #e0e8df; border-radius: 8px; }
    </style>
</head>
<body>
    <nav class="navbar bg-white border-bottom px-3 py-3">
        <div class="container-fluid"><x-brand-logo :href="route('admin.dashboard')" class="navbar-brand" /><a class="btn btn-outline-success btn-sm" href="{{ route('products.index') }}">View Storefront</a></div>
    </nav>
    <main class="container-fluid p-4">
        <h1 class="h3 mb-4">Customer Orders</h1>
        @if(session('success')) <div class="alert alert-success">{{ session('success') }}</div> @endif
        <div class="panel table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-light"><tr><th>Order</th><th>Customer</th><th>Items</th><th>Total</th><th>Status</th><th>Update</th></tr></thead>
                <tbody>
                    @forelse($orders as $order)
                        <tr>
                            <td>#{{ $order->id }}</td>
                            <td>{{ $order->phone }}<br><small class="text-muted">{{ $order->shipping_address ?? $order->address }}</small></td>
                            <td>
                                @foreach($order->items as $item)
                                    <div>{{ $item->product?->name ?? 'Product' }} x {{ $item->quantity }}</div>
                                @endforeach
                            </td>
                            <td>Rs. {{ number_format($order->total_amount ?? $order->total_price ?? $order->grand_total ?? 0, 2) }}</td>
                            <td>{{ ucfirst($order->status) }}</td>
                            <td>
                                <form action="{{ route('admin.orders.updateStatus', $order->id) }}" method="POST" class="d-flex gap-2">
                                    @csrf
                                    <select name="status" class="form-select form-select-sm" aria-label="Order status">
                                        @foreach(['pending', 'processing', 'shipped', 'delivered', 'completed', 'cancelled'] as $status)
                                            <option value="{{ $status }}" @selected($order->status === $status)>{{ ucfirst($status) }}</option>
                                        @endforeach
                                    </select>
                                    <button class="btn btn-success btn-sm" type="submit">Update</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="6" class="text-center text-muted py-5">No orders yet.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </main>
</body>
</html>
