<?php

namespace App\Http\Controllers;

use App\Models\Antrian;
use App\Models\Unit;
use Illuminate\Http\Request;

class AntrianController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Antrian  $antrian
     * @return \Illuminate\Http\Response
     */
    public function show(Antrian $antrian)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Antrian  $antrian
     * @return \Illuminate\Http\Response
     */
    public function edit(Antrian $antrian)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Antrian  $antrian
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Antrian $antrian)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Antrian  $antrian
     * @return \Illuminate\Http\Response
     */
    public function destroy(Antrian $antrian)
    {
        //
    }

    public function getAntrian(Unit $unit)
    {
        # code...
        $query = Antrian::where('unit_id', $unit->id)
            ->where('created_at', 'like', date('Y-m-d') . "%")
            ->orderBy('antrian', 'desc')
            ->limit(1);

        $antrian = $query->with(['unit' => function ($q) {
            $q->select('id', 'unit_name');
        }])->get()->all();
        $count =  count($antrian);
        if ($count == 0) {
            Antrian::create(['antrian' => 1, "unit_id" => $unit->id]);
        } else {
            $num = $antrian[0]->antrian + 1;
            Antrian::create(['antrian' => $num, "unit_id" => $unit->id]);
        }

        $antrian = $query->with(['unit' => function ($q) {
            $q->select('id', 'unit_name');
        }])->get()->all();
        $rest = Antrian::select("loket_id")->where('unit_id', $unit->id)
        ->where('created_at', 'like', date('Y-m-d') . "%")
        ->where('loket_id',"0")->get()->all();

        return response()->json([
            "antrian"=>$antrian[0]->antrian,
            "date"=>date('d/m/Y H:m:s', strtotime($antrian[0]->created_at)),
            "unit"=>$antrian[0]->unit->unit_name,
            "rest"=>count($rest)
        ]);
    }
}
