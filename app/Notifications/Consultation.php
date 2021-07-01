<?php

namespace App\Notifications;

use App\Models\Advertiser;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class Consultation extends Notification
{
    use Queueable;

    public $advertiser;

    public $subject;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(Advertiser $advertiser ,$subject)
    {
        $this -> advertiser = $advertiser;
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
        $subjects = sprintf('%s: لقد تم الرد على طلب الاستشارة في موقع ديل  ', config('app.name'));

        $greeting = sprintf('مرحبا %s!', $notifiable->name);

        return (new MailMessage)
            ->from('law@dealsa.co', 'Admin')
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
