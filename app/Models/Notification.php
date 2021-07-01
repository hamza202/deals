<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use LaravelFCM\Facades\FCM;
use LaravelFCM\Message\OptionsBuilder;
use LaravelFCM\Message\PayloadDataBuilder;
use LaravelFCM\Message\PayloadNotificationBuilder;


class Notification extends Model
{
    protected $table = 'notifications';


    public static function toSingleDevice($token = null,$title =null,$body = null , $icon, $click_action)
    {
        $optionBuilder = new OptionsBuilder();

        $optionBuilder->setTimeToLive(60 * 20);
        $notificationBuilder = new PayloadNotificationBuilder($title);
        $notificationBuilder->setBody($body)
            ->setSound('default')
            ->setBadge(1)
           ->setIcon($icon)
            ->setClickAction($click_action);

        $dataBuilder = new PayloadDataBuilder();
        $option = $optionBuilder->build();
        $notification = $notificationBuilder->build();
        $data = $dataBuilder->build();
        $downstreamResponse = FCM::sendTo($token, $option, $notification, $data);
        $downstreamResponse->numberSuccess();
        $downstreamResponse->numberFailure();
        $downstreamResponse->numberModification();
        $downstreamResponse->tokensToDelete();
        $downstreamResponse->tokensToModify();
        $downstreamResponse->tokensToRetry();
        $downstreamResponse->tokensWithError();


    }

    public static function toMultiDevice($model ,$token = null,$title =null,$body = null , $icon, $click_action){
        $optionBuilder = new OptionsBuilder();
        $optionBuilder->setTimeToLive(60*20);
        $notificationBuilder = new PayloadNotificationBuilder($title);
        $notificationBuilder->setBody($body)
            ->setSound('default')
            ->setBadge(1)
            ->setIcon($icon)
            ->setClickAction($click_action);
        $dataBuilder = new PayloadDataBuilder();
        $dataBuilder->addData(['a_data' => 'my_data']);
        $option = $optionBuilder->build();
        $notification = $notificationBuilder->build();
        $data = $dataBuilder->build();
        $tokens = $model->pluck('fcm_token')->toArray();
        $downstreamResponse = FCM::sendTo($tokens, $option, $notification, $data);
        $downstreamResponse->numberSuccess();
        $downstreamResponse->numberFailure();
        $downstreamResponse->numberModification();
        $downstreamResponse->tokensToDelete();
        $downstreamResponse->tokensToModify();
        $downstreamResponse->tokensToRetry();
        $downstreamResponse->tokensWithError();
    }

public static function numberAlert(){}
}
