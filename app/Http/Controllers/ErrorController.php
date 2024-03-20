<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LogError;

class ErrorController extends Controller
{
    public function index()
    {
        return view('errors.500');
    }

    public function list(){
        $data = LogError::all();
        return view('errors.list', compact('data'));
    }
}
