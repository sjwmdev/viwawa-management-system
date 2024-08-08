<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Str;

function isMenuOpen($routes)
{
    foreach ($routes as $route) {
        if (Route::currentRouteName() == $route || Str::startsWith(Route::currentRouteName(), $route)) {
            return 'menu-open';
        }
    }
    return '';
}

if (!function_exists('isRouteActive')) {
    function isRouteActive($pattern)
    {
        return request()->is($pattern) ? 'active' : '';
    }
}

function asset_files($directory, $type)
{
    $files = [];

    foreach (glob(public_path($directory) . '/*.' . $type) as $file) {
        $files[] = asset($file);
    }

    return $files;
}
