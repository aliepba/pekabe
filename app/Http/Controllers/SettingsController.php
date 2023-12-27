<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SettingKegiatan;
use App\Models\SettingPelaporan;
use App\Services\Settings\SettingService;
use Illuminate\Support\Facades\Cache;

class SettingsController extends Controller
{

    private $settingService;

    public function __construct(SettingService $settingService)
    {
        $this->settingService = $settingService;
    }

    public function index(){
        return view('pages.system.index', [
            'item' => Cache::rememberForever('cache_set_pelaporan', function (){
                            return SettingPelaporan::first();
                        }), 
            'kegiatan' => Cache::rememberForever('cache_set_maks_kegiatan', function () {
                            return SettingKegiatan::first();
                        })
        ]);
    }

    public function statusPelaporan(){
        $this->settingService->statusPelaporan();
        return redirect(route('setting.pelaporan'))->with('success', 'status berhasil diubah');
    }

    public function pengajuanKegiatan(){
        $this->settingService->statusKegiatan();
        return redirect(route('setting.pelaporan'))->with('success', 'status berhasil diubah');
    }
}
