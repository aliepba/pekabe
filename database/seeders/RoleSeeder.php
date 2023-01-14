<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table('roles')->truncate();
        DB::table('permissions')->truncate();
        DB::table('role_has_permissions')->truncate();
        DB::table('model_has_roles')->truncate();
        DB::table('model_has_permissions')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        $this->call(PermissionSeeder::class);

        $role = Role::where('name', 'Super Admin')->firstOrCreate([
            'name' => 'root'
        ]);

        if ($role && $user = User::where('name', 'Admin')->first()) {
            $role->givePermissionTo('full-access');
            $user->assignRole($role);
        }
    }
}
