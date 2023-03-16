<?php

namespace App\Http\Controllers;

use App\Events\NotifAntrian;
use App\Events\SendMessage;
use App\Models\Antrian;
use App\Models\Loket;
use App\Models\QueueType;
use App\Models\Unit;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Yajra\DataTables\Facades\DataTables;

class AntrianController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id, $id2, $id3)
    {
        //
        $id = Crypt::decrypt($id);
        $id2 = Crypt::decrypt($id2);
        $id3 = Crypt::decrypt($id3);
        if ($id2 != "nothing") {
            $queue_type2 = QueueType::find($id2);
            $data['queue_type2'] = $queue_type2;
            $data['queue_type_id2'] = Crypt::encrypt($queue_type2->id);
        }
        if ($id3 != "nothing") {
            $queue_type3 = QueueType::find($id3);
            $data['queue_type3'] = $queue_type3;
            $data['queue_type_id3'] = Crypt::encrypt($queue_type3->id);
        }
        $queue_type = QueueType::find($id);

        $data['queue_type'] = $queue_type;
        $data['queue_type_id'] = Crypt::encrypt($queue_type->id);
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

    public function getAntrian($queue_type)
    {
        # code...
        $id = Crypt::decrypt($queue_type);
        $queue_type = QueueType::find($id);
        $query = Antrian::where('queue_type_id', $queue_type->id)
            ->where('created_at', 'like', date('Y-m-d') . "%")
            ->orderBy('antrian', 'desc')
            ->limit(1);

        $antrian = $query->with(['queueType' => function ($q) {
            $q->select('id', 'name');
        }])->get()->all();
        $count =  count($antrian);
        if ($count == 0) {
            Antrian::create(['antrian' => 1,"unit_id"=>$queue_type->unit_id, "queue_type_id" => $queue_type->id,'queue_date'=>Carbon::now()->toDateString()]);
        } else {
            $num = $antrian[0]->antrian + 1;
            Antrian::create(['antrian' => $num,"unit_id"=>$queue_type->unit_id, "queue_type_id" => $queue_type->id,'queue_date'=>Carbon::now()->toDateString()]);
        }

        $antrian = $query->with(['queueType' => function ($q) {
            $q->select('id', 'name');
        }])->get()->all();
        $rest = Antrian::select("loket_id")->where('queue_type_id', $queue_type->id)
            ->where('created_at', 'like', date('Y-m-d') . "%")
            ->where('loket_id', "0")->get()->all();
        event(new NotifAntrian($queue_type->unit_id));
        return response()->json([
            "antrian" => $antrian[0]->antrian,
            "date" => date('d/m/Y H:i:s', strtotime($antrian[0]->created_at)),
            "queue_type" => $antrian[0]->queueType->name,
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
            ->where('queue_type_id', $request->u)
            ->where('status', $request->a)
            ->where('created_at', 'like', date('Y-m-d') . "%")
            ->orderBy('antrian', 'asc');

        $q_res_antrian = Antrian::with(['unit','queueType'])
            ->where('loket_id', $request->l)
            ->where('queue_type_id', $request->u)
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
            $channel_all = "all-loket-".$loket->unit->id;
            $channel_loket = $loket->id.str_replace(' ', '_', $loket->loket_name);
            event(new NotifAntrian($loket->unit->id));
            event(new SendMessage($channel_all, $loket->id, $_queue->queue_type_id, $_queue->antrian));
            event(new SendMessage($channel_loket, $loket->id, $_queue->queue_type_id, $_queue->antrian));
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
        $channel_all = "all-loket-".$antrian->unit_id;
        $channel_loket = $antrian->loket_id.str_replace(' ', '_', $loket->loket_name);

        event(new SendMessage($channel_all, $loket->id, $antrian->queue_type_id, $antrian->antrian));
        event(new SendMessage($channel_loket, $loket->id, $antrian->queue_type_id, $antrian->antrian));
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

    public function data(Request $request)
    {
        # code...
        $antrian = Antrian::with(['unit', 'loket','queueType'])
            ->where('created_at', 'like', $request->tanggal . "%")
            ->get()->all();
        $data = DataTables::of($antrian)
            ->editColumn('loket.loket_name', function (Antrian $antrian) {
                return $antrian->loket->loket_name ?? "";
            })
            ->editColumn('status', function (Antrian $antrian) {
                $status = "";
                switch ($antrian->status) {
                    case 0:
                        $status = "Menunggu";
                        break;
                    case 1:
                        $status = "Sedang Dilayani";
                        break;
                    case 2:
                        $status = "Selesai";
                        break;
                    case 3:
                        $status = "Tidak Hadir";
                        break;
                    case 4:
                        $status = "Lewati";
                        break;
                }
                return $status;
            })
            ->editColumn('created_at', function (Antrian $antrian) {
                return date('H:i:s', strtotime($antrian->created_at));
            })
            ->editColumn('updated_at', function (Antrian $antrian) {
                return $antrian->updated_at == $antrian->created_at ? "-" : date('H:i:s', strtotime($antrian->updated_at));
            })
            ->make();
        return $data;
    }
}
