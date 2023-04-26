<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DetailLukisanController extends Controller
{
    public function LukisanPage()
    {
        return view('detail-lukisan');
    }
}
