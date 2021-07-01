<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Chat extends Model
{
   protected $table = 'chats' ;

    protected $fillable = [
        'advertiser_id', 'sender_id','message',
        'created_at', 'updated_at',
    ];


    public function advertiser(){
        return $this ->belongsTo('App\Models\Advertiser' , 'advertiser_id','id');
    }

    public function sender(){
        return $this ->belongsTo('App\Models\Advertiser' , 'sender_id','id');
    }
}
