<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ContactUs extends Notification
{
    use Queueable;

    public $subject;
    public $email;
    public $name;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($name ,$email ,$subject)
    {
        $this -> email = $email;
        $this -> name = $name;
        $this -> subject = $subject;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        $subjects = sprintf('%s: لقد تم الرد على رسالتك     ', config('app.name'));

        $greeting = sprintf('مرحبا %s!', $this -> name);

        return (new MailMessage)
            ->from('bussniss@dealsa.co', 'Admin')
            ->subject($subjects)
            ->greeting($greeting)
            ->salutation('Yours Faithfully')
            ->line($this -> subject)
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
            //
        ];
    }
}
