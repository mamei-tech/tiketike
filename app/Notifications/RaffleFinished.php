<?php

namespace App\Notifications;

use App\Raffle;
use App\User;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class RaffleFinished extends Notification
{
//    use Queueable;
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
                    ->line('Hey fellow, your raffle '.$this->raffle->title.' has sold all tickets')
                    ->action('Review it', route('raffle.finished.view',['raffleId' => $this->raffle->id]))
                    ->line('Congratulations!! We are very proud of you!!');
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
            'data' => 'Hey fellow, your raffle '.$this->raffle->title.' has sold all tickets',
            'url' => route('raffle.finished.view',['raffleId' => $this->raffle->id])
        ];
    }

    public function broadcastOn()
    {
        return ['chanel-'.$this->user->id];
    }
}
