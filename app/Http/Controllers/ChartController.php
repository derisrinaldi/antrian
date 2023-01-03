<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Charts\SampleChart;
use App\Models\Antrian;

class ChartController extends Controller
{
    //
    function index(Request $request){
        $tanggal = $request->tanggal ?? date('Y-m-d');
        $_05 = Antrian::where('created_at', 'like', $tanggal . " 05:%")->count();
        $_06 = Antrian::where('created_at', 'like', $tanggal . " 06:%")->count();
        $_07 = Antrian::where('created_at', 'like', $tanggal . " 07:%")->count();
        $_08 = Antrian::where('created_at', 'like', $tanggal . " 08:%")->count();
        $_09 = Antrian::where('created_at', 'like', $tanggal . " 09:%")->count();
        $_10 = Antrian::where('created_at', 'like', $tanggal . " 10:%")->count();
        $_11 = Antrian::where('created_at', 'like', $tanggal . " 11:%")->count();
        $_12 = Antrian::where('created_at', 'like', $tanggal . " 12:%")->count();
        $_13 = Antrian::where('created_at', 'like', $tanggal . " 13:%")->count();
        $_14 = Antrian::where('created_at', 'like', $tanggal . " 14:%")->count();
        $_15 = Antrian::where('created_at', 'like', $tanggal . " 15:%")->count();
        $_16 = Antrian::where('created_at', 'like', $tanggal . " 16:%")->count();
        $_17 = Antrian::where('created_at', 'like', $tanggal . " 17:%")->count();
        $_18 = Antrian::where('created_at', 'like', $tanggal . " 18:%")->count();
        $_19 = Antrian::where('created_at', 'like', $tanggal . " 19:%")->count();
        $_20 = Antrian::where('created_at', 'like', $tanggal . " 20:%")->count();
        $_21 = Antrian::where('created_at', 'like', $tanggal . " 21:%")->count();
    
        $chart = new SampleChart;
        $chart->labels([
            "Jam 05",
            "Jam 06",
            "Jam 07",
            "Jam 08",
            "Jam 09",
            "Jam 10",
            "Jam 11",
            "Jam 12",
            "Jam 13",
            "Jam 14",
            "Jam 15",
            "Jam 16",
            "Jam 17",
            "Jam 18",
            "Jam 19",
            "Jam 20",
            "Jam 21",
        ]);
        $chart->dataset('antrian', 'line', [
            $_05,
            $_06,
            $_07,
            $_08,
            $_09,
            $_10,
            $_11,
            $_12,
            $_13,
            $_14,
            $_15,
            $_16,
            $_17,
            $_18,
            $_19,
            $_20,
            $_21,
        ]);
    
        return view('pages.chart.index', ['chart'=>$chart,'tanggal'=>$tanggal]);
    }
}
