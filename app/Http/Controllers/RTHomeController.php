<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RTHomeController extends Controller
{
    public function home(){
        return view('rt.dashboard.home');
    }
}
