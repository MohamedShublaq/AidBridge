<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class DeletionRequestNotification extends Notification
{
    use Queueable;

    protected  $deletionRequest;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($deletionRequest)
    {
        return $this->deletionRequest = $deletionRequest;
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
            'deletionRequestId' => $this->deletionRequest->id,
            'deletableType' => class_basename($this->deletionRequest->deletable_type),
            'deletableName' => $this->deletionRequest->deletable->name,
            'requester' => $this->deletionRequest->admin->name,
            'responseDeletionLink' => route('admin.responseDeletion'),
        ];
    }

    public function databaseType(object $notifiable): string
    {
        return 'DeletionRequestNotification';
    }

    public function broadcastType(): string
    {
        return 'DeletionRequestNotification';
    }
}
