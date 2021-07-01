<?php

namespace App\Models;

use App\Observers\CityObserver;
use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    protected $table  = 'cities';

    protected $fillable = [
        'name', 'country_id', 'created_at', 'updated_at',
    ];


    protected static function boot()
    {
        parent::boot();
        City::observe(CityObserver::class);
    }

    public function scopeSelection($query){
        return $query -> select('id' ,'name');
    }



    public function cityAdvertising()
    {
        return $this->hasMany(Advertising::class, 'city_id');
    }

    public function advertiserCity(){
        return $this ->hasMany(Advertiser::class , 'city_id','id');
    }

}
