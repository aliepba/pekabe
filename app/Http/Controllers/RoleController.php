<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\Role\RoleService;
use Spatie\Permission\Models\Role;
use App\Actions\Role\ListPermission;
use App\Http\Resources\Role\RoleResource;

class RoleController extends Controller
{
    private $roleService;

    public function __construct(RoleService $roleService)
    {
        $this->roleService = $roleService;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->authorize('view-role', Role::class);
        return view('pages.roles.index', [
            'roles' => Role::with('permissions')->orderByDesc('id')->paginate(5)
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authorize('create-role', Role::class);
        return view('pages.roles.create', ListPermission::run());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->authorize('create-role', Role::class);
        $this->roleService->store($request);
        return redirect()->route('roles.index')->with('success', 'Role created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Role $role)
    {
        $this->authorize('edit-role', Role::class);
        $role = ['role' => new RoleResource($role)];
        return view('pages.roles.edit', array_merge($role, ListPermission::run()));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Role $role)
    {
        $this->roleService->update($request, $role);
        return redirect()->route('roles.index')->with('success', 'Role update successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Role $role)
    {
        $this->authorize('delete-role', Role::class);
        $this->roleService->delete($role);
        return redirect()->route('roles.index')->with('success', 'Role has been deleted.');
    }
}
