<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Advertise_Rating extends Model
{
    protected $table = 'advertiser_rating';

    protected $fillable = [
        'advertiser_id','advertising_id','voter_id', 'rating','created_at', 'updated_at',
    ];

    public function scopeSelection($query){

        return $query -> select('id','advertising_id' ,'advertiser_id','voter_id', 'rating');
    }


    public function advertiser(){
        return $this ->belongsTo('App\Models\Advertiser' , 'advertiser_id','id');
    }


    public function voter(){
        return $this ->belongsTo('App\Models\Advertiser' , 'voter_id','id');
    }

    public function rating(){
        return $this ->belongsTo(Advertising::class , 'advertising_id','id');
    }

}
