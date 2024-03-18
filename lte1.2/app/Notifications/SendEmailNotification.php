<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\SimpleMessage;


class SendEmailNotification extends Notification
{
    use Queueable;
    private $details;
    /**
     * Create a new notification instance.
     */
    public function __construct($details)
    {
        $this->details = $details;
        //
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
   /* public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
                    ->subject($this->details['name'])
                    ->greeting($this->details['name'])
                    ->line($this->details['message']);
                    
    }
*/


    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
            ->subject('Your Subject Here')
            ->greeting('Hola ' . $this->details['name'] . '!')
            ->line($this->details['message']);
    }




    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            //
        ];
    }
}
