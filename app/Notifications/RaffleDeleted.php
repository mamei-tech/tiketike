<?php

namespace App\Notifications;

use App\Raffle;
use App\User;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class RaffleDeleted extends Notification
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
    public function __construct(Raffle $raffle, User $user)
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
                    ->line('Sorry fellow, you raffle '.$this->raffle->title.' has been deleted by administrator because no tickets was sold until today...')
                    ->line("don't get down, we hope to see you soon!!!!");
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
            'data' => 'Sorry fellow, you raffle '.$this->raffle->title.' has been deleted by administrator because it dont sell..',
            'url' => route('main')
        ];
    }

    public function broadcastOn()
    {
        return ['chanel-'.$this->user->id];
    }
}
