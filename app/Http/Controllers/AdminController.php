<?php

namespace App\Http\Controllers;

use App\Models\Unit;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    //
    public function index()
    {
        # code...
        $unit = Unit::all();
        return view('pages.dashboard.index',['unit'=>$unit]);
    }
}
