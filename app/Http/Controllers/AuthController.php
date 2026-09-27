<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthController extends Controller
{
    public function showLogin(): View
    {
        return $this->showLoginChoice();
    }

    public function showLoginChoice(): View
    {
        return view('auth.login-choice', [
            'customerRoute' => route('login.customer'),
            'vendorRoute' => route('login.vendor'),
            'adminRoute' => route('login.admin'),
        ]);
    }

    public function showCustomerLogin(): View
    {
        return $this->showPortalLogin('customer', 'Customer Portal', 'Sign in to shop, track orders, and manage favorites.', 'bi-person-circle');
    }

    public function showVendorLogin(): View
    {
        return $this->showPortalLogin('vendor', 'Vendor Portal', 'Manage products, listings, and customer orders.', 'bi-shop');
    }

    public function showAdminLogin(): View
    {
        return $this->showPortalLogin('admin', 'Admin Portal', 'Review activity, manage users, and oversee the marketplace.', 'bi-shield-check');
    }

    public function login(Request $request): RedirectResponse
    {
        return $this->authenticate($request, null, null, true);
    }

    public function loginCustomer(Request $request): RedirectResponse
    {
        return $this->authenticate($request, 'customer', 'buyer');
    }

    public function loginVendor(Request $request): RedirectResponse
    {
        return $this->authenticate($request, 'vendor', 'vendor');
    }

    public function loginAdmin(Request $request): RedirectResponse
    {
        return $this->authenticate($request, 'admin', 'admin');
    }

    public function showRegister(): View
    {
        return view('registers');
    }

    public function register(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', 'unique:users,email'],
            'role' => ['required', 'in:buyer,vendor'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        $user = User::create($validated);
        Auth::login($user);
        $request->session()->regenerate();

        return redirect()->route($user->role === 'vendor' ? 'vendor.dashboard' : 'customer.dashboard');
    }

    public function logout(Request $request): RedirectResponse
    {
        $user = Auth::user();
        $role = $user?->role ?? 'buyer';

        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route(match ($role) {
            'admin' => 'login.admin',
            'vendor', 'farmer' => 'login.vendor',
            default => 'login.customer',
        });
    }

    private function authenticate(Request $request, ?string $portalName, ?string $expectedRole, bool $allowAnyRole = false): RedirectResponse
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required', 'string'],
        ]);

        if (! Auth::attempt($credentials, $request->boolean('remember'))) {
            return back()->withErrors([
                'email' => 'These credentials do not match our records.',
            ])->onlyInput('email');
        }

        $user = Auth::user();
        if (! $user || ! $user->is_active) {
            Auth::logout();

            return back()->withErrors([
                'email' => 'This account has been disabled. Contact an administrator.',
            ])->onlyInput('email');
        }

        if (! $allowAnyRole && $expectedRole !== null && $user->role !== $expectedRole) {
            Auth::logout();

            return back()->withErrors([
                'email' => 'This account is not authorized for the '.$portalName.' portal.',
            ])->onlyInput('email');
        }

        $request->session()->regenerate();

        return redirect()->route($this->dashboardRoute($user));
    }

    private function showPortalLogin(string $role, string $title, string $subtitle, string $icon): View
    {
        return view('auth.portal-login', [
            'role' => $role,
            'portalTitle' => $title,
            'portalSubtitle' => $subtitle,
            'icon' => $icon,
            'loginRoute' => 'login.' . $role . '.store',
            'secondaryRoute' => $role === 'customer' ? 'register' : null,
        ]);
    }

    private function dashboardRoute(User $user): string
    {
        return match ($user->role) {
            'admin' => 'admin.dashboard',
            'vendor', 'farmer' => 'vendor.dashboard',
            default => 'customer.dashboard',
        };
    }
}
