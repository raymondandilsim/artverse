<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AkunMemberController extends Controller
{
    public function AkunMemberPage()
    {
        return view('akun-member');
    }
}
