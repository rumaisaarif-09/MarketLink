<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Reviews | MarketLink</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background: #f3f7f2; color: #263328; }
        .review { background: #fff; border: 1px solid #dfe8df; border-radius: 8px; padding: 18px; }
        .text-green { color: #47734b; }
    </style>
</head>
<body>
    <nav class="navbar bg-white border-bottom px-3 py-3"><div class="container-fluid"><x-brand-logo :href="route('vendor.dashboard')" class="navbar-brand" /><div class="d-flex gap-3"><a href="{{ route('vendor.orders.index') }}">Orders</a><a href="{{ route('vendor.profile.edit') }}">Profile</a></div></div></nav>
    <main class="container py-4" style="max-width:900px">
        <h1 class="h3 mb-4">Customer Reviews</h1>
        @if(session('success')) <div class="alert alert-success">{{ session('success') }}</div> @endif
        @foreach($reviews as $review)
            <article class="review mb-3">
                <div class="d-flex justify-content-between"><strong>{{ $review->product->name }}</strong><span>{{ $review->rating }} / 5</span></div>
                <p class="mb-2">{{ $review->comment ?: 'No written comment.' }}</p>
                <small class="text-muted">{{ $review->user->name }} · {{ $review->created_at->format('d M Y') }}</small>
                @if($review->vendor_response)
                    <p class="border-start border-success ps-3 mt-3 mb-0"><strong>Your response:</strong> {{ $review->vendor_response }}</p>
                @else
                    <form action="{{ route('vendor.reviews.respond', $review) }}" method="POST" class="mt-3">
                        @csrf
                        <label class="form-label" for="response-{{ $review->id }}">Respond to review</label>
                        <textarea class="form-control mb-2" id="response-{{ $review->id }}" name="vendor_response" rows="2" maxlength="2000" required></textarea>
                        <button class="btn btn-success btn-sm" type="submit">Post Response</button>
                    </form>
                @endif
            </article>
        @endforeach
        @if($reviews->isEmpty()) <p class="text-muted">No reviews for your products yet.</p> @endif
    </main>
</body>
</html>