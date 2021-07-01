<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Subscription_Package extends Model
{
    protected $table = 'subscriptions_package' ;

    protected $fillable = [
        'name', 'price', 'time_line','discount', 'created_at', 'updated_at',
    ];

    public function scopeSelection($query){

        return $query -> select('id','name','price', 'time_line','discount');
    }

    public function advertisingPackage(){
        return $this ->hasMany(Advertising::class , 'package_id','id');
    }

    public function plan(){
        return $this ->hasOne(Plan::class , 'subscriptions_id','id');
    }

}
