<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Actions\Logbook\TenagaAhli;
use Illuminate\Support\Facades\Auth;
use App\Actions\Dashboard\CountKegiatan;
use App\Actions\Logbook\GetAngkaKreditTerverifikasi;
use App\Actions\Dashboard\CountKegiatanByPenyelenggara;
use App\Models\DetailInstansi;
use App\Models\Kegiatan;
use App\Models\KegiatanPenyelenggaraLain;
use App\Enums\PermohonanStatus;
use App\Models\User;
use App\Models\PelaporanKegiatan;


class DashboardController extends Controller
{

    public function __construct()
    {
        $this->middleware('isAdmin')->only('index');
        $this->middleware('isPenyelenggara')->only('dashboardUser');
        $this->middleware(['isSKA', 'isTenagaAhli'])->only(['dashboardTenagaAhli','indexSKK']);
        $this->middleware('isAPT')->only('dashboardApt');
    }

    public function index(){
        $this->authorize('view-dashboard');
        return view('dashboard', CountKegiatan::run());
    }

    public function dashboardUser(){
        return view('pages.dashboard.dashboard-user', CountKegiatanByPenyelenggara::run());
    }

    public function indexSKK(){
        return view('pages.dashboard.dashboard-ska', TenagaAhli::run(Auth::user()->nik),GetAngkaKreditTerverifikasi::run());
    }

    public function dashboardApt(){
        return view('pages.dashboard.dashboard-apt', CountKegiatanByPenyelenggara::run());
    }

    public function dashboardTenagaAhli(){
        return view('pages.dashboard.index-ska');
    }

    public function getRekap(Request $request)
    {
        $start = $request->date_from;
        $end = $request->date_end;

        $user = DetailInstansi::
                        where('status_permohonan', 'APPROVE')
                        ->whereBetween('created_at', [$start, $end])
                        ->count();
        $all = Kegiatan::whereNotIn('status_permohonan_kegiatan', ['OPEN'])
                        ->whereBetween('created_at', [$start, $end]) 
                        ->count(); 
        $kolaborasi = KegiatanPenyelenggaraLain::whereBetween('created_at', [$start, $end])->count();
        $setuju = Kegiatan::where('status_permohonan_kegiatan', PermohonanStatus::APPROVE)
                            ->whereBetween('created_at', [$start, $end])
                            ->count();
        $tolak = Kegiatan::where('status_permohonan_kegiatan', PermohonanStatus::TOLAK)
                            ->whereBetween('created_at', [$start, $end])
                            ->count();
        $tolakPenyelenggara = DetailInstansi::where('status_permohonan', PermohonanStatus::TOLAK)
                            ->whereBetween('created_at', [$start, $end])
                            ->count();
        $sah  =  Kegiatan::where('status_permohonan_kegiatan', PermohonanStatus::PENGESAHAN)
                            ->whereBetween('created_at', [$start, $end])
                            ->count();
        $akun = User::whereIn('role', ['user', 'sub-user'])->whereBetween('created_at', [$start, $end])->count();
        $pelaporan= PelaporanKegiatan::where('status_laporan', PermohonanStatus::SUBMIT)->whereBetween('created_at', [$start, $end])->count();
        $usertk = User::where('role', 'skk-ska')->whereBetween('created_at', [$start, $end])->count();

        return response()->json([
            'user' => $user,
            'all' => $all,
            'kolaborasi' => $kolaborasi,
            'setuju' => $setuju,
            'tolak' => $tolak,
            'tolakPenyelenggara' => $tolakPenyelenggara,
            'sah' => $sah,
            'akun' => $pelaporan,
            'usertk' => $usertk,
            'akun' => $akun
         ]);
        

    }

}
