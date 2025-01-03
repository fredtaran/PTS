<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class PregnantNotif implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $referring_facility;
    public $referring_facility_name;
    public $referring_md_name;
    public $referred_to_name;
    public $referred_to;
    public $status;

    /**
     * Create a new event instance.
     */
    public function __construct($data, $fac, $referring_md, $fac_to, $status)
    {
        $this->referring_facility = $data['referring_facility'];
        $this->referring_facility_name = $fac->name;
        $this->referring_md_name = $referring_md->lname . ', ' . $referring_md->fname . ' ' . $referring_md->mname;
        $this->referred_to_name = $fac_to->name;
        $this->referred_to = $data['referred_to'];
        $this->status = $status;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return array<int, \Illuminate\Broadcasting\Channel>
     */
    public function broadcastOn(): array
    {
        return ['pregnant_channel'];
    }

    public function broadcastAs()
    {
        return 'pregnant_event';
    }
}
