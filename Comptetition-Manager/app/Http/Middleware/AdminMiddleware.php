<?php

namespace App\Http\Middleware;

use Auth;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    /**
     * Gives access for the Admins pages
     * If the user is not Admin redirects them for the HomePage
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     * @return {Response} the access
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (Auth::check() && auth()->user()->user_type == "Admin") {
            return $next($request);
        }
        return redirect(route("home"))->with("message", 'Cseles vagy!');
    }
}
