<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
class RedirectIfAssistant
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = 'assistant')
    {
        if (Auth::guard($guard)->check()) {
            return to_route('assistant.dashboard');
        }
        return $next($request);
    }
}
