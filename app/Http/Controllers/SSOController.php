<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use Illuminate\Http\Request;
use App\Services\User\UserService;
use Illuminate\Support\Facades\Hash;

class SSOController extends Controller
{

    private $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function view(){
        return view('auth.login-sso');
    }

    public function login(Request $request)
    {
        $this->userService->sso($request);
        return redirect(route('dashboard'));
    }

    // public function login(Request $request){
    //     $token = '45ae1456d3267ff2e9fbfa69bbd697efc479eb11f5a12bfec95a869fafc55ddf485e5ede42835d5d';
    //     $username = $request->username;
    //     $password = $request->password;
    //     $response = Http::withHeaders([
    //         'Content-Type' => 'application/json',
    //         'token' => $token
    //     ])->post('https://simpan.pu.go.id/simpan-api/v1/sso', [
    //         'username' => $username,
    //         'password' => $password
    //     ]);

    //     if($response->status(403)){
    //         return redirect(route('sso'))->with(['error' => 'Password dan username salah']);
    //     }

    //     $dataDecoded = json_decode($response);
    //     $nama = $dataDecoded->data->nama;
    //     $user = User::where('name', $nama)->first();

    //     $data = array(
    //         'name' => $nama,
    //         'email' => $nama.'@gmail.com',
    //         'password' => $password
    //     );

    //     if(!$user){
    //        $this->userService->store($data);
    //     }

    //     Auth::login($user, true);
    //     return redirect(route('dashboard'));
    // }
}
