<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Page extends Authenticatable
{

    protected $table = 'pages' ;

    protected $fillable = [
        'page_name','photos', 'content', 'created_at', 'updated_at',
    ];


    public function scopeSelection($query){

        return $query -> select('id','page_name','photos', 'content');
    }




}
