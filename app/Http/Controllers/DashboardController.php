<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Actions\Logbook\TenagaAhli;
use Illuminate\Support\Facades\Auth;
use App\Actions\Dashboard\CountKegiatan;
use App\Actions\Logbook\GetAngkaKreditTerverifikasi;
use App\Actions\Dashboard\CountKegiatanByPenyelenggara;

class DashboardController extends Controller
{

    public function __construct()
    {
        $this->middleware('isAdmin')->only('index');
        $this->middleware('isPenyelenggara')->only('dashboardUser');
        $this->middleware('isSKA')->only('dashboardTenagaAhli');
    }

    public function index(){
        $this->authorize('view-dashboard');
        return view('dashboard', CountKegiatan::run());
    }

    public function dashboardUser(){
        return view('pages.dashboard.dashboard-user', CountKegiatanByPenyelenggara::run());
    }

    public function dashboardTenagaAhli(){
        return view('pages.dashboard.dashboard-ska', TenagaAhli::run(Auth::user()->nik),GetAngkaKreditTerverifikasi::run());
    }
}
