<?php

namespace App\Models;

use App\Observers\AdvertiserObserver;
use Illuminate\Database\Eloquent\Model;

class Advertiser_Points extends Model
{
   protected $table = 'advertiser_points';

    protected $fillable = [
        'advertiser_id','num_points','point_id', 'activity','created_at', 'updated_at',
    ];

    protected static function boot()
    {
        parent::boot();
//        static::created(function ($model) {
////            if ($model->point_id == 2 OR $model->point_id == 3 OR $model->point_id == 4 OR
////            $model->point_id == 5 OR $model->point_id == 6 OR $model->point_id == 7 OR $model->point_id == 8 OR $model->point_id == 10){
////            $user =$model->advertiser;
////            if (!empty($user))
////             $user->notify(new \App\Notifications\NewPointsNotification($model));}
////        });
    }



    public function scopeSelection($query){

        return $query -> select('id' ,'advertiser_id','point_id','num_points', 'activity');
    }


    public function advertiser(){
        return $this ->belongsTo('App\Models\Advertiser' , 'advertiser_id','id');
    }


    public function advertiserPoint(){
        return $this ->belongsTo('App\Models\Advertiser' , 'advertiser_id','id');
    }


    public function pointActivity(){
        return $this ->belongsTo(Point::class , 'point_id','id');
    }


}
