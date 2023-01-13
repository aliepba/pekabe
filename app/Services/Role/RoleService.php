<?php

namespace App\Services\Role;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\DB;

class RoleService {
    public function store(Request $request){
        DB::transaction(function()use ($request){
            $role = Role::create($request->only('name'));

            $role->syncPermissions($request->permissions);
        });
    }

    public function update(Request $request, Role $role){
        DB::transaction(function() use ($request, $role){
            $role->update($request->only('name', 'guard_name'));

            $role->syncPermissions($request->permissions);
        });
    }

    public function delete(Role $role){
        DB::transaction(function () use($role){
            $role->permissions()->detach();

            $role->delete();
        });
    }
}
