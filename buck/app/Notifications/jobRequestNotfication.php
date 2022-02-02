<?php

namespace App\Notifications;

use App\Job;
use App\User;
use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\BroadcastMessage;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class jobRequestNotfication extends Notification implements ShouldBroadcast
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
                'worker' => User::find($this->job->worker_id),
                'job' => Job::find($this->job->job_id)
            ],
            'created_at' => Carbon::now(),
            'title'=> 'You have a new job application !'

        ]);
    }
     public function toDatabase($notifiable)
    {
       return [
            'worker' => User::find($this->job->worker_id),
            'job' => Job::find($this->job->job_id),
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
            'worker' => User::find($this->job->worker_id),
            'job' => Job::find($this->job->job_id),
        ];
    }
}
