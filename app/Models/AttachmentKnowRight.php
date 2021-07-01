<?php

namespace App\Models;

use App\Observers\CityObserver;
use Illuminate\Database\Eloquent\Model;

class AttachmentKnowRight extends Model
{
    protected $table = 'attachment_know_rights';

    protected $fillable = [
        'url','name', 'created_at', 'updated_at',
    ];


    public function scopeSelection($query)
    {
        return $query->select('id', 'url');
    }

    public function getUrlAttribute($val)
    {
        return ($val !== null) ? asset('front-end/images/advertising-images/' . $val) : null;

    }
}
