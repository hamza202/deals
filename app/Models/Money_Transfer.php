<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Money_Transfer extends Model
{
    protected $table = 'money_transfer';

    protected $fillable = [
        'bank_name', 'name', 'email', 'phone', 'reason', 'advertising_id', 'status', 'money', 'files', 'created_at', 'updated_at',
    ];

    public function advertising()
    {
        return $this->belongsTo(Advertising::class, 'advertising_id', 'id');
    }

    public function getFilesAttribute($val)
    {
        return ($val !== null) ? asset('front-end/images/advertising-images/' . $val) : null;

    }

}
