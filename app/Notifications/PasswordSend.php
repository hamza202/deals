<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class PasswordSend extends Notification
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
        $subjects = sprintf('%s: كلمة المرور الخاصة بحسابك فى موقع     ', config('app.name'));

        $greeting = sprintf('مرحبا %s!', $this -> name);

        return (new MailMessage)
            ->subject($subjects)
            ->greeting($greeting)
            ->line('كلمة المرور الجديدة ')
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
