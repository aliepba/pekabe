<?php 

namespace App\Services\Log;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\LogError;

class LogService{
    
    public function store($request, $message, $url){
        DB::beginTransaction();

        $data = new LogError();

        $config = [
            'data' => $request,
            'message' => $message
        ];

        $config = json_encode($config);

        $data->date = date('Y-m-d');
        $data->link = $url;
        $data->config = $config;
        $data->created_by = Auth::user()->id;
        $data->save();

        DB::commit();
    }
}