<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{

    public function __construct()
    {
        $this->middleware('isAdmin')->only('index');
    }

    public function index(){
        $this->authorize('view-dashboard');
        //  $this->authorize('show-event', Event::class);
        return view('dashboard');
    }

    public function dashboardUser(){

        return view('pages.dashboard-user');
    }
}
