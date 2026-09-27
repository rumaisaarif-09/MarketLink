<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use App\Models\User;

class AdminUserController extends Controller
{
    public function index()
    {
        $users = User::latest()->get();

        return view('admin.users.index', compact('users'));
    }

    public function updateRole(Request $request, User $user): RedirectResponse
    {
        abort_if($user->is(Auth::user()), 403, 'You cannot change your own role.');

        $validated = $request->validate([
            'role' => ['required', Rule::in(['buyer', 'vendor', 'admin'])],
        ]);

        $user->update($validated);

        return back()->with('success', 'User role updated.');
    }

    public function toggleAccess(User $user): RedirectResponse
    {
        abort_if($user->is(Auth::user()), 403, 'You cannot disable your own account.');

        if ($user->role === 'admin' && $user->is_active && User::where('role', 'admin')->where('is_active', true)->count() <= 1) {
            return back()->with('error', 'At least one active administrator must remain.');
        }

        $user->update(['is_active' => ! $user->is_active]);

        return back()->with('success', 'User access updated.');
    }
}
