<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach (config('permission-list') as $listPermission) {
            foreach ($listPermission as $permission) {
                Permission::query()->updateOrCreate([
                    'name' => $permission,
                ]);
            }
        }
    }
}
