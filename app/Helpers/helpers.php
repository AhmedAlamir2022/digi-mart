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

/** get logged in user */
if(!function_exists('user')) {
    function user() {
        return Auth::guard('web')->user();
    }
}

/** check if it's author */
if(!function_exists('isAuthor')) {
    function isAuthor() : bool
    {
        return user()->user_type === 'author' && user()->kyc_status == 1 ? true : false;
    }
}

/** check permissions */
if(!function_exists('canAccess')) {
    function canAccess(array $permissions) : bool
    {
        $permission = auth()->guard('admin')->user()->hasAnyPermission($permissions);
        $superAdmin = auth()->guard('admin')->user()->hasRole('super admin');

        if($permission || $superAdmin) {
            return true;
        }

        return false;
    }
}
