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
        $current_antrian = Antrian::where('loket_id', '<>', '0')
            ->where('created_at', 'like', date('Y-m-d') . "%")
            ->where('status', '1');


        $loket = null;
        $unit = null;
        $data = [];

        if ($loket_id != "all") {
            $loket = Loket::with(['unit'])->find($loket_id);
            $unit = $loket->unit;
            $channel = str_replace(' ', '_', $loket->loket_name);
        } else {
            $now = $current_antrian->latest('updated_at')->get()->first();
            $loket =  [];
            $unit = [];
            if (!is_null($now)) {
                $loket = $now->loket;
                $unit = $now->unit;
                $data['antrian']=$now->antrian;
            }

            $channel = "all-loket";
        }

        $data['loket'] = $loket;
        $data['unit'] = $unit;
        $data['channel'] = $channel;

        return view('layouts.display.app', $data);
    }
}
