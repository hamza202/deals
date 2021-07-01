<?php

namespace App\Notifications;

use App\Models\Advertise_Follower;
use App\Models\Advertiser_Points;
use App\Models\AdvertisingComment;
use Benwilkins\FCM\FcmChannel;
use Benwilkins\FCM\FcmMessage;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\Log;
use LaravelFCM\Facades\FCM;

class NewPointsNotification extends Notification
{
//    use Queueable;
    protected $points, $user;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(Advertiser_Points $points){
        $this->user = $points->advertiser;
        $this->points = $points;
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
            ->line("لقد  حصلت على نقاط جديدة");
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
            'title' => "لقد حصلت على نقاط ",
            'data' =>  $this -> user ->name,
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
            'title' => "لقد حصلت على نقاط ",
            'data' =>  $this -> user ->name ,
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
                'title'        => 'لقد حصلت على نقاط جديدة  ',
                'click_action' => url('/notification'), // Optional
                'photo' => $this->user->photo, // Optional
            ])->data([
                'id' =>   $this ->user->id,
                'user' =>   $this ->user,
                'title'        => 'لقد حصلت على نقاط جديدة  ',
                'data' =>  $this -> user ->name,
            ])->priority(FcmMessage::PRIORITY_HIGH); // Optional - Default is 'normal'.
        Log::info('Comment Notification via FCM: ' . $this -> user ->name);
        return $message;
    }

}
