<?php

namespace App\Http\Controllers;

use App\Models\Loket;
use App\Models\Unit;
use Illuminate\Http\Request;

class DisplayController extends Controller
{
    //
    public function index($loket_id)
    {
        # code...
        $loket = null;
        $unit = null;
        
        if ($loket_id != "all") {
            $loket = Loket::with(['unit'])->find($loket_id);
            $unit = $loket->unit;
            $channel = str_replace(' ', '_', $loket->loket_name);
        } else {
            $loket =  [];
            $unit = [];
            $channel="all-loket";
        }
        $data = [
            'loket' => $loket,
            'unit'=>$unit,
            'channel' => $channel,
        ];
        return view('layouts.display.app', $data);
    }
}
