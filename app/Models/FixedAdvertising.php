<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FixedAdvertising extends Model
{
   protected $table  = 'fixed_advertising';

    protected $fillable = [
        'advertiser_id','advertising_id','subscriptions_id','reason', 'status' ,'created_at', 'updated_at',
    ];

    public function scopeSelection($query){

        return $query -> select('id' ,'advertiser_id','advertising_id');
    }


    public function advertising(){
        return $this ->belongsTo(Advertising::class , 'advertising_id','id');
    }


    public function Advertiser(){
        return $this ->belongsTo('App\Models\Advertiser' , 'advertiser_id','id');
    }

    public function Subscription(){
        return $this ->belongsTo(Subscription::class , 'subscriptions_id','id');
    }
}
