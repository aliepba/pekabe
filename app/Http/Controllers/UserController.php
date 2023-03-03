<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use App\Services\User\UserService;
use App\Http\Resources\User\UserResource;
use App\Http\Resources\User\UserCollection;
use App\Models\MtPenyelenggara;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{

    private $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // dd(Auth::user()->roles->first()->name);
        $this->authorize('view-users', User::class);
        return view('pages.users.index', [
            'users' => new UserCollection(User::query()->with(['roles', 'penyelenggara'])->get())
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.users.create', [
            'roles' => Role::all(),
            'jenis' => MtPenyelenggara::all()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->userService->save($request);
        return redirect()->route('users.index')->with(['success', 'user berhasil ditambahkan']);
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
    public function edit(User $user)
    {
        return view('pages.users.edit', [
            'data' => new UserResource($user->load(['roles', 'penyelenggara'])),
            'roles' => Role::all(),
            'jenis' => MtPenyelenggara::all()
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $this->userService->update($request, $user);
        return redirect()->route('users.index')->with('success', 'user berhasil update');
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
