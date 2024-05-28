<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
//auth
use Illuminate\Support\Facades\Auth;
// use App\Http\Controllers\AdminController;

class Admin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // //auth check if not redirect login
        // if(!Auth::check())
        // {
        //     return redirect()->route('login');
        // }

        // //get user role on $userrole var
        // $userRole = Auth::user()->role;

        // //passing request 
        // if($userRole==1)
        // {
        //     return $next($request);
        // }

        // if($userRole==2)
        // {
        //     return redirect()->route('eventadmin');
        // }
        
        // if($userRole==3)
        // {
        //     return redirect()->route('dashboard');
        // }

        // if($userRole==4)
        // {
        //     return redirect()->route('panelis');
        // }

        
        // Check if the user is authenticated
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        // Get user role
        $userRole = Auth::user()->role;

        // Handle redirection based on user role
        switch ($userRole) {
            case 1:
                return $next($request); // Admin
            case 2:
                return redirect()->route('eventadmin'); // Event Admin
            case 3:
                return redirect()->route('dashboard'); // User
            case 4:
                return redirect()->route('panelis'); // Panelis
            default:
                return redirect()->route('home'); // Fallback
        }
    }
}