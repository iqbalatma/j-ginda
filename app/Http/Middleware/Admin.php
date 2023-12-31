<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Admin
{
    /**e
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    function handle(Request $request, Closure $next)
    {
        if (!empty($request->user())) {
            if ($request->user()->hasRole('administrator')) {
                return $next($request);
            } else {
                abort(403);
            }
        } else {
            return redirect('admin');
        }
    }
}
