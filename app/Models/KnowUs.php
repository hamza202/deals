<?php

namespace App\Models;

use App\Observers\CityObserver;
use Illuminate\Database\Eloquent\Model;

class KnowUs extends Model
{
    protected $table = 'know_us';

    protected $fillable = [
        'name', 'created_at', 'updated_at',
    ];


    public function scopeSelection($query)
    {
        return $query->select('id', 'name');
    }

    public  function advertiser(){
        return $this->hasMany(Advertiser::class,'know_us','id');
    }

}
