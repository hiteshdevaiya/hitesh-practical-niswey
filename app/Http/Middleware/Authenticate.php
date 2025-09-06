<?php

namespace App\Http\Middleware;

use Illuminate\Support\Facades\Auth;
use Illuminate\Auth\Middleware\Authenticate as Middleware;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */
    protected function redirectTo($request)
    {
        if (!$request->expectsJson()) {
            // If the admin is not authenticated, redirect to the admin login page
            if (request()->is('admin') || request()->is('admin/*')) {
                return route('admin.login');
            }
        }

        // if (!$request->expectsJson()) {
        //     // If the company is not authenticated, redirect to the company login page
        //     if (request()->is('company') || request()->is('company/*')) {
        //         return route('company.login');
        //     }
        // }

        // if (!$request->expectsJson()) {
        //     // If the user is not authenticated, redirect to the user login page
        //     if (request()->is('user') || request()->is('user/*')) {
        //         return route('user.login');
        //     }
        // }


        if (Auth::guard('admin')->check()) {
            return route('admin.dashboard');
        }

        // if (Auth::guard('company')->check()) {
        //     return route('company.dashboard');
        // }

        // if (Auth::guard('web')->check()) {
        //     return route('user.dashboard');
        // }
    }
}
