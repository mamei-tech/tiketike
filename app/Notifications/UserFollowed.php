<?php

namespace App\Notifications;
use App\User;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class UserFollowed extends Notification
{
    use Queueable;

    private $userfollower;

    /**
     * Create a new notification instance.
     * @param User $user
     * @return void
     */
    public function __construct(User $userfollower)
    {

        $this->userfollower = $userfollower;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['broadcast','database'];
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
            'data' => "user".$this->userfollower->name." ".$this->userfollower->lastname." te ha empezado a seguir",
            'url' => route('profile.info',['userid' => $this->userfollower->id])
        ];
    }
}
