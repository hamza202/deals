<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Black_List extends Model
{
    protected $table  = 'black_list';

    protected $fillable = [
        'advertiser_id', 'reason', 'created_at', 'updated_at',
    ];

    public function scopeSelection($query){
        return $query -> select('id','advertiser_id', 'reason');
    }

    public function advertiser(){
        return $this ->belongsTo(Advertiser::class , 'advertiser_id','id');
    }
}
