<?php

use App\Models\CartItem;
use App\Models\Item;
use App\Models\KycVerification;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

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
if (!function_exists('pendingKycCount')) {
    function pendingKycCount(): int
    {
        return KycVerification::whereStatus('pending')->count();
    }
}

/** get icon for items */
if (!function_exists('getIcon')) {
    function getIcon($mimeType): string
    {
        $fileIcon = 'bi-file-earmark';

        if (str_starts_with($mimeType, 'image/')) {
            $fileIcon = "bi-file-earmark-image";
        } elseif (str_starts_with($mimeType, 'video/')) {
            $fileIcon = "bi-file-earmark-play";
        } elseif (str_starts_with($mimeType, 'audio/')) {
            $fileIcon = "bi-file-earmark-music";
        } elseif (str_starts_with($mimeType, 'pdf')) {
            $fileIcon = "bi-file-earmark-pdf";
        } elseif (str_starts_with($mimeType, 'text/')) {
            $fileIcon = "bi-file-earmark-text";
        } elseif (str_starts_with($mimeType, 'application/')) {
            $fileIcon = "bi-file-earmark-zip";
        }

        return $fileIcon;
    }
}

/** get human readable size */
if (!function_exists('formatSize')) {
    function formatSize($bytes, $decimalPlaces = 2)
    {
        if ($bytes < 0) {
            return 0;
        }

        $sizes = ['B', 'KB', 'MB', 'GB', 'TB', 'PB'];
        $factor = floor((strlen($bytes) - 1) / 3);
        $formattedSize = $bytes / pow(1024, $factor);

        return round($formattedSize, $decimalPlaces) . $sizes[$factor];
    }
}

/** get item status count */
if (!function_exists('getItemStatusCount')) {
    function getItemStatusCount(string $status): int
    {
        return Item::select('status')->where('status', $status)->count();
    }
}

/** get item status count */
if (!function_exists('getFileSize')) {
    function getFileSize(string $path): string
    {
        try {
            return formatSize(File::size(storage_path('app/private/' . $path)));
        } catch (\Exception $e) {
            return '0B';
        }
    }
}

/** get item status count */
if (!function_exists('getCartCount')) {
    function getCartCount(): int
    {
        return CartItem::where('user_id', user()->id)->count();
    }
}

/** get item status count */
if (!function_exists('getCartTotal')) {
    function getCartTotal(): int | float
    {

        $total = 0;

        $cartItems = CartItem::with('item')->where('user_id', user()->id)->get();
        foreach ($cartItems as $cartItem) {
            if ($cartItem->item->discount_price > 0) {
                $total += $cartItem->item->discount_price;
            } else {
                $total += $cartItem->item->price;
            }
        }

        return $total;
    }
}

/** get item status count */
if (!function_exists('getCartItems')) {
    function getCartItems(): Collection
    {
        return CartItem::where('user_id', user()->id)->get();
    }
}

/** currency position */
if(!function_exists('currencyPosition')) {
    function currencyPosition($amount) : string
    {
        return config('settings.currency_position') == 'left' ? config('settings.currency_icon') . $amount : $amount . config('settings.currency_icon');
    }
}
