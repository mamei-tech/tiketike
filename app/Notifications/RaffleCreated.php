<?php

namespace App\Notifications;

use App\Raffle;
use App\User;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Support\Facades\Auth;

class RaffleCreated extends Notification
{
    use Queueable;

    private $raffle;
    private $user;
    /**
     * Create a new notification instance.
     * @param Raffle $raffle
     * @param User $user
     *
     * @return void
     */
    public function __construct(Raffle $raffle,User $user)
    {
        $this->raffle = $raffle;
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
        return ['broadcast','database'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
//    public function toMail($notifiable)
//    {
//        return (new MailMessage)
//                    ->line(trans('notifications.raffle_created'))
//                    ->action('See it', route('raffle.tickets.available',['raffleId' => sprintf('%.0f',$this->raffle->id)]) )
//                    ->line('Awesome, you did it!!!');
//    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            'data' => trans('notifications.raffle_created'),
            'url' => route('raffle.tickets.available',['raffleId' => sprintf('%.0f',$this->raffle->id)])
        ];
    }

    public function broadcastOn()
    {
        return ['chanel-'.$this->user->id];
    }
}
