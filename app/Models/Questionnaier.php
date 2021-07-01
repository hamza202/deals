<?php

namespace App\Models;

use App\Observers\CityObserver;
use Illuminate\Database\Eloquent\Model;

class Questionnaier extends Model
{
    protected $table = 'questionnaire';

    protected $fillable = [
        'url', 'created_at', 'updated_at',
    ];


    public function scopeSelection($query)
    {
        return $query->select('id', 'url');
    }
}
