<?php

namespace App\Inc;

class Settings
{
    public static function getUserRoles()
    {
        return [
            'admin' => 'Admin',
            'user' => 'User',
        ];
    }

    public static function getGlobalStatus()
    {
        return [
            'active' => 'Active',
            'inactive' => 'Inactive',
        ];
    }

    public static function getDeliveryZones()
    {
        return [
            'inside_dhaka'  => 'Inside Dhaka',
            'outside_dhaka' => 'Outside Dhaka',
            'suburbs'       => 'Suburbs',
        ];
    }
}
