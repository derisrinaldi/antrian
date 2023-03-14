<?php

namespace App\Events;

use App\Models\Antrian;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Contracts\Broadcasting\ShouldBroadcastNow;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\DB;

class NotifAntrian implements ShouldBroadcastNow
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * Create a new event instance.
     *
     * @return void
     */

    public $unit_id;
    public function __construct($unit_id)
    {
        //
        $this->unit_id = $unit_id;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new Channel('notif-antrian-'.$this->unit_id);
    }

    /**
     * The event's broadcast name.
     *
     * @return string
     */
    public function broadcastAs()
    {
        return 'UserEvent';
    }

    /**
     * The event's broadcast name.
     *
     * @return string
     */
    public function broadcastWith()
    {
        $antrian = Antrian::select('id', 'queue_type_id', DB::raw('count(loket_id) as jml_antrian'))
            ->with(['queueType'])
            ->where('loket_id', '0')
            ->where('unit_id',$this->unit_id)
            ->where('created_at', 'like', date('Y-m-d') . "%")
            ->groupBy('queue_type_id')
            ->get()
            ->all();
        $notif = "";
        foreach ($antrian as $a) {
            $notif .= '<div class="col-sm-auto"><button type="button" class="btn btn-primary position-relative">
            ' . $a->queueType->name . '
            <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
              ' . $a->jml_antrian . '
              <span class="visually-hidden">unread messages</span>
            </span>
          </button></div>';
        }
        return ['notif' => $notif];
    }
}
