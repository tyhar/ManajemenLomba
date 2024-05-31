<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class EnsureEmailIsVerified
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function handle(Request $request, Closure $next)
    {
        if (! $request->user() || ! $request->user()->hasVerifiedEmail()) {
            return $request->expectsJson()
                        ? abort(403, 'Your email address is not verified.')
                        : Redirect::route('verification.notice');
        }

        return $next($request);
    }
}
