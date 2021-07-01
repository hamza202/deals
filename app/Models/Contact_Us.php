<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Contact_Us extends Model
{
    protected $table = 'contact_us' ;

    protected $fillable = [
        'name', 'email','answer','status', 'phone','whatsapp','address' ,'title','message', 'created_at', 'updated_at',
    ];

    public function scopeSelection($query){

        return $query -> select('id','name', 'email', 'phone' ,'title','message');
    }
}
