<?php

namespace App\Services\Settings;

use App\Models\RoleMenu;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\DB;

class RoleMenuService{
    
    public function store(Request $request)
    {
        DB::beginTransaction();

        $role = Role::findById($request->role_id);
        $menu = $request->menus;
        foreach($menu as $item){
            $data = new RoleMenu();
            $data->role_id = $role->id;
            $data->menu_id = $item;
            $data->save();
        }

        DB::commit();
    }

    public function save(Request $request, $id)
    {
        DB::beginTransaction();

        $role = Role::find($id);
        RoleMenu::where('role_id', $role->id)->delete();
        $menu = $request->menus;
        foreach($menu as $item){
            $data = new RoleMenu();
            $data->role_id = $role->id;
            $data->menu_id = $item;
            $data->save();
        }

        DB::commit();
    }
}