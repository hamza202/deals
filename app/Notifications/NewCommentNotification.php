<?php

namespace App\Notifications;

use App\Models\AdvertisingComment;
use Benwilkins\FCM\FcmChannel;
use Benwilkins\FCM\FcmMessage;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\Log;
use LaravelFCM\Facades\FCM;

class NewCommentNotification extends Notification
{
//    use Queueable;
    protected $comment, $user;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(AdvertisingComment $comment){
        $this->comment = $comment;
        $this->advertising = $comment->advertising;
        $this->user = $comment->advertiser;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable){
        $channels = ['database', 'mail', 'fcm'];
//        if ($notifiable->advertiser != null && $notifiable->advertiser->uuid != null) {
//            $channels[] = 'fcm';
//        }
        return $channels;
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
                    ->line("لقد قام ".$this->user->name)
                    ->line("بالتعليق على على اعلانك".$this->advertising->title)
                    ->line($this->comment->comment)
                    ->action('مشاهد التعليق', url('/'));
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
            'id' =>   $this ->user,
            'title' => $this -> comment,
            'data' =>  $this -> advertising,
        ];
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toDatabase($notifiable)
    {
        return [
            'id' =>   $this ->user,
            'title' => $this -> comment,
            'data' =>  $this -> advertising,
        ];
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toFcm($notifiable){
        $message = new FcmMessage();
        $message
        ->to( $notifiable->routeNotificationForFcm($this) )
        ->content([
            'title'        => 'لقد قام ' .$this ->user->name . ' بالتعليق على منشورك',
            'body'         => $this->comment->comment,
            'click_action' => url('/notification'), // Optional
            'photo' => $this->user->photo, // Optional
        ])->data([
            'id' =>   $this->user->id,
            'user' =>   $this->user,
            'title' => $this->comment->comment,
            'data' =>  $this->advertising->title
        ])->priority(FcmMessage::PRIORITY_HIGH); // Optional - Default is 'normal'.
        Log::info('Comment Notification via FCM: ' . $this->comment);
        return $message;
    }

}
