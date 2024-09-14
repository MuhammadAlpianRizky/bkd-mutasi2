<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PegawaiController extends Controller
{
    public function mutasi(){
        $user = auth()->user();
        return view("users.form-mutasi", compact("user"));
    }
}
