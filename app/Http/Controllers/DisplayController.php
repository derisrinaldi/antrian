<?php

namespace App\Http\Controllers;

use App\Models\Loket;
use App\Models\Unit;
use Illuminate\Http\Request;

class DisplayController extends Controller
{
    //
    public function index($unit_id, $loket_id)
    {
        # code...
        $loket = null;
        $unit = Unit::find($unit_id);
        
        if ($loket_id != "all") {
            $loket =  Loket::with(['unit'])->find($loket_id);
            $channel=strtolower(implode('-', [str_replace(' ', '_', $unit->unit_name),str_replace(' ', '_', $loket->loket_name)]));
        } else {
            $loket = Loket::with(['unit'])->where('unit_id', $unit_id)->get()->all();
            $channel = strtolower(implode('-', [str_replace(' ', '_', $unit->unit_name), 'all']));
        }
        $data = [
            'loket' => $loket,
            'unit'=>$unit,
            'channel' => $channel,
        ];
        return view('layouts.display.app', $data);
    }
}
