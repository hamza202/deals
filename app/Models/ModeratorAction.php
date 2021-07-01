<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;


class ModeratorAction extends Authenticatable
{

    protected $table = 'moderator_actions' ;


    protected $fillable = [
        'moderator_id', 'role_id',
    ];


}
