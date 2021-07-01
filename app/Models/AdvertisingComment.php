<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AdvertisingComment extends Model
{
   protected $table = 'advertising_comments';

    protected $fillable = [
        'advertising_id','writer_id', 'comment','parent_id', 'created_at', 'updated_at',
    ];

    public function scopeSelection($query){

        return $query -> select('id' ,'advertising_id','writer_id', 'comment' ,'created_at');
    }


    public function advertising(){
        return $this ->belongsTo(Advertising::class , 'advertising_id','id');
    }


    public function advertiser(){
        return $this ->belongsTo(Advertiser::class , 'writer_id','id');
    }

}
