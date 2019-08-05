<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class Hades
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @param string|null $args
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (Auth::user()) {
            if (Auth::user()->clean == 0) {
                return redirect()->route('auth.fresh');
            } elseif (Auth::user()->active == 0) {
                return redirect()->route('auth.locked');
            }
            return $next($request);
        }

        return redirect()->route('auth.login')->with('loginStatus', [
            'code' => 401,
            'message' => "Silakan Login Dengan <i>Credentials</i> yang telah diberikan."
        ]);
    }
}
