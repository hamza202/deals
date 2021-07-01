<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Gift_Replace extends Model
{
   protected $table  = 'gift_replace';

    protected $fillable = [
        'gift_id', 'address', 'advertiser_id' ,'accept', 'created_at', 'updated_at',
    ];

    public function scopeSelection($query){

        return $query -> select('id','gift_id', 'address', 'advertiser_id' ,'accept');
    }

    public function gift(){
        return $this ->belongsTo(Gift::class , 'gift_id','id');
    }

    public function advertiser(){
        return $this ->belongsTo(Advertiser::class , 'advertiser_id','id');
    }
}
