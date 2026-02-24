<?php

use Illuminate\Support\Facades\Auth;

/** get logged in admin */
if (!function_exists('admin')) {
    function admin()
    {
        return Auth::guard('admin')->user();
    }
}

/** get pending kyc count */
if (!function_exists('setSidebarActive')) {
    function setSidebarActive(array $routes): ?string
    {
        foreach ($routes as $route) {
            if (request()->routeIs($route)) {
                return 'active';
            }
        }

        return null;
    }
}

/** get logged in user */
if (!function_exists('user')) {
    function user()
    {
        return Auth::guard('web')->user();
    }
}

/** check if it's author */
if (!function_exists('isAuthor')) {
    function isAuthor(): bool
    {
        return user()->user_type === 'author' && user()->kyc_status == 1 ? true : false;
    }
}

/** check permissions */
if (!function_exists('canAccess')) {
    function canAccess(array $permissions): bool
    {
        $permission = auth()->guard('admin')->user()->hasAnyPermission($permissions);
        $superAdmin = auth()->guard('admin')->user()->hasRole('super admin');

        if ($permission || $superAdmin) {
            return true;
        }

        return false;
    }
}

if (! function_exists('formatDate')) {
    /**
     * Format a datetime string into a readable date.
     *
     * @param  string  $date
     * @param  bool  $withTime
     * @return string
     */
    function formatDate(string $date, bool $withTime = false): string
    {
        $format = $withTime ? 'M d, Y H:i' : 'M d, Y';
        return date($format, strtotime($date));
    }
}

/** get pending kyc count */
// if(!function_exists('pendingKycCount')) {
//     function pendingKycCount() : int
//     {
//         return KycVerification::whereStatus('pending')->count();
//     }
// }
