<?php

namespace App\Http\Controllers;

use App\Models\Loket;
use App\Models\QueueType;
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
        $loket = Loket::with(['unit','queueType'])->get()->all();
        $queue_types = QueueType::with('unit')->orderBy('unit_id','asc')->get()->all();
        $data =[
            'unit'=>$unit,
            'loket'=>$loket,
            'queue_types'=>$queue_types
        ];
        return view('pages.dashboard.menu',$data);
    }
}
