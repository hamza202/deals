<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;


class Moderator extends Authenticatable
{


    use Notifiable;


    protected $table = 'moderators' ;


    protected $guard = 'moderator';


    protected $fillable = [
        'name', 'username', 'email' ,'phone',
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];
}
