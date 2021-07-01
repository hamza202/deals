<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Subscription extends Model
{
    protected $table = 'subscriptions' ;

    protected $fillable = [
        'advertiser_id', 'package_id', 'start_date','status','end_date', 'created_at', 'updated_at',
    ];

    public function advertiser(){
        return $this ->belongsTo(Advertiser::class , 'advertiser_id','id');
    }

    public function package(){
        return $this ->belongsTo(Subscription_Package::class , 'package_id','id');
    }
}
