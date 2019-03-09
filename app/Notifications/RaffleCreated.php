<?php

namespace App\Notifications;

use App\Raffle;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class RaffleCreated extends Notification
{
    use Queueable;

    private $raffle;
    /**
     * Create a new notification instance.
     * @param Raffle $raffle
     *
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
                    ->line('You have created a new raffle. You can see it clicking at the link bellow.')
                    ->action('See it', route('raffle.tickets.available',['raffleId' => sprintf('%.0f',$this->raffle->id)]) )
                    ->line('Awesome, you did it!!!');
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
            'data' => 'Hi, you have created a new raffle. You can see it clicking at this message.',
            'url' => route('raffle.tickets.available',['raffleId' => sprintf('%.0f',$this->raffle->id)])
        ];
    }

    public function broadcastOn()
    {
        return ['tiketikes'];
    }
}
