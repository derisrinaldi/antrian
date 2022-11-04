<?php

namespace App\Http\Controllers;

use App\Models\Antrian;
use App\Models\Loket;
use App\Models\Unit;
use Illuminate\Http\Request;

class CallerController extends Controller
{
    //
    public function index($unit_id, $loket_id)
    {
        # code...
        $loket = Loket::with(['unit'])->where('unit_id', $unit_id)->where('id', $loket_id)
            ->first();
        $antrian = Antrian::where('unit_id', $unit_id)->where('loket_id', $loket->id)
            ->where('status', "<>", '0')->where('created_at', 'like', date('Y-m-d') . '%')->get()->last();
        $data = [
            'loket' => $loket,
            'antrian' => $antrian
        ];

        return view('pages.antrianadmisi.caller', $data);
    }
}
