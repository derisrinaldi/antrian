<?php

namespace App\Http\Controllers;

use App\Models\Antrian;
use App\Models\Loket;
use App\Models\QueueType;
use App\Models\Unit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CallerController extends Controller
{
    //
    public function index($loket_id)
    {
        # code...
        $loket = Loket::with(['unit','queueType'])->where('id', $loket_id)
            ->first();
        $antrian = Antrian::with(['unit','queueType'])->where('loket_id', $loket->id)
            ->where('status', "=", '1')->where('created_at', 'like', date('Y-m-d') . '%')->get()->first();
        $notif = Antrian::select('id', 'queue_type_id', DB::raw('count(loket_id) as jml_antrian'))
            ->with(['unit','queueType'])
            ->where('loket_id', '0')
            ->where('unit_id',$loket->unit->id)
            ->where('created_at', 'like', date('Y-m-d') . "%")
            ->groupBy('queue_type_id')
            ->get()
            ->all();

        $data = [
            'loket' => $loket,
            'antrian' => $antrian,
            'notif'=>$notif,
            'queue_types'=>$loket->unit->queueType->all()
        ];
        
        return view('pages.antrianadmisi.caller', $data);
    }
}
