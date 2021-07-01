<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Gift extends Model
{
  protected $table = 'gifts';

    protected $fillable = [
        'name', 'points', 'photo' ,'membership_id','available', 'created_at', 'updated_at',
    ];

    public function scopeSelection($query){

        return $query -> select('id','name', 'points', 'photo' ,'available' ,'membership_id');
    }


    public function getPhotoAttribute($val)
    {
        return ($val !== null) ? asset('front-end/' . $val) : asset('front-end/images/gifts/gift.jpg');

    }

    public function scopeAvailable($query){
        return  $query -> where('available',1);
    }

    public function scopeNotAvailable($query){
        return  $query -> where('available',0);
    }

    public function getAvailable()
    {
        return $this->available == 1 ? 'متوفر' : 'غير متوفر';

    }


    public  function giftReplace(){
        return $this -> hasMany(Gift_Replace::class,'gift_id','id');
    }

    public  function memberShip(){
        return $this -> belongsTo(Membership::class,'membership_id','id');
    }

}
