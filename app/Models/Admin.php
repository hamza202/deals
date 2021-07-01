<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Admin extends Authenticatable
{
    use Notifiable;

    protected $table = 'admins';

    protected $guard = 'admin';

    protected $fillable = [
        'name', 'email', 'password','phone' , 'photo'
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];
    protected $appends = ['uuids', 'uuid'];

    public function uuids(){
        return $this->morphToMany(UUID::class,'uuidable');
    }

    public function getUuidsAttribute(){
        return $this->uuids()->get()->pluck('uuid');
    }

    public function getUuidAttribute(){
        return !$this->uuids()->first()?: $this->uuids()->first()->uuid;
    }

}
