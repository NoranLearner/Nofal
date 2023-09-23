<?php

namespace App\Events;

use Carbon\Carbon;
use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class NewNotification implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $id;
    public $post_title;
    public $status;
    public $approvedMessage;
    public $date;
    public $time;

    /**
     * Create a new event instance.
     */
    public function __construct($data =[])
    {
        $this->id = $data['id'];
        $this->post_title = $data['post_title'];
        $this->status = $data['status'];
        $this->status == 1 ?  $this->approvedMessage = 'The post {'. $this->post_title .'} was approved' : $this->approvedMessage ='Approval For Post {'. $this->post_title .'} is still waiting';
        $this->date= date("Y-m-d",strtotime(Carbon::now()));
        $this->time= date("h:i A",strtotime(Carbon::now()));
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return array<int, \Illuminate\Broadcasting\Channel>
     */
    public function broadcastOn(): array
    {
        /* return [
            new PrivateChannel('channel-name'),
        ]; */

        /* return [
            new Channel('new-notification'),
        ]; */

        return ['new-notification'];
    }
}
