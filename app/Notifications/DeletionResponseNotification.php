<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class DeletionResponseNotification extends Notification
{
    use Queueable;

    protected  $deletionRequest , $response;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($deletionRequest , $response)
    {
        $this->deletionRequest = $deletionRequest;
        $this->response = $response;
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
            'deletableType' => class_basename($this->deletionRequest->deletable_type),
            'deletableName' => $this->deletionRequest->deletable->name,
            'response' => $this->response,
            'showResponsesLink' => route('admin.showResponses' , $this->deletionRequest->id),
        ];
    }

    public function databaseType(object $notifiable): string
    {
        return 'DeletionResponseNotification';
    }

    public function broadcastType(): string
    {
        return 'DeletionResponseNotification';
    }
}