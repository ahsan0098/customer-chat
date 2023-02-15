<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class AgentVerify
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if (session()->has('user_email') && session('user_type') == "AGT") {
            return $next($request);
        } else {
            return back();
        }
    }
}
