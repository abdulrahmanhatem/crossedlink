<?php

namespace App\Events;

use App\Job;
use App\User;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class notifyUser implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

   
    // public $job;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct()
    {
        

    }
    public function broadcastAs()
      {
          return 'my-event';
      }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('hi');

    }

    public function broadcastWith() {
         return [
            'data'=>['hi'=>'giii']
            // 'worker' => User::find($this->job->worker_id),
            // 'job' => Job::find($this->job->job_id)
        ];
    }
}
