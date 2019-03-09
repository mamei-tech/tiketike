<?php

namespace App\Notifications;

use App\Raffle;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class RaffleWinned extends Notification
{
    use Queueable;
    private $raffle;

    /**
     * Create a new notification instance.
     * @param Raffle $raffle
     * @return void
     */
    public function __construct(Raffle $raffle)
    {
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
                    ->line('Congrats!!! You have winned a raffle '.$this->raffle->title.'. Soon we will send you an interface for bla bla bla')
                    ->action('Notification Action', url('main'))
                    ->line('Again, congrats!!!');
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
            'data' => 'Congrats!!! You have winned a raffle '.$this->raffle->title.'. Soon we will send you an interface for bla bla bla',
            'url' => route('main')
        ];
    }
}
