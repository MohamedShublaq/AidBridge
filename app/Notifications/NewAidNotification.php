<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class NewAidNotification extends Notification
{
    use Queueable;

    protected $aid;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($aid)
    {
        return $this->aid = $aid;
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
            'ngoName' => $this->aid->ngo->name,
            'aidName' => $this->aid->name,
            'aidType' => $this->aid->type,
            'showAidLink' => route('civilian.aids.show' , $this->aid->id),
        ];
    }

    public function databaseType(object $notifiable): string
    {
        return 'NewAidNotification';
    }

    public function broadcastType(): string
    {
        return 'NewAidNotification';
    }
}