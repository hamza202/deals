<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Know_Rights extends Model
{
    protected $table = 'know_rights';

    protected $fillable = [
        'title', 'content', 'photo', 'created_at', 'updated_at',
    ];


    public function scopeSelection($query)
    {

        return $query->select('id', 'title', 'content', 'photo');
    }


    public function getPhotoAttribute($val)
    {
        return ($val !== null) ? asset('front-end/' . $val) : "";

    }

}
