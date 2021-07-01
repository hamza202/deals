<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Report_Abuse extends Model
{
    protected $table = 'report_abuse' ;

    protected $fillable = [
        'advertiser_id', 'address', 'abuse_type','comment', 'created_at', 'updated_at',
    ];

    public function scopeSelection($query){

        return $query -> select('id' , 'advertiser_id', 'address', 'abuse_type','comment' );
    }


    public function advertiser(){
        return $this ->belongsTo(Advertiser::class , 'advertiser_id','id');
    }

}
