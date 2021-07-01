<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Membership extends Model
{
    protected $table = 'membership';

    protected $fillable = [
        'title', 'photo', 'qualifications' ,'features', 'created_at', 'updated_at',
    ];


//    protected $casts = [
//        'qualifications' => 'array',
//        'features' => 'array',
//    ];


    public function scopeSelection($query){
        return $query -> select('id','title', 'photo', 'qualifications' ,'features');
    }



    public function getPhotoAttribute($val)
    {
        return ($val !== null) ? asset('front-end/' . $val) : "";

    }

    public function advertiserMembership(){
        return $this ->hasMany(Advertiser::class , 'membership_id','id');
    }
}
