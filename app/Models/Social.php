<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Social extends Model
{
    protected $table  = 'social';

    protected $fillable = [
        'name', 'link', 'created_at', 'updated_at',
    ];


    public function scopeSelection($query){
        return $query -> select('id' ,'name','link');
    }

}

