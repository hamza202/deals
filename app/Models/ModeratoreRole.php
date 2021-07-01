<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ModeratoreRole extends Model
{
   protected $table  = 'moderator_role';

    protected $fillable = [
        'link','name', 'code' ,'created_at', 'updated_at',
    ];

}
