<?php

use Illuminate\Support\Facades\Auth;
use Vinkla\Hashids\Facades\Hashids;
use Carbon\Carbon;

if (!function_exists('customView')) {
    function customView($view, $data = [], $preffix = null)
    {
        if (\Request::ajax()) {
            return view(($preffix != null ? $preffix . '.' : '') . $view, $data);
        } else {
            return view(($preffix != null ? $preffix . '.' : '') . 'layouts.app', $data);
        }
    }
}

if (!function_exists('getInfoLogin')) {
    function getInfoLogin()
    {
        return Auth::user();
    }
}

if (!function_exists('getAuthPermissions')) {
    function getAuthPermissions()
    {
        $permissionsName = auth()->user()->getAllPermissions()->map(function ($perm) {
            return $perm->name;
        });
        return implode(',', $permissionsName->toArray());
    }
}