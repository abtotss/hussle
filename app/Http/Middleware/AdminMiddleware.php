<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class AdminMiddleware
{
    /**
     * Allow only users with role === 'admin'.
     */
    public function handle(Request $request, Closure $next)
    {
        if (! auth()->check() || auth()->user()->role !== 'admin') {
            // redirect to user dashboard (or abort(403))
            return redirect()->route('dashboard')->with('error', 'Unauthorized.');
        }

        return $next($request);
    }
}
