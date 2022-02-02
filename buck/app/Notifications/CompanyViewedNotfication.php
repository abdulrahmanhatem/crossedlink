<?php

namespace App\Notifications;

use App\User;
use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\BroadcastMessage;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class CompanyViewedNotfication extends Notification implements ShouldBroadcast
{
    use Queueable;


    public $user;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($user)
    {
        $this->user = $user;

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
                'user' => user::find($this->user)
            ],
            'created_at' => Carbon::now(),
            'title'=> 'someone visted your profile !'

        ]);
    }
     public function toDatabase($notifiable)
    {
       return [
                'user' => user::find($this->user)
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
                'user' => user::find($this->user)

        ];
    }
}
