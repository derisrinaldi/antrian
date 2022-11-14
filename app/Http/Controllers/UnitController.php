<?php

namespace App\Http\Controllers;

use App\Models\Unit;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class UnitController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return view('pages.unit.index', ['title' => 'Unit']);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('pages.unit.create');
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
            'unit_name' => 'required',
        ]);

        Unit::create($validate);

        return back()->with('success', 'unit berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Unit  $unit
     * @return \Illuminate\Http\Response
     */
    public function show(Unit $unit)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Unit  $unit
     * @return \Illuminate\Http\Response
     */
    public function edit(Unit $unit)
    {
        //
        return view('pages.unit.edit', ['unit' => $unit,'title'=>'Update Unit']);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Unit  $unit
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Unit $unit)
    {
        //
        $validate = $request->validate([
            'unit_name' => 'required',
        ]);

        Unit::where('id', $unit->id)->update($validate);

        return redirect(route('unit.index'))->with('success', 'unit berhasil diupdate');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Unit  $unit
     * @return \Illuminate\Http\Response
     */
    public function destroy(Unit $unit)
    {
        //
    }
    // datatable data 
    public function data()
    {
        # code...
        $unit = Unit::all();
        return DataTables::of($unit)->addColumn('action', function (Unit $unit) {
            return '<a href="' . route('unit.edit', $unit->id) . '" class="btn btn-warning"><i class="bi bi-pencil-square"></i></a>';
        })->make();
    }
}
