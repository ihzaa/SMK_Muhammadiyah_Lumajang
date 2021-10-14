<?php

namespace Database\Seeders;

use Spatie\Permission\Models\Permission;

class createPermission {
    public static function create($permission)
    {
        $actions = ['view', 'create', 'update', 'delete', 'restore'];
        foreach ($actions as $action)
            Permission::create(['name' => $action . ' ' . $permission]);
    }
}
