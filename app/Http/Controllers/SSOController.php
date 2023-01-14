<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\Login\LoginService;

class SSOController extends Controller
{

    private $loginService;

    public function __construct(LoginService $loginService)
    {
        $this->loginService = $loginService;
    }

    public function view(){
        return view('auth.login-sso');
    }

    public function login(Request $request)
    {
        $this->loginService->ska($request);
        return redirect(route('dashboard'));
    }

    public function loginSKK(){
        return view('auth.login-skk');
    }

    public function skk(Request $request)
    {
        $this->loginService->skk($request);
        return redirect(route('dashboard'));
    }
}
