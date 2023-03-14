<?php

namespace App\Events;

use App\Models\Loket;
use App\Models\QueueType;
use App\Models\Unit;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Contracts\Broadcasting\ShouldBroadcastNow;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class SendMessage implements ShouldBroadcastNow
{
    use Dispatchable, InteractsWithSockets, SerializesModels;
    private Loket $loket;
    private QueueType $queue_type;
    private $antrian,$channel;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($channel,$loket,$queue_type,$antrian)
    {
        //
        $this->loket = Loket::find($loket);
        $this->queue_type = QueueType::find($queue_type);
        $this->antrian = $antrian;
        $this->channel = $channel;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new Channel($this->channel);
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
        return ['antrian'=>$this->antrian,'loket'=>$this->loket->loket_name,'queue_type'=>$this->queue_type->name];
    }
}
