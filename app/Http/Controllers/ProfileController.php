<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class ProfileController extends Controller
{
    public function edit(Request $request): View
    {
        return view('vendor.profile.edit', ['user' => $request->user()]);
    }

    public function update(Request $request): RedirectResponse
    {
        $user = $request->user();
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', Rule::unique('users')->ignore($user->id)],
            'market_name' => ['nullable', 'string', 'max:150'],
            'market_day' => ['nullable', 'string', 'in:Monday,Tuesday,Wednesday,Thursday,Friday,Saturday,Sunday'],
            'market_address' => ['nullable', 'string', 'max:255'],
            'market_latitude' => ['nullable', 'numeric', 'between:-90,90', 'required_with:market_longitude'],
            'market_longitude' => ['nullable', 'numeric', 'between:-180,180', 'required_with:market_latitude'],
            'password' => ['nullable', 'string', 'min:8', 'confirmed'],
        ]);

        if (filled($validated['password'] ?? null)) {
            $user->password = Hash::make($validated['password']);
        }

        $user->fill(collect($validated)->except('password')->all())->save();

        return back()->with('success', 'Profile updated successfully.');
    }
}