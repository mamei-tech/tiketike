<?php

namespace App\Notifications;

use App\Raffle;
use App\User;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class RaffleUpdated extends Notification implements ShouldQueue
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
    public function __construct(Raffle $raffle, User $user)
    {
        $this->user = $user;
        $this->raffle = $raffle;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail','database','broadcast'];
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
                    ->line(trans('notifications.raffle_updated_intro').$this->raffle->title.trans('notifications.raffle_updated_endbody'))
                    ->action('You can review it here', route('raffle.tickets.available',['raffleId' => $this->raffle->id]))
                    ->line('Good luck!!');
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
            'data' => trans('notifications.raffle_updated_intro').$this->raffle->title.trans('notifications.raffle_updated_endbody'),
            'url' => route('raffle.tickets.available',['raffleId' => $this->raffle->id])
        ];
    }

    public function broadcastOn()
    {
        return ['chanel-'.$this->user->id];
    }
}
