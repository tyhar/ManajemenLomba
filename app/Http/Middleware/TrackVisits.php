<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\Visit;

class TrackVisits
{
    public function handle(Request $request, Closure $next)
    {
        if (auth()->check()) {
            Visit::recordVisit();
        }
        
        return $next($request);
    }
}
