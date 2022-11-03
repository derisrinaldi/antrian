<?php

namespace App\Http\Controllers;

use App\Models\Antrian;
use App\Models\Loket;
use Illuminate\Http\Request;

class CallerController extends Controller
{
    //
    public function index($loket_id)
    {
        # code...
        $loket = Loket::find($loket_id);
        $antrian = Antrian::where('loket_id',$loket->id)
        ->where('status',"<>",'0')->get()->last();
        $data=[
            'loket'=>$loket,
            'antrian'=> $antrian
        ];

        return view('pages.antrianadmisi.caller',$data);
    }
}
