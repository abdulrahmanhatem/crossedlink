<?php

namespace App\Notifications;

use App\Job;
use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\BroadcastMessage;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class jobPostedNotfication extends Notification implements ShouldBroadcast
{
    use Queueable;


    public $job;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($job)
    {
        $this->job = $job;

    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['database','broadcast'];
    }

   
    public function toBroadcast($notifiable)
    {
        return new BroadcastMessage([
            "data"=>[
                'jobs' => Job::find($this->job)
            ],
            'created_at' => Carbon::now(),
            'title'=> 'New job Posted !'
        ]);
    }
     public function toDatabase($notifiable)
    {
       return [
                'jobs' => Job::find($this->job)
        ];
    }
    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
                'jobs' => Job::find($this->job)

        ];
    }
}
