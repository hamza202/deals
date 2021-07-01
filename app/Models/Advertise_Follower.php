<?php

namespace App\Models;

use App\Observers\FollowerObserver;
use Illuminate\Database\Eloquent\Model;

class Advertise_Follower extends Model
{
    protected $table = 'advertiser_followers';

    protected $fillable = [
        'advertiser_id', 'follower_id', 'created_at', 'updated_at',
    ];





    public function scopeSelection($query)
    {

        return $query->select('id', 'advertiser_id', 'follower_id');
    }


    public function advertiser()
    {
        return $this->belongsTo('App\Models\Advertiser', 'advertiser_id', 'id');
    }


    public function follower()
    {
        return $this->belongsTo('App\Models\Advertiser', 'follower_id', 'id');
    }


}
