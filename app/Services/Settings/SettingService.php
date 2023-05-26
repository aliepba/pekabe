<?php

namespace App\Services\Settings;

use Illuminate\Http\Request;
use App\Models\SettingPelaporan;
use Illuminate\Support\Facades\DB;

class SettingService {
    public function statusPelaporan(){
        $item = SettingPelaporan::first();
        DB::transaction(function () use ($item){
            if($item->is_active == 1){
                $item->update(['is_active' => 0]);
            }else{
                $item->update(['is_active' => 1]);
            }
        });
    }
}
