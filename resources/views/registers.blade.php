
@extends('layout.app')

@section('title', 'Create Account | MarketLink')

@section('content')
<main class="container py-5">
    <div class="row justify-content-center">
        <div class="col-sm-10 col-md-8 col-lg-6">
            <section class="card border-0 shadow-sm p-4 p-md-5">
                <div class="text-center mb-4">
                    <i class="bi bi-person-plus-fill text-success fs-1" aria-hidden="true"></i>
                    <h1 class="h3 fw-bold mt-2">Create an account</h1>
                    <p class="text-muted mb-0">Join MarketLink as a buyer or vendor.</p>
                </div>

                @if($errors->any())
                    <div class="alert alert-danger" role="alert">{{ $errors->first() }}</div>
                @endif

                <form action="{{ route('register.store') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="name" class="form-label">Full name</label>
                        <input id="name" name="name" type="text" class="form-control" value="{{ old('name') }}" autocomplete="name" required>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email address</label>
                        <input id="email" name="email" type="email" class="form-control" value="{{ old('email') }}" autocomplete="email" required>
                    </div>
                    <div class="mb-3">
                        <label for="role" class="form-label">Account type</label>
                        <select id="role" name="role" class="form-select" required>
                            <option value="buyer" @selected(old('role', 'buyer') === 'buyer')>Buyer</option>
                            <option value="vendor" @selected(old('role') === 'vendor')>Vendor</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input id="password" name="password" type="password" class="form-control" autocomplete="new-password" minlength="8" required>
                    </div>
                    <div class="mb-4">
                        <label for="password_confirmation" class="form-label">Confirm password</label>
                        <input id="password_confirmation" name="password_confirmation" type="password" class="form-control" autocomplete="new-password" minlength="8" required>
                    </div>
                    <button type="submit" class="btn btn-success w-100 py-2">Create account</button>
                </form>

                <p class="text-center text-muted mt-4 mb-0">Already registered? <a href="{{ route('login') }}" class="link-success">Sign in</a></p>
            </section>
        </div>
    </div>
</main>
@endsection