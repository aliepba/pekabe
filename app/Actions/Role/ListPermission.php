<?php

namespace App\Actions\Role;

use Spatie\Permission\Models\Permission;
use Lorisleiva\Actions\Concerns\AsAction;

class ListPermission
{
    use AsAction;

    public function handle() :array
    {
        return [
            'allPermissions' => Permission::query()
                ->whereNotIn('name', config('permission-list.full_access_permission'))
                ->get('name'),
            'fullAccessPermission' => Permission::query()
                ->whereIn('name', config('permission-list.full_access_permission'))
                ->get('name'),
            'dashboardPermissions' => Permission::query()
                ->whereIn('name', config('permission-list.dashboard_permissions'))
                ->get('name'),
            'rolePermissions' => Permission::query()
                ->whereIn('name', config('permission-list.role_permissions'))
                ->get('name'),
            'userPermissions' => Permission::query()
                ->whereIn('name', config('permission-list.user_permissions'))
                ->get('name'),
        ];
    }
}
