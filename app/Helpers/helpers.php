<?php

/** get logged in admin */

use Illuminate\Support\Facades\Auth;

if(!function_exists('admin')) {
    function admin() {
        return Auth::guard('admin')->user();
    }
}

/** get pending kyc count */
if(!function_exists('setSidebarActive')) {
    function setSidebarActive(array $routes) : ?string
    {
        foreach($routes as $route) {
            if(request()->routeIs($route)) {
                return 'active';
            }
        }

        return null;
    }
}
