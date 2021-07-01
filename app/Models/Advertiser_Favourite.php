<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Advertiser_Favourite extends Model
{
   protected $table  = 'advertiser_favourites';

    protected $fillable = [
        'advertiser_id','advertising_id',  'created_at', 'updated_at',
    ];



    protected static function boot()
    {
        parent::boot();
        static::created(function ($model) {
        $row = Advertiser_Favourite::where('advertising_id', $model -> advertising_id)->first();
        $adveriser_id = Advertising::where('id' ,$model -> advertising_id) ->first();
        if ($row == null ) {
            $points = Point::where('id', 8)->first();
            $point = new Advertiser_Points();
            $point->advertiser_id = $adveriser_id -> advertiser_id;
            $point->num_points = $points->num_points;
            $point->activity = $points->activity;
            $point->point_id = $points->id;
            $point->save();
        }
        });

    }


    public function scopeSelection($query){

        return $query -> select('id' ,'advertiser_id','advertising_id');
    }


    public function advertising(){
        return $this ->belongsTo(Advertising::class , 'advertising_id','id');
    }


    public function Advertiser(){
        return $this ->belongsTo('App\Models\Advertiser' , 'advertiser_id','id');
    }
}
