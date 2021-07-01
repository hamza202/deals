<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Advertising_Package extends Model
{
   protected $table = 'advertising_package';

    protected $fillable = [
    'name','price', 'duration', 'created_at', 'updated_at',
    ];


    public function scopeSelection($query){

        return $query -> select('id','name','price', 'duration');
    }

    public function advertisingPackage(){
        return $this ->hasMany(Advertising::class , 'package_id','id');
    }

}
