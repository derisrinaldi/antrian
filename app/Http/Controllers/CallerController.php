<?php

namespace App\Http\Controllers;

use App\Models\Antrian;
use App\Models\Loket;
use App\Models\Unit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CallerController extends Controller
{
    //
    public function index($loket_id)
    {
        # code...
        $unit = Unit::all();
        $loket = Loket::with(['unit'])->where('id', $loket_id)
            ->first();
        $antrian = Antrian::with(['unit'])->where('loket_id', $loket->id)
            ->where('status', "=", '1')->where('created_at', 'like', date('Y-m-d') . '%')->get()->first();
        $notif = Antrian::select('id', 'unit_id', DB::raw('count(loket_id) as jml_antrian'))
            ->with(['unit'])
            ->where('loket_id', '0')
            ->where('created_at', 'like', date('Y-m-d') . "%")
            ->groupBy('unit_id')
            ->get()
            ->all();
        // ddd($antrian);
        $data = [
            'loket' => $loket,
            'antrian' => $antrian,
            'unit' => $unit,
            'notif'=>$notif,
        ];

        return view('pages.antrianadmisi.caller', $data);
    }
}
