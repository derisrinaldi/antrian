<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Charts\SampleChart;
use App\Models\Antrian;

class ChartController extends Controller
{
    //
    function index(Request $request){
        
        // set tanggal
        $tanggal = $request->tanggal ?? date('Y-m-d');

        // tanggal kemarin
        $tgl_kemarin = date('Y-m-d',strtotime('-1 day',strtotime($tanggal)));

        // query antrian sesuai tanggal
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
    
        // query antrian -1 day
        $y_05 = Antrian::where('created_at', 'like', $tgl_kemarin . " 05:%")->count();
        $y_06 = Antrian::where('created_at', 'like', $tgl_kemarin . " 06:%")->count();
        $y_07 = Antrian::where('created_at', 'like', $tgl_kemarin . " 07:%")->count();
        $y_08 = Antrian::where('created_at', 'like', $tgl_kemarin . " 08:%")->count();
        $y_09 = Antrian::where('created_at', 'like', $tgl_kemarin . " 09:%")->count();
        $y_10 = Antrian::where('created_at', 'like', $tgl_kemarin . " 10:%")->count();
        $y_11 = Antrian::where('created_at', 'like', $tgl_kemarin . " 11:%")->count();
        $y_12 = Antrian::where('created_at', 'like', $tgl_kemarin . " 12:%")->count();
        $y_13 = Antrian::where('created_at', 'like', $tgl_kemarin . " 13:%")->count();
        $y_14 = Antrian::where('created_at', 'like', $tgl_kemarin . " 14:%")->count();
        $y_15 = Antrian::where('created_at', 'like', $tgl_kemarin . " 15:%")->count();
        $y_16 = Antrian::where('created_at', 'like', $tgl_kemarin . " 16:%")->count();
        $y_17 = Antrian::where('created_at', 'like', $tgl_kemarin . " 17:%")->count();
        $y_18 = Antrian::where('created_at', 'like', $tgl_kemarin . " 18:%")->count();
        $y_19 = Antrian::where('created_at', 'like', $tgl_kemarin . " 19:%")->count();
        $y_20 = Antrian::where('created_at', 'like', $tgl_kemarin . " 20:%")->count();
        $y_21 = Antrian::where('created_at', 'like', $tgl_kemarin . " 21:%")->count();

        // use chart
        $chart = new SampleChart;

        // set label
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

        // data chart
        $chart->dataset('antrian '.$tanggal, 'line', [
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
        ])->color('#8F1AC7');

        // data chart -1 day
        $chart->dataset('antrian '.$tgl_kemarin, 'line', [
            $y_05,
            $y_06,
            $y_07,
            $y_08,
            $y_09,
            $y_10,
            $y_11,
            $y_12,
            $y_13,
            $y_14,
            $y_15,
            $y_16,
            $y_17,
            $y_18,
            $y_19,
            $y_20,
            $y_21,
        ])->color("#1AC772");

        // return view
        return view('pages.chart.index', ['chart'=>$chart,'tanggal'=>$tanggal,]);
    }
}
