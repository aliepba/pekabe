<?php

namespace App\Services\User;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserService {
    public function store($data){
        DB::transaction(function () use($data) {
            $user = User::query()->create([
                'name' => $data['name'],
                'email' => $data['email'],
                'password' => Hash::make($data['password']),
            ]);

            $user->assignRole('user');
        });
    }

    public function create($data){
        DB::transaction(function() use ($data){
            $user = User::query()->create([
                'name' => $data->name,
                'email' => $data->email,
                'password' => Hash::Make($data->password),
            ]);

            $user->assignRole('user');
        });
    }
}
