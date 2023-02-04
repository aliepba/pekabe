<?php

namespace App\Services\Login;
use App\Models\User;
use Illuminate\Http\Request;
use App\Services\User\UserService;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Auth;

class LoginService{

    private $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function setting($username, $password, $url){
        $token = env('TOKEN_SSO', '4bd75cf32d6dc78801c58f2a6862b3d1202f20282f4b0c9a061772481ba2e8fa77264fd8be894eeb');
        $response = Http::withHeaders([
            'Content-Type' => 'application/json',
            'token' => $token
        ])->post($url, [
            'username' => $username,
            'password' => $password
        ]);

        return $response;
    }

    public function ska(Request $request){
        $url = 'https://siki.pu.go.id/siki-api/pkb/v1/sso';
        $username = $request->username;
        $password = $request->password;

        try {
            $response = $this->setting($username,$password, $url);
            $dataDecoded = json_decode($response);

            if($response->failed()){
                return redirect('/pkb-siki-login');
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
                $this->userService->store($data);
            }

            $login = User::where('email', $dataDecoded->data->email)->first();

            Auth::login($login, true);
        } catch (\Throwable $th) {
            return redirect('/pkb-siki-login');
        }

    }

    public function skk(Request $request){
        $url = 'https://simpan.pu.go.id/simpan-api/pkb/v1/sso';
        $username = $request->username;
        $password = $request->password;
        try {
            $response = $this->setting($username,$password, $url);
            $dataDecoded = json_decode($response);

            if($dataDecoded->status == 'errors'){
                return redirect('/pkb-simpan-login');
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
                $this->userService->store($data);
            }

            $login = User::where('email', $dataDecoded->data->email)->first();

            Auth::login($login, true);
        } catch (\Throwable $th) {
            return redirect('/pkb-simpan-login');
        }

    }
}
