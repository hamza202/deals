<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SponsoredAds extends Model
{
    protected $table = 'sponsored_ads';

    protected $fillable = [
        'start_date', 'end_date', 'photo', 'url', 'position',
    ];

    /**
     * @param $val
     * @return string|null
     */
    public function getPhotoAttribute($val)
    {
        return ($val !== null) ? asset('front-end/images/advertising-images/' . $val) : null;

    }
}
