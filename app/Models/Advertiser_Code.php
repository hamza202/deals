<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Advertiser_Code extends Model
{
   protected $table = 'sms_advertiser_code' ;

    protected $fillable = [
        'advertiser_id', 'advertiser_number','code','status',
        'created_at', 'updated_at',
    ];


    public function scopeSelection($query){

        return $query -> select('id' , 'advertiser_id', 'advertiser_number','code','status');
    }


    public function advertiser(){
        return $this ->belongsTo('App\Models\Advertiser' , 'advertiser_id','id');
    }
}
