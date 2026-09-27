@extends('layout.app')

@section('title', 'Login | MarketLink')

@section('content')
<style>
    .portal-tab {
        border: none;
        border-radius: 999px;
        font-weight: 700;
        color: #4d5f57;
        background: transparent;
        transition: all 0.2s ease;
        box-shadow: none;
    }

    .portal-tab.active {
        background: linear-gradient(135deg, #7ab68f 0%, #56a36d 100%);
        color: #ffffff;
        box-shadow: 0 10px 18px rgba(64, 129, 85, 0.16);
    }

    .portal-tab:not(.active):hover {
        background: rgba(47, 143, 87, 0.06);
        color: #264b3a;
    }
</style>
<main class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-8 col-lg-6">
            <section class="card auth-shell border-0 shadow-sm p-4 p-md-5" style="background: linear-gradient(180deg, rgba(255,255,255,0.98), rgba(242,247,244,0.98)); border: 1px solid rgba(149, 181, 160, 0.6) !important; box-shadow: 0 20px 40px rgba(24, 73, 43, 0.08) !important;">
                <div class="text-center mb-4">
                    <div class="auth-icon-wrap mx-auto mb-3" style="background: linear-gradient(135deg, rgba(47, 143, 87, 0.12), rgba(25, 86, 56, 0.10)); border: 1px solid rgba(47, 143, 87, 0.1); box-shadow: inset 0 0 0 1px rgba(47, 143, 87, 0.04);">
                        <i class="bi bi-person-badge-fill" aria-hidden="true"></i>
                    </div>
                    <p class="text-uppercase text-success fw-bold mb-2 letter-spacing">MarketLink</p>
                    <h1 class="h2 fw-bold mb-3" style="color: #1a3127;">Welcome back</h1>
                    <p class="text-muted mb-0" style="color: #5d7167 !important;">Select your portal to continue.</p>
                </div>

                <div class="d-flex justify-content-between align-items-center gap-2 mb-4 flex-wrap">
                    <ul class="nav nav-pills w-100 rounded-pill p-1" role="tablist" style="background: #edf7ef; border: 1px solid rgba(149, 181, 160, 0.45);">
                        <li class="nav-item flex-fill text-center">
                            <button class="portal-tab nav-link active w-100 rounded-pill py-2" data-role-tab="customer" data-bs-toggle="tab" data-bs-target="#customerTab" type="button" role="tab" aria-selected="true">
                                Customer
                            </button>
                        </li>
                        <li class="nav-item flex-fill text-center">
                            <button class="portal-tab nav-link w-100 rounded-pill py-2" data-role-tab="vendor" data-bs-toggle="tab" data-bs-target="#vendorTab" type="button" role="tab" aria-selected="false">
                                Vendor
                            </button>
                        </li>
                    </ul>
                </div>

                <div class="tab-content">
                    <div class="tab-pane fade show active" id="customerTab" role="tabpanel">
                        <form action="{{ route('login.customer.store') }}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label for="customer_email" class="form-label" style="color: #1d3127; font-weight: 600;">Email address</label>
                                <input id="customer_email" name="email" type="email" class="form-control" value="{{ old('email') }}" autocomplete="email" required autofocus style="background: rgba(255,255,255,0.75); border: 1px solid rgba(149, 181, 160, 0.7) !important; border-radius: 14px; padding: 0.85rem 1rem; color: #1f2d26; box-shadow: none;">
                            </div>
                            <div class="mb-3">
                                <label for="customer_password" class="form-label" style="color: #1d3127; font-weight: 600;">Password</label>
                                <input id="customer_password" name="password" type="password" class="form-control" autocomplete="current-password" required style="background: rgba(255,255,255,0.75); border: 1px solid rgba(149, 181, 160, 0.7) !important; border-radius: 14px; padding: 0.85rem 1rem; color: #1f2d26; box-shadow: none;">
                            </div>
                            <div class="form-check mb-4">
                                <input id="customer_remember" name="remember" type="checkbox" class="form-check-input" value="1" style="border-color: rgba(47, 143, 87, 0.6);">
                                <label for="customer_remember" class="form-check-label" style="color: #4d5f57;">Remember me</label>
                            </div>
                            <button type="submit" class="btn btn-success w-100 py-2" style="background: linear-gradient(135deg, #2f8f57, #1f6d44); border: none; border-radius: 14px; font-weight: 700; box-shadow: 0 12px 20px rgba(47, 143, 87, 0.18);">Sign in as Customer</button>
                        </form>
                    </div>

                    <div class="tab-pane fade" id="vendorTab" role="tabpanel">
                        <form action="{{ route('login.vendor.store') }}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label for="vendor_email" class="form-label" style="color: #1d3127; font-weight: 600;">Email address</label>
                                <input id="vendor_email" name="email" type="email" class="form-control" value="{{ old('email') }}" autocomplete="email" required style="background: rgba(255,255,255,0.75); border: 1px solid rgba(149, 181, 160, 0.7) !important; border-radius: 14px; padding: 0.85rem 1rem; color: #1f2d26; box-shadow: none;">
                            </div>
                            <div class="mb-3">
                                <label for="vendor_password" class="form-label" style="color: #1d3127; font-weight: 600;">Password</label>
                                <input id="vendor_password" name="password" type="password" class="form-control" autocomplete="current-password" required style="background: rgba(255,255,255,0.75); border: 1px solid rgba(149, 181, 160, 0.7) !important; border-radius: 14px; padding: 0.85rem 1rem; color: #1f2d26; box-shadow: none;">
                            </div>
                            <div class="form-check mb-4">
                                <input id="vendor_remember" name="remember" type="checkbox" class="form-check-input" value="1" style="border-color: rgba(47, 143, 87, 0.6);">
                                <label for="vendor_remember" class="form-check-label" style="color: #4d5f57;">Remember me</label>
                            </div>
                            <button type="submit" class="btn btn-success w-100 py-2" style="background: linear-gradient(135deg, #2f8f57, #1f6d44); border: none; border-radius: 14px; font-weight: 700; box-shadow: 0 12px 20px rgba(47, 143, 87, 0.18);">Sign in as Vendor</button>
                        </form>
                    </div>
                </div>

                @if($errors->any())
                    <div class="alert alert-danger mt-4" role="alert">{{ $errors->first() }}</div>
                @endif
            </section>
        </div>
    </div>
</main>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const tabs = document.querySelectorAll('[data-role-tab]');
        const panels = document.querySelectorAll('.tab-pane');

        function setActiveTab(targetKey) {
            tabs.forEach(function (tab) {
                const isActive = tab.dataset.roleTab === targetKey;
                tab.classList.toggle('active', isActive);
                tab.setAttribute('aria-selected', isActive ? 'true' : 'false');
            });

            panels.forEach(function (panel) {
                const isActive = panel.id === targetKey + 'Tab';
                panel.classList.toggle('show', isActive);
                panel.classList.toggle('active', isActive);
                panel.style.display = isActive ? 'block' : 'none';
            });
        }

        tabs.forEach(function (tab) {
            tab.addEventListener('click', function (event) {
                event.preventDefault();
                setActiveTab(this.dataset.roleTab);
            });
        });
    });
</script>
@endsection
