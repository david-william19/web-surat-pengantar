<?php

namespace App\Http\Controllers;

use App\Models\RukunTetangga;
use Illuminate\Http\Request;

class MyAuthController extends Controller
{
    
    function viewRegisterKK(){

        $rt = RukunTetangga::all();

        foreach ($rt as $key) {
            
        }
        

    }


}
