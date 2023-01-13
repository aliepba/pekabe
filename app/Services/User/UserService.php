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
                'jenis' => $data['jenis']
            ]);

            $user->assignRole('skk-ska');
        });
    }

    public function create($data){
        DB::transaction(function() use ($data){
            $user = User::query()->create([
                'name' => $data->name,
                'email' => $data->email,
                'password' => Hash::Make($data->password),
                'role' => 'sub-user'
            ]);

            $user->assignRole('sub-user');
        });
    }

    public function sso(Request $request)
    {
        $token = '4bd75cf32d6dc78801c58f2a6862b3d1202f20282f4b0c9a061772481ba2e8fa77264fd8be894eeb';
        $username = $request->username;
        $password = $request->password;

        $response = Http::withHeaders([
            'Content-Type' => 'application/json',
            'token' => $token
        ])->post('https://siki.pu.go.id/siki-api/pkb/v1/sso', [
            'username' => $username,
            'password' => $password
        ]);

        $dataDecoded = json_decode($response);

        if($dataDecoded->status == 'errors'){
            return redirect(route('sso'))->with(['error' => 'Password dan username salah']);
        }

        $data = array(
            'name' => $dataDecoded->data->nama,
            'email' => $dataDecoded->data->email,
            'password' => $password,
            'nik' => $dataDecoded->data->nik,
            'jenis' => 'ska'
        );

        $user = User::where('email', $dataDecoded->data->email)->first();

        if(!$user){
            $data = User::create([
                'name' => $data['name'],
                'email' => $data['email'],
                'password' => Hash::make($data['password']),
                'role' => 'skk-ska',
                'nik' => $data['nik'],
                'jenis' => $data['jenis']
            ]);

            $data->assignRole('skk-ska');
        }

        $login = User::where('email', $dataDecoded->data->email)->first();

        Auth::login($login, true);
    }
}
