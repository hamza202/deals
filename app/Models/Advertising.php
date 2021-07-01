<?php

namespace App\Models;

use App\Observers\AdvertisingObserver;
use Illuminate\Database\Eloquent\Model;
use Cohensive\Embed\Facades\Embed;

class Advertising extends Model
{
   protected $table = 'advertising' ;
    protected $fillable = [
        'advertiser_id','counter','category_id','package_id', 'sub_category_id','address','description',
        'city_id','title','photos','price','insurance_price','phone','comments', 'special_conditions',
        'is_specialconditions','start_date','end_date', 'is_phone' , 'vedio_url','status' ,'created_at', 'updated_at',
    ];

    protected static function boot()
    {
        parent::boot();
        static::deleted(function ($model) {
            $model->advertisingComments()->delete();
            $model->ratingAdvertising()->delete();
            $model->favouriteAdvertising()->delete();
            $model->money()->delete();
        });
        static::created(function ($model) {
           $row = Advertising::where('advertiser_id' , $model->advertiser_id )->get();
           if ($row == null){
               $points = Point::where('code' , 2)->first();
           }else{
               $points = Point::where('code' , 3)->first();
           }

           if ($points ->active == 1){
            $point = new Advertiser_Points();
            $point -> advertiser_id = $model->advertiser_id;
            $point ->num_points = $points -> num_points;
            $point -> activity= $points ->activity;
            $point -> point_id= $points->id;
            $point -> save();}
        });
        Advertising::observe(AdvertisingObserver::class);
    }


    public static function photoValue($photo)
    {

        if (json_decode($photo) != null)
        {
            return asset('front-end/' . json_decode($photo)[0]);
        }
        return  asset('front-end/images/advertiser-images/no_image.png');
    }


    public function getVedioUrlAttribute($val)
    {
        $url_string = $val;
        $url = str_replace('watch?v=', 'embed/', $url_string);
        return $url;
    }


    public function advertisingComments(){
        return $this ->hasMany(AdvertisingComment::class , 'advertising_id','id');
    }

    public function advertisingPackage(){
        return $this ->belongsTo(Subscription::class , 'package_id','id');
    }

    public function advertiserCategory()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function advertiserSubCategory()
    {
        return $this->belongsTo(Category::class, 'sub_category_id');
    }


    public function Advertiser()
    {
        return $this->belongsTo(Advertiser::class, 'advertiser_id');
    }

    public function cityAdvertising()
    {
        return $this->belongsTo(City::class, 'city_id');
    }

    public function money()
    {
        return $this->belongsTo(Money_Transfer::class, 'advertising_id');
    }

    public function Status()
    {
        return $this->belongsTo(AdvertisingStatus::class, 'status');
    }

    public function ratingAdvertising()
    {
        return $this->hasMany(Advertise_Rating::class, 'advertising_id');
    }

    public function favouriteAdvertising()
    {
        return $this->hasMany(Advertiser_Favourite::class, 'advertising_id');
    }
}
