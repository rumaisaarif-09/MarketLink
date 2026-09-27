@extends('layout.app')

@section('title', $portalTitle . ' | MarketLink')

@section('content')
<main class="container py-5">
    <div class="row justify-content-center">
        <div class="col-sm-10 col-md-7 col-lg-5">
            <section class="card border-0 shadow-sm p-4 p-md-5 auth-shell">
                <div class="text-center mb-4">
                    <div class="auth-icon-wrap mb-3">
                        <i class="bi {{ $icon }}" aria-hidden="true"></i>
                    </div>
                    <p class="text-uppercase text-success fw-bold mb-2 letter-spacing">MarketLink</p>
                    <h1 class="h3 fw-bold mt-2">{{ $portalTitle }}</h1>
                    <p class="text-muted mb-0">{{ $portalSubtitle }}</p>
                </div>

                @if($errors->any())
                    <div class="alert alert-danger" role="alert">{{ $errors->first() }}</div>
                @endif

                <form action="{{ route($loginRoute) }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="email" class="form-label">Email address</label>
                        <input id="email" name="email" type="email" class="form-control" value="{{ old('email') }}" autocomplete="email" required autofocus>
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input id="password" name="password" type="password" class="form-control" autocomplete="current-password" required>
                    </div>
                    <div class="form-check mb-4">
                        <input id="remember" name="remember" type="checkbox" class="form-check-input" value="1">
                        <label for="remember" class="form-check-label">Remember me</label>
                    </div>
                    <button type="submit" class="btn btn-success w-100 py-2">Sign in to {{ strtolower($portalTitle) }}</button>
                </form>

                @if($secondaryRoute)
                    <p class="text-center text-muted mt-4 mb-0">New to MarketLink? <a href="{{ route($secondaryRoute) }}" class="link-success">Create an account</a></p>
                @else
                    <p class="text-center text-muted mt-4 mb-0">Need a different portal? <a href="{{ route('login.customer') }}" class="link-success">Customer login</a></p>
                @endif
            </section>
        </div>
    </div>
</main>
@endsection
