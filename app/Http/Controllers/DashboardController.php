<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Actions\Logbook\TenagaAhli;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{

    public function __construct()
    {
        $this->middleware('isAdmin')->only('index');
        $this->middleware('isPenyelenggara')->only('dashboardUser');
    }

    public function index(){
        $this->authorize('view-dashboard');
        return view('dashboard');
    }

    public function dashboardUser(){
        return view('pages.dashboard.dashboard-user');
    }

    public function dashboardTenagaAhli(){
        return view('pages.dashboard.dashboard-ska', TenagaAhli::run(Auth::user()->nik));
    }
}
