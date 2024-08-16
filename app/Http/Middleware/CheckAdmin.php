<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $user = Auth::user();

        // Check if the user is logged in and their name is 'admin'
        if ($user && $user->name === 'admin') {
            return $next($request);
        }

        // Redirect or abort if the user is not 'admin'
        return redirect('/'); // You can redirect to any other page or show a 403 error
    }
}
