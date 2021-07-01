<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Slider extends Model
{


    protected $table = 'slider' ;


    protected $fillable = [
        'photo', 'description', 'title','link',
        'created_at', 'updated_at',
    ];


    public function scopeSelection($query){

        return $query -> select('id','description','title','photo');
    }



    public function getPhotoAttribute($val)
    {
        return ($val !== null) ? asset('front-end/' . $val) : asset('front-end/images/pages/background-slider.svg');

    }


}
