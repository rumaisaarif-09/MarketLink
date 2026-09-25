@extends('layout.app')

@section('title', 'Sign In | MarketLink')

@section('content')
<main class="container py-5">
	<div class="row justify-content-center">
		<div class="col-sm-10 col-md-7 col-lg-5">
			<section class="card border-0 shadow-sm p-4 p-md-5">
				<div class="text-center mb-4">
					<i class="bi bi-basket2-fill text-success fs-1" aria-hidden="true"></i>
					<h1 class="h3 fw-bold mt-2">Welcome back</h1>
					<p class="text-muted mb-0">Sign in to continue to MarketLink.</p>
				</div>

				@if($errors->any())
					<div class="alert alert-danger" role="alert">{{ $errors->first() }}</div>
				@endif

				<form action="{{ route('login.store') }}" method="POST">
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
					<button type="submit" class="btn btn-success w-100 py-2">Sign in</button>
				</form>

				<p class="text-center text-muted mt-4 mb-0">New to MarketLink? <a href="{{ route('register') }}" class="link-success">Create an account</a></p>
			</section>
		</div>
	</div>
</main>
@endsection