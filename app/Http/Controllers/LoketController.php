<?php

namespace App\Http\Controllers;

use App\Models\Loket;
use App\Models\Unit;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables as DataTablesDataTables;
use Yajra\DataTables\Facades\DataTables;

class LoketController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        
        $unit = Unit::all();
        return view('pages.loket.index',[
            'title'=>'Loket',
            'unit'=>$unit,
        ]);
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
        $validate = $request->validate([
            'unit_id'=>'required'
        ]);

        $loket = Loket::where('unit_id',$request->unit_id)->get()->all();
        if(count($loket) ==0){
            $validate['loket_name']="Loket 1";
            Loket::create($validate);
        }else{
            $validate['loket_name']="Loket ".count($loket)+1;
            Loket::create($validate);
        }

        $loket = Loket::where('unit_id',$request->unit_id)->get()->last();

        return response()->json(['loket'=>$loket->loket_name]);

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Loket  $loket
     * @return \Illuminate\Http\Response
     */
    public function show(Loket $loket)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Loket  $loket
     * @return \Illuminate\Http\Response
     */
    public function edit(Loket $loket)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Loket  $loket
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Loket $loket)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Loket  $loket
     * @return \Illuminate\Http\Response
     */
    public function destroy(Loket $loket)
    {
        //
    }

    // datatable data 
    public function data()
    {
        # code...
        $loket = Loket::with(['unit'=>function($q){
            $q->select('id',"unit_name");
        }])->get()->all();
        return DataTables::of($loket)->make();
    }
}
