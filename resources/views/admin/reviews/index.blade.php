<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Review Monitoring | MarketLink Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background: #f3f7f2; color: #263328; }
        .panel { background: #fff; border: 1px solid #dfe8df; border-radius: 8px; }
        .text-green { color: #47734b; }
    </style>
</head>
<body>
    <nav class="navbar bg-white border-bottom px-3 py-3"><div class="container-fluid"><x-brand-logo :href="route('admin.dashboard')" class="navbar-brand" /><a href="{{ route('admin.users') }}">Users and Access</a></div></nav>
    <main class="container py-4">
        <h1 class="h3 mb-4">Review Monitoring</h1>
        @if(session('success')) <div class="alert alert-success">{{ session('success') }}</div> @endif
        <div class="panel table-responsive">
            <table class="table align-middle mb-0">
                <thead class="table-light"><tr><th>Product</th><th>Customer</th><th>Rating</th><th>Review</th><th>Vendor reply</th><th>Visibility</th></tr></thead>
                <tbody>
                    @forelse($reviews as $review)
                        <tr>
                            <td>{{ $review->product->name }}</td>
                            <td>{{ $review->user->name }}</td>
                            <td>{{ $review->rating }} / 5</td>
                            <td>{{ $review->comment }}</td>
                            <td>{{ $review->vendor_response }}</td>
                            <td>
                                <form action="{{ route('admin.reviews.visibility', $review) }}" method="POST">
                                    @csrf
                                    @method('PATCH')
                                    <button class="btn btn-sm {{ $review->is_visible ? 'btn-outline-danger' : 'btn-outline-success' }}" type="submit">{{ $review->is_visible ? 'Hide' : 'Show' }}</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="6" class="text-center text-muted py-5">No reviews submitted yet.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </main>
</body>
</html>