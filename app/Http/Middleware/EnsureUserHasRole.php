<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureUserHasRole
{
    public function handle(Request $request, Closure $next, string $requiredRole): Response
    {
        $user = $request->user();

        if (! $user) {
            return redirect()->route('login');
        }

        abort_unless($user->is_active, 403, 'This account has been disabled.');

        $role = match ($user->role) {
            'customer' => 'buyer',
            'farmer' => 'vendor',
            default => $user->role,
        };

        abort_unless($role === $requiredRole, 403);

        return $next($request);
    }
}