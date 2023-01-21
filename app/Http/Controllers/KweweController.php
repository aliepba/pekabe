<?php

namespace App\Http\Controllers;

use App\Jobs\isVerifikasi;
use Illuminate\Http\Request;

class KweweController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        try {
            isVerifikasi::dispatch();
            return response()->json([
                'message' => 'penilaian on running bitch'
            ]);
        } catch (\Throwable $th) {
            return response()->json(['errors' => $th]);
        }

    }
}
