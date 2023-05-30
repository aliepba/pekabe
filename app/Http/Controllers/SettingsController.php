<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SettingKegiatan;
use App\Models\SettingPelaporan;
use App\Services\Settings\SettingService;

class SettingsController extends Controller
{

    private $settingService;

    public function __construct(SettingService $settingService)
    {
        $this->settingService = $settingService;
    }

    public function index(){
        return view('pages.system.index', [
            'item' => SettingPelaporan::first(),
            'kegiatan' => SettingKegiatan::first()
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
