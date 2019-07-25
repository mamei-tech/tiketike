<?php

namespace App\Notifications;

use App\Raffle;
use App\User;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class RaffleTerminatedAndNotWinned extends Notification
{
    use Queueable;

    /**
     * @var Raffle $raffle
     */
    private $raffle;

    /**
     * @var User $user
     */
    private $user;

    /**
     * RaffleTerminatedAndNotWinned constructor.
     * @param Raffle $raffle
     * @param User $user
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
                    ->line(trans('notifications.terminated_not_w').$this->raffle->title.trans('notifications.terminated_not_w_endbody'))
                    ->action('Get a view', route('raffle.finished.view',['raffleId' => $this->raffle->id]))
                    ->line('We hope to see you soon!');
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
            'data' => trans('notifications.terminated_not_w').$this->raffle->title.trans('notifications.terminated_not_w_endbody'),
            'url' => route('raffle.finished.view',['raffleId' => $this->raffle->id])
        ];
    }

    public function broadcastOn()
    {
        return ['chanel-'.$this->user->id];
    }
}
