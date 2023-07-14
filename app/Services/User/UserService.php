<?php

namespace App\Services\User;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Auth;

class UserService {
    
    public function store($data){
        DB::transaction(function () use($data) {
            $user = User::query()->create([
                'name' => $data['name'],
                'email' => $data['email'],
                'password' => Hash::make($data['password']),
                'role' => 'skk-ska',
                'nik' => $data['nik'],
                'jenis' => $data['jenis'],
                'jenis_penyelenggara' => 99,
                'sijkt_pkb' => $data['id_sijkt']
            ]);

            $user->assignRole('skk-ska');
        });
    }

    public function create($data){
        DB::transaction(function() use ($data){
            $user = User::query()->create([
                'name' => $data->name,
                'email' => $data->email,
                'password' => Hash::make($data->password),
                'role' => 'sub-user',
                'jenis_penyelenggara' => Auth::user()->jenis_penyelenggara
            ]);

            $user->assignRole('sub-user');
        });
    }

    public function save(Request $request){
        DB::transaction(function () use($request){
            $user = User::query()
                        ->create([
                            'name' => $request->input('name'),
                            'email' => $request->input('email'),
                            'password' => Hash::make($request->input('password')),
                            'role' => $request->input('role'),
                            'jenis_penyelenggara' => $request->jenis_penyelenggara
                        ]);

            $user->syncRoles($request->role);
        });
    }

    public function update(Request $request, User $user){
        DB::transaction(function() use ($request, $user){
            $user->update([
                'name' => $request->name,
                'email' => $request->email,
                'role' => $request->input('role'),
                'jenis_penyelenggara' => $request->jenis_penyelenggara
            ]);

            $user->syncRoles($request->role);
        });
    }
}
