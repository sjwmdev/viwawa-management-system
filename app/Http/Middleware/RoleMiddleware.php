<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string[]  ...$roles
     * @return mixed
     */
    public function handle($request, Closure $next, ...$roles)
    {
        if (!Auth::check()) {
            return redirect('/login');
        }

        $user = User::find(Auth::id());
        if (!$user) {
            return redirect('/login');
        }

        $userRoles = $user->roles()->pluck('name')->toArray();

        foreach ($roles as $role) {
            if (in_array($role, $userRoles)) {
                return $next($request);
            }
        }

        return redirect('/dashboard')->withErrors(['error' => 'Huna ufikiaji wa sehemu hii.']);
    }
}
