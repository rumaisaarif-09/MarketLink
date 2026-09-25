<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout - E-Green</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="container my-5">
        <h2 class="mb-4">Checkout & Order Details</h2>
        <div class="row">
            <div class="col-md-6">
                <div class="card p-3 mb-3">
                    <h4>Order Summary</h4>
                    <hr>
                    @foreach($cart as $item)
                        <div class="d-flex justify-content-between">
                            <span>{{ $item['name'] }} (x{{ $item['quantity'] }})</span>
                            <span>Rs. {{ $item['price'] * $item['quantity'] }}</span>
                        </div>
                    @endforeach
                    <hr>
                    <div class="d-flex justify-content-between fw-bold">
                        <span>Total Amount:</span>
                        <span>Rs. {{ $total }}</span>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card p-3">
                    <h4>Delivery Address</h4>
                    <hr>
                    <form action="{{ route('checkout.place') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label">Phone Number</label>
                            <input type="text" name="phone" class="form-control" placeholder="03001234567" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Shipping Address</label>
                            <textarea name="address" class="form-control" rows="3" placeholder="Ghar ka address likhein..." required></textarea>
                        </div>
                        <button type="submit" class="btn btn-success w-100">Place Order (COD)</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
</html>