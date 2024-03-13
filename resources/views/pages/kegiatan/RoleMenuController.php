<?php

namespace App\Http\Controllers\Setting;

use App\Http\Controllers\Controller;
use App\Models\MtMenu;
use App\Models\RoleMenu;
use App\Services\Log\LogService;
use App\Services\Settings\RoleMenuService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;

class RoleMenuController extends Controller
{
    private $logService;
    private $roleMenuService;

    public function __construct(LogService $logService,RoleMenuService $roleMenuService){
        $this->logService= $logService;
        $this->roleMenuService= $roleMenuService;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        try{
            $data = Role::with(['mns', 'mns.menu'])->get();
            return view('settings.role-menu.index', compact('data'));
        }catch (\Exception $e) {
            $this->logService->store($request, $e->getMessage(), url()->current());
            return redirect(route('error.page'))->with('error', 'Error');
        } 
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Role::all();
        $mtmenu = MtMenu::all();
        return view('settings.role-menu.add', compact('mtmenu', 'roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try{
            $this->roleMenuService->store($request);
            return redirect(route('setting.role-menu.list'))->with('success', 'successfully create role menu');
        }catch (\Exception $e) {
            DB::rollBack();
            $this->logService->store($request, $e->getMessage(), url()->current());
            return redirect(route('error.page'))->with('error', 'Error');
        } 
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
    public function edit($id)
    {
        $data = Role::with(['mns', 'mns.menu'])->find($id);
        $mtmenu = MtMenu::all();
        $roles = Role::all();
        return view('settings.role-menu.edit', compact('data', 'mtmenu', 'roles'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try{
            $this->roleMenuService->save($request, $id);
            return redirect(route('setting.role-menu.list'))->with('success', 'successfully update role menu');
        }catch (\Exception $e) {
            DB::rollBack();
            $this->logService->store($request, $e->getMessage(), url()->current());
            return redirect(route('error.page'))->with('error', 'Error');
        } 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
