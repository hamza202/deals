<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Plan extends Model
{
    protected $table = 'plan' ;

    protected $fillable = [
        'advertising', 'membership', 'subscriptions_id','created_at', 'updated_at',
    ];

    public function scopeSelection($query){

        return $query -> select('id','advertising', 'membership', 'subscriptions_id');
    }

    public function subscriptionPackage(){
        return $this ->belongsTo(Subscription_Package::class , 'subscriptions_id','id');
    }
}
