<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(){
        $this->authorize('view-dashboard');
        //  $this->authorize('show-event', Event::class);
        return view('dashboard');
    }
}
