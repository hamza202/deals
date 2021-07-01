<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SubscriptionRequest extends Model
{
    protected $table = 'subscription_requests' ;

    protected $fillable = [
        'advertiser_id', 'package_id','status','answer', 'created_at', 'updated_at',
    ];

    public function advertiser(){
        return $this ->belongsTo(Advertiser::class , 'advertiser_id','id');
    }

    public function package(){
        return $this ->belongsTo(Subscription_Package::class , 'package_id','id');
    }
}
