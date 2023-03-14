<?php

namespace App\Http\Controllers;

use App\Models\Antrian;
use App\Models\Loket;
use App\Models\Unit;
use Illuminate\Http\Request;

class DisplayController extends Controller
{
    //
    /**
     * status antrian
     * 0 = Menunggu
     * 1 = Sedang Dilayani
     * 2 = Selesai
     * 3 = Tidak Hadir
     * 4 = Lewati
     */
    public function index($loket_id)
    {
        # code...

        # query antrian sedang dilayani
        $current_antrian = Antrian::with(['queueType'])->where('loket_id', '<>', '0')
            ->where('created_at', 'like', date('Y-m-d') . "%")
            ->where('status', '1');

        $display = explode('-',$loket_id);
        $loket = null;
        $unit = null;
        $queue_type=[];
        $data = [];

        if ($display[0] != "all") {
            $loket = Loket::with(['unit','queueType'])->find($loket_id[0]);
            $unit = $loket->unit;
            $queue_type = $loket->queueType;
            $channel = $loket->id.str_replace(' ', '_', $loket->loket_name);
        } else {
            $now = $current_antrian->latest('updated_at')->get()->first();
            $loket =  [];
            $unit = [];
            $queue_type=[];
            if (!is_null($now)) {
                $loket = $now->loket;
                $unit = $now->unit;
                $queue_type = $now->queueType;
                $data['antrian']=$now->antrian;
            }

            $channel = "all-loket-".$display[1];
        }

        $data['loket'] = $loket;
        $data['unit'] = $unit;
        $data['queue_type'] = $queue_type;
        $data['channel'] = $channel;

        return view('layouts.display.app', $data);
    }
}
