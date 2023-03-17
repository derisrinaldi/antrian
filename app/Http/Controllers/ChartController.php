<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Charts\SampleChart;
use App\Models\Antrian;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class ChartController extends Controller
{
    //
    function index(Request $request)
    {


        // set tanggal
        $tanggal = $request->tanggal ?? Carbon::now()->toDateString();

        // tanggal kemarin
        $tgl_kemarin = Carbon::create($tanggal)->subDay()->toDateString();
        // query antrian sesuai tanggal
        $jam_05 = Antrian::where('created_at', 'like', $tanggal . " 05:%")->count();
        $jam_06 = Antrian::where('created_at', 'like', $tanggal . " 06:%")->count();
        $jam_07 = Antrian::where('created_at', 'like', $tanggal . " 07:%")->count();
        $jam_08 = Antrian::where('created_at', 'like', $tanggal . " 08:%")->count();
        $jam_09 = Antrian::where('created_at', 'like', $tanggal . " 09:%")->count();
        $jam_10 = Antrian::where('created_at', 'like', $tanggal . " 10:%")->count();
        $jam_11 = Antrian::where('created_at', 'like', $tanggal . " 11:%")->count();
        $jam_12 = Antrian::where('created_at', 'like', $tanggal . " 12:%")->count();
        $jam_13 = Antrian::where('created_at', 'like', $tanggal . " 13:%")->count();
        $jam_14 = Antrian::where('created_at', 'like', $tanggal . " 14:%")->count();
        $jam_15 = Antrian::where('created_at', 'like', $tanggal . " 15:%")->count();
        $jam_16 = Antrian::where('created_at', 'like', $tanggal . " 16:%")->count();
        $jam_17 = Antrian::where('created_at', 'like', $tanggal . " 17:%")->count();
        $jam_18 = Antrian::where('created_at', 'like', $tanggal . " 18:%")->count();
        $jam_19 = Antrian::where('created_at', 'like', $tanggal . " 19:%")->count();
        $jam_20 = Antrian::where('created_at', 'like', $tanggal . " 20:%")->count();
        $jam_21 = Antrian::where('created_at', 'like', $tanggal . " 21:%")->count();

        // query antrian -1 day
        $kemarin_jam_05 = Antrian::where('created_at', 'like', $tgl_kemarin . " 05:%")->count();
        $kemarin_jam_06 = Antrian::where('created_at', 'like', $tgl_kemarin . " 06:%")->count();
        $kemarin_jam_07 = Antrian::where('created_at', 'like', $tgl_kemarin . " 07:%")->count();
        $kemarin_jam_08 = Antrian::where('created_at', 'like', $tgl_kemarin . " 08:%")->count();
        $kemarin_jam_09 = Antrian::where('created_at', 'like', $tgl_kemarin . " 09:%")->count();
        $kemarin_jam_10 = Antrian::where('created_at', 'like', $tgl_kemarin . " 10:%")->count();
        $kemarin_jam_11 = Antrian::where('created_at', 'like', $tgl_kemarin . " 11:%")->count();
        $kemarin_jam_12 = Antrian::where('created_at', 'like', $tgl_kemarin . " 12:%")->count();
        $kemarin_jam_13 = Antrian::where('created_at', 'like', $tgl_kemarin . " 13:%")->count();
        $kemarin_jam_14 = Antrian::where('created_at', 'like', $tgl_kemarin . " 14:%")->count();
        $kemarin_jam_15 = Antrian::where('created_at', 'like', $tgl_kemarin . " 15:%")->count();
        $kemarin_jam_16 = Antrian::where('created_at', 'like', $tgl_kemarin . " 16:%")->count();
        $kemarin_jam_17 = Antrian::where('created_at', 'like', $tgl_kemarin . " 17:%")->count();
        $kemarin_jam_18 = Antrian::where('created_at', 'like', $tgl_kemarin . " 18:%")->count();
        $kemarin_jam_19 = Antrian::where('created_at', 'like', $tgl_kemarin . " 19:%")->count();
        $kemarin_jam_20 = Antrian::where('created_at', 'like', $tgl_kemarin . " 20:%")->count();
        $kemarin_jam_21 = Antrian::where('created_at', 'like', $tgl_kemarin . " 21:%")->count();

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
        $data_chart =[
            $jam_05,
            $jam_06,
            $jam_07,
            $jam_08,
            $jam_09,
            $jam_10,
            $jam_11,
            $jam_12,
            $jam_13,
            $jam_14,
            $jam_15,
            $jam_16,
            $jam_17,
            $jam_18,
            $jam_19,
            $jam_20,
            $jam_21,
        ];
        $chart->dataset('antrian ' . $tanggal.' total:'.collect($data_chart)->sum(), 'line', $data_chart)->color('#8F1AC7');

        // data chart -1 day
        $data_chart_sub_day=[
            $kemarin_jam_05,
            $kemarin_jam_06,
            $kemarin_jam_07,
            $kemarin_jam_08,
            $kemarin_jam_09,
            $kemarin_jam_10,
            $kemarin_jam_11,
            $kemarin_jam_12,
            $kemarin_jam_13,
            $kemarin_jam_14,
            $kemarin_jam_15,
            $kemarin_jam_16,
            $kemarin_jam_17,
            $kemarin_jam_18,
            $kemarin_jam_19,
            $kemarin_jam_20,
            $kemarin_jam_21,
        ];

        $chart->dataset('antrian ' . $tgl_kemarin.' total:'.collect($data_chart_sub_day)->sum(), 'line', $data_chart_sub_day)->color("#1AC772");

        // bulanan
        $bulan = Carbon::create($tanggal)->format('Y-m');
        $queue_on_month = Antrian::select('queue_date', DB::raw('count(*) as total'))
            ->where('queue_date', 'like', $bulan . '%')
            ->groupBy('queue_date')
            ->orderBy('queue_date', 'asc')
            ->get()->all();

        // chart for month
        $chart_month = new SampleChart;

        // set data
        $label = [];
        $value = [];
        $total = 0;
        foreach ($queue_on_month as $item) {
            $label[] = $item->queue_date;
            $value[] = $item->total;
            $total += $item->total;
        }

        // set label
        $chart_month->labels($label);

        // set dataset
        $bulan = Carbon::create($bulan)->format('F Y');
        $chart_month->dataset('Antrian ' . $bulan . ' total:' . $total, 'line', $value)->color('#0033cc');

        // bulanan kemarin
        $bulan_kemarin = Carbon::create($tanggal)->subMonth()->format('Y-m');
        $queue_on_month_kemarin = Antrian::select('queue_date', DB::raw('count(*) as total'))
            ->where('queue_date', 'like', $bulan_kemarin . '%')
            ->groupBy('queue_date')
            ->orderBy('queue_date', 'asc')
            ->get()->all();

        // chart for month
        $chart_month_kemarin = new SampleChart;

        // set data
        $label_k = [];
        $value_k = [];
        $total_k = 0;
        foreach ($queue_on_month_kemarin as $item) {
            $label_k[] = $item->queue_date;
            $value_k[] = $item->total;
            $total_k += $item->total;
        }

        // set label
        $chart_month_kemarin->labels($label_k);

        // set dataset
        $bulan_kemarin = Carbon::create($bulan_kemarin)->format('F Y');
        $chart_month_kemarin->dataset('Antrian ' . $bulan_kemarin . ' total:' . $total_k, 'line', $value_k)->color('red');
        // return view
        return view('pages.chart.index', [
            'chart' => $chart,
            'tanggal' => $tanggal, 
            'bulan' => $chart_month,
            'bulan_k' => $chart_month_kemarin,
        ]);
    }
}
