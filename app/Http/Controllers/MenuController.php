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
        $unit = Unit::all();
        $loket = Loket::with(['unit'])->get()->all();
       
        $data =[
            'unit'=>$unit,
            'loket'=>$loket
        ];
        return view('pages.dashboard.menu',$data);
    }
}
