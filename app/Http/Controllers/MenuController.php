<?php

namespace App\Http\Controllers;

use App\Models\Loket;
use App\Models\Unit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class MenuController extends Controller
{
    //
    public function index()
    {
        # code...
        $unit = Unit::with(['loket'])->get()->all();
       
        $data =[
            'unit'=>$unit,
        ];
        return view('pages.dashboard.menu',$data);
    }
}
