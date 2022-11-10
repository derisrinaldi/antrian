<?php

namespace App\Http\Controllers;

use App\Models\Antrian;
use App\Models\Loket;
use App\Models\Unit;
use Illuminate\Http\Request;

class CallerController extends Controller
{
    //
    public function index($loket_id)
    {
        # code...
        $unit = Unit::all();
        $loket = Loket::with(['unit'])->where('id', $loket_id)
            ->first();
        $antrian = Antrian::where('unit_id', $loket->unit_id)->where('loket_id', $loket->id)
            ->where('status', "<>", '0')->where('created_at', 'like', date('Y-m-d') . '%')->get()->last();
        $data = [
            'loket' => $loket,
            'antrian' => $antrian,
            'unit'=>$unit,
        ];

        return view('pages.antrianadmisi.caller', $data);
    }
}
