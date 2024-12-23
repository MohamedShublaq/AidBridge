<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class UnvailableAidRequestNotification extends Notification
{
    use Queueable;

    protected $unavailable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($unavailable)
    {
        return $this->unavailable = $unavailable;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['database','broadcast'];
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
                    ->line('The introduction to the notification.')
                    ->action('Notification Action', url('/'))
                    ->line('Thank you for using our application!');
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
            'ngoName' => $this->unavailable->aid->ngo->name,
            'aidName' => $this->unavailable->aid->name,
        ];
    }

    public function databaseType(object $notifiable): string
    {
        return 'UnvailableAidRequestNotification';
    }

    public function broadcastType(): string
    {
        return 'UnvailableAidRequestNotification';
    }
}