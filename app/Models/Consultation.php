<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Consultation extends Model
{
    protected $table = 'consultations' ;

    protected $fillable = [
        'advertiser_id', 'name','status','answer', 'email','phone','consultations','created_at', 'updated_at',
    ];

    public function scopeSelection($query){

        return $query -> select('id' ,'status','answer', 'advertiser_id', 'name', 'email','phone','consultations' );
    }


    public function advertiser(){
        return $this ->belongsTo(Advertiser::class , 'advertiser_id','id');
    }

}
