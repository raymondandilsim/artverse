<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LukisanController extends Controller
{
    public function UnggahLukisanPage()
    {
        return view('lukisan.unggah-lukisan');
    }

    public function UnggahLukisan(Request $request){
        // $request
    }
}
