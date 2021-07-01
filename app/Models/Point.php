<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Point extends Model
{
    protected $table = 'points' ;

    protected $fillable = [
        'activity', 'num_points','code', 'active','total_subscriptions', 'created_at', 'updated_at',
    ];

    public function scopeSelection($query){

        return $query -> select('id' ,'activity', 'num_points','total_subscriptions' );
    }


    public function advertiser(){
        return $this ->hasMany(Advertiser_Points::class , 'point_id','id');
    }


    public function getActive()
    {
        return $this->active == 1 ? 'مفعل' : 'غير مفعل';
    }

}
