<?php

namespace App\Services\Login;

use App\Enums\SiJKT;
use App\Models\User;
use Illuminate\Http\Request;
use App\Services\User\UserService;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use App\Services\Login\LoginService;

class SIJKTService{

    private $ssoSiki;
    private $userService;

    public function __construct(LoginService $ssoSiki, UserService $userService)
    {
        $this->ssoSiki = $ssoSiki;
        $this->userService = $userService;
    }

    public function setting($module, $action, $query){

        $response = Http::withHeaders([
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
        ])->get(SiJKT::API() . "/$module/$action?$query");

        return $response;
    }

    public function index(Request $request){
        $token = $request->input('t');
        $response = $this->setting("User", "token", "token=" . base64_decode($token));
        $data = json_decode($response, true);
        
        $userId= $data['payload']['userId'];

        if($response['errorCode'] != 0){
            return redirect(route('sijkt'))->with('success', 'Harap Login SIJKT Terlebih dahulu');
        }

        $user = User::where('sijkt_pkb', $userId)->first();

        if(empty($user)){
            return redirect(route('sijkt.siki', ['id' => $userId, 'token' => $token]))->with('success', 'Harap Login dengan akun SKA/SKK terlebih dahulu');
        }

        $this->setting("User", "grant", "token=".base64_decode($token));
        
        Auth::login($user, true);

        return redirect(route('dashboard.tenaga.ahli'))->with('success', 'Login Berhasil');
    }

    public function connect(Request $request){
        $username = $request->username;

        $cek = substr($username, 0, 3);

        if($cek == 'SKA'){
            return $this->ska($request);
        }

        if($cek == 'SKK'){
            return $this->skk($request);
        }
    }

    public function ska(Request $request){
        $url = 'https://siki.pu.go.id/siki-api/pkb/v1/sso';
        $username = $request->username;
        $password = $request->password;
        $id = $request->id;
        $token = $request->token;
        
        $response = $this->ssoSiki->setting($username, $password, $url);
        $dataDecoded = json_decode($response);

        if($response->failed()){
            return redirect(route('sijkt.siki', ['id' => $id, 'token' => $token]))->with('success', 'Harap Login dengan akun SKA/SKK terlebih dahulu');
        }

        $data = array(
            'name' => $dataDecoded->data->nama,
            'email' => $dataDecoded->data->email,
            'password' => $password,
            'nik' => $dataDecoded->data->nik,
            'jenis' => 'ska',
            'id_sijkt' => $id
        );

        $user = User::where('email', $dataDecoded->data->email)->first();

        if(!empty($user)){
            if($user->sijkt_pkb == $id && $user->$dataDecoded->data->nik == $dataDecoded->data->email){
                return redirect(route('sijkt.siki', ['id' => $id, 'token' => $token]))->with('success', 'Akun SIKI Anda Sudah Terhubung dengan AKUN SIJKT Lain');
            }else{
                $user->update([
                    'sijkt_pkb' => $id
                ]);
            }
        }

        if(!$user){
            $this->userService->store($data);
        }

        $login = User::where('sijkt_pkb', $id)->first();

        DB::connection('siki')->statement("UPDATE user_client_sd SET sijkt_pkb = '$id' where user_client_sd.username = '$username'");

        $this->setting("User", "grant", "token=".base64_decode($token));

        Auth::login($login, true);
    }

    public function skk(Request $request){
        $url = 'https://simpan.pu.go.id/simpan-api/pkb/v1/sso';
        $username = $request->username;
        $password = $request->password;
        $id = $request->id;
        $token = $request->token;

        $response = $this->ssoSiki->setting($username, $password, $url);
        $dataDecoded = json_decode($response);

        if($response->failed()){
            return redirect(route('sijkt.siki', ['id' => $id, 'token' => $token]))->with('success', 'Harap Login dengan akun SKA/SKK terlebih dahulu');
        }

        $data = array(
            'name' => $dataDecoded->data->nama,
            'email' => $dataDecoded->data->email,
            'password' => $password,
            'nik' => $dataDecoded->data->nik,
            'jenis' => 'skk',
            'id_sijkt' => $id
        );

        $user = User::where('email', $dataDecoded->data->email)->first();

        if(!empty($user)){
            if($user->sijkt_pkb == $id && $user->$dataDecoded->data->nik == $dataDecoded->data->email){
                return redirect(route('sijkt.siki', ['id' => $id, 'token' => $token]))->with('success', 'Akun SIKI Anda Sudah Terhubung dengan AKUN SIJKT Lain');
            }else{
                $user->update([
                    'sijkt_pkb' => $id
                ]);
            }
        }

        if(!$user){
            $this->userService->store($data);
        }

        $login = User::where('sijkt_pkb', $id)->first();

        //update sijkt_pkb to simpan user_tkk 

        //above 

        $this->setting("User", "grant", "token=".base64_decode($token));

        Auth::login($login, true);

    }

}