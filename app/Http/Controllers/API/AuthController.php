<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\Login\LoginService;
use App\Services\Log\LogService;

class AuthController extends Controller
{
    private $logError;
    private $loginService;

    public function __construct(LogService $logError, LoginService $loginService)
    {
        $this->loginService = $loginService;
        $this->logError = $logError;
    }

    public function ska(Request $request){
        try{
            $user = $this->loginService->apiSKA($request);
        }catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage()
            ], 403);
        } 

        return response()->json([
            'message' => 'Login Success',
            'access_token' => $user,
            'token_type' => 'Bearer'
        ]);
    }

    public function skk(Request $request){
        try{
            $user = $this->loginService->apiSKK($request);
        }catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage()
            ], 403);
        } 

        return response()->json([
            'message' => 'Login Success',
            'access_token' => $user,
            'token_type' => 'Bearer'
        ]);
    }


}
