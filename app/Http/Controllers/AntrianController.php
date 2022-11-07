<?php

namespace App\Http\Controllers;

use App\Events\SendMessage;
use App\Models\Antrian;
use App\Models\Loket;
use App\Models\Unit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class AntrianController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        //
        $id = Crypt::decrypt($id);
        $unit = Unit::find($id);

        $data['unit'] = $unit;
        $data['unit_id'] = Crypt::encrypt($unit->id);
        return view('pages.antrianadmisi.index', $data);
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

    public function getAntrian($unit)
    {
        # code...
        $id = Crypt::decrypt($unit);
        $unit = Unit::find($id);
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
            ->where('loket_id', "0")->get()->all();

        return response()->json([
            "antrian" => $antrian[0]->antrian,
            "date" => date('d/m/Y H:i:s', strtotime($antrian[0]->created_at)),
            "unit" => $antrian[0]->unit->unit_name,
            "rest" => count($rest)
        ]);
    }

    public function nextQueue(Request $request)
    {
        # code...
        $request->validate([
            'l' => 'required',
            'a' => 'required',
            'u' => 'required'
        ]);
        $data = ['status' => false];

        $q_antrian  = Antrian::where('loket_id', '0')
            ->where('unit_id', $request->u)
            ->where('status', $request->a)
            ->where('created_at', 'like', date('Y-m-d') . "%")
            ->orderBy('antrian', 'asc');

        $q_res_antrian = Antrian::where('loket_id', $request->l)
            ->where('unit_id', $request->u)
            ->where('status', '1')
            ->where('created_at', 'like', date('Y-m-d') . "%");

        $antrian = $q_antrian->get()->first();
        if ($antrian != null) {
            $this->updateAntrian($antrian->id, $request->l);

            $q_res_antrian->where('id', $antrian->id);
            $_queue = $q_res_antrian->get()->first();
            if ($_queue == null) {
                $antrian = $q_antrian->get()->first();
                $this->updateAntrian($antrian->id, $request->l);

                $q_res_antrian->where('id', $antrian->id);
                $_queue = $q_res_antrian->get()->first();
            }
            $loket = Loket::with(['unit'])->find($request->l);
            $channel_all = strtolower(implode('-', [str_replace(' ', '_', $loket->unit->unit_name), 'all']));
            $channel_loket = strtolower(implode('-', [str_replace(' ', '_', $loket->unit->unit_name), str_replace(' ', '_', $loket->loket_name)]));
            event(new SendMessage($channel_all, $loket->id, $_queue->antrian));
            event(new SendMessage($channel_loket, $loket->id, $_queue->antrian));
            $data['status'] = true;
            $data['queue'] = $_queue;
        }
        return response()->json($data);
    }

    private function updateAntrian($id, $loket)
    {
        Antrian::where('id', $id)
            ->update([
                'loket_id' => $loket,
                'status' => '1'
            ]);
    }

    public function repeatQueue(Request $request)
    {
        # code...
        $request->validate([
            'a_id' => 'required'
        ]);
        $antrian = Antrian::find($request->a_id);
        $loket = Loket::with(['unit'])->find($antrian->loket_id);
        $channel_all = strtolower(implode('-', [str_replace(' ', '_', $loket->unit->unit_name), 'all']));
        $channel_loket = strtolower(implode('-', [str_replace(' ', '_', $loket->unit->unit_name), str_replace(' ', '_', $loket->loket_name)]));

        event(new SendMessage($channel_all,$loket->id, $antrian->antrian));
        event(new SendMessage($channel_loket,$loket->id, $antrian->antrian));
    }

    public function updateStatus(Request $request)
    {
        # code...
        $request->validate([
            'a_id' => 'required',
            's' => 'required'
        ]);
        Antrian::where('id', $request->a_id)
            ->update(['status' => $request->s]);
    }
}
