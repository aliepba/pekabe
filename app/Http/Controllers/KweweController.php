<?php

namespace App\Http\Controllers;

use App\Jobs\isVerifikasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;

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
            Artisan::call('queue:work');
            return response()->json([
                'message' => 'queue on running'
            ]);
        } catch (\Throwable $th) {
            return response()->json(['errors' => $th]);
        }

    }
}
