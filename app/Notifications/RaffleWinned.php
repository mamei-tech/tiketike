<?php

namespace App\Notifications;

use App\Raffle;
use App\User;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class RaffleWinned extends Notification
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
                    ->line(trans('notifications.winned_intro').$this->raffle->title.trans('notifications.winned_end_body'))
                    ->action('Notification Action', route('raffle.finished.view',['raffleId' => $this->raffle->id]))
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
            'data' => trans('notifications.winned_intro').$this->raffle->title.trans('notifications.winned_end_body'),
            'url' => route('raffle.finished.view',['raffleId' => $this->raffle->id])
        ];
    }

    public function broadcastOn()
    {
        return ['chanel-'.$this->user->id];
    }
}
