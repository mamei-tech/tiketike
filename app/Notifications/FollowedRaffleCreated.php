<?php

namespace App\Notifications;

use App\Raffle;
use App\User;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class FollowedRaffleCreated extends Notification
{
    use Queueable;
    private $raffle;
    private $user;

    /**
     * Create a new notification instance.
     * @param Raffle $raffle
     * @param User $user
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
        return ['mail','broadcast','database'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
                    ->line("You'r friend ".$this->user->name." ".$this->user->lastname." has created a new raffle. Are you interested?")
                    ->action('Look it here', route('raffle.tickets.available',['raffleId' => $this->raffle->id]))
                    ->line("Hey, we'r waiting for you!!");
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
            'data' => "You'r friend ".$this->user->name." ".$this->user->lastname." has created a new raffle. Are you interested?",
            'url' => route('raffle.tickets.available',['raffleId' => $this->raffle->id])
        ];
    }
}
