<?php

namespace App\Http\Controllers;

use App\Models\QueueType;
use App\Models\Unit;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class QueueTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return view('pages.queue_types.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $units = Unit::select('id','unit_name')->get()->all();
        return view('pages.queue_types.create',['units'=>$units]);

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
        $validated = $request->validate([
            'unit_id'=>'required',
            'name'=>'required',
        ]);

        QueueType::create($validated);

        return back()->with('success','data berhasil diinput');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\QueueType  $queueType
     * @return \Illuminate\Http\Response
     */
    public function show(QueueType $queueType)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\QueueType  $queueType
     * @return \Illuminate\Http\Response
     */
    public function edit(QueueType $queueType)
    {
        //
        $queueType->load('unit');
        return view('pages.queue_types.edit',['queueType'=>$queueType]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\QueueType  $queueType
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, QueueType $queueType)
    {
        //
        $validated = $request->validate([
            'name'=>'required'
        ]);

        $queueType->update(['name'=>$request->name]);

        return redirect(route('jenis-antrian.index'))->with('success','data berhasil diupdate');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\QueueType  $queueType
     * @return \Illuminate\Http\Response
     */
    public function destroy(QueueType $queueType)
    {
        //
    }

    // datatable data 
    public function getDatatableJson()
    {
        # code...
        $queue_types = QueueType::with(['unit'])->orderBy('unit_id','asc')->get();
        return DataTables::of($queue_types)->addColumn('action', function ($queue_type) {
            return '<a href="' . route('jenis-antrian.edit', $queue_type->id) . '" class="btn btn-warning"><i class="bi bi-pencil-square"></i></a>';
        })->make();
    }

    // data json with condition unit id required
    public function dataJson(Request $request)
    {
        # code...
        $unit_id = $request->unit_id;
        $queue_types = QueueType::where('unit_id',$unit_id)->get()->all();

        return response()->json($queue_types,200);
    }
}
