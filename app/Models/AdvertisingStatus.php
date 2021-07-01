<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AdvertisingStatus extends Model
{
    protected $table  = 'advertising_status';

    protected $fillable = [
        'name', 'created_at', 'updated_at',
    ];


    public function scopeSelection($query){
        return $query -> select('id' ,'name');
    }

}
