<?php
namespace App\Models;

use App\Observers\AdvertiserObserver;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Advertiser extends Authenticatable
{
    use Notifiable;

    protected $table = 'advertisers' ;

    protected $guard = 'advertiser';

    protected $fillable = [
        'name','photo', 'username','email','password','fcm_token','last_login',
        'city_id','is_active','membership_id','address','social','phone','know_us',
        'active_account','messages','created_at', 'updated_at',
    ];

    protected $appends = ['uuids', 'uuid'];

    protected $hidden = [
        'password', 'remember_token',
    ];

    protected static function boot()
    {
        parent::boot();
        static::deleted(function ($model) {
            $model->advertiserFollower()->delete();
            $model->advertiserFollowerAnother()->delete();
            $model->advertiserFavourite()->delete();
            $model->advertiserRating()->delete();
            $model->voterRating()->delete();
            $model->advertiserCode()->delete();
            $model->advertiserPoints()->delete();
            $model->advertiserGift()->delete();
            $model->advertiserWriteComment()->delete();
            $model->abues()->delete();
            $model->consultations()->delete();
            $model->black()->delete();
        });
        static::created(function ($model) {
           $points = Point::where('code' , 1)->first();
           if ($points->active == 1){
           $point = new Advertiser_Points();
           $point->advertiser_id = $model->id;
           $point ->num_points = $points->num_points;
           $point->activity= $points ->activity;
           $point->point_id= $points->id;
           $point->save();}
        });
        Advertiser::observe(AdvertiserObserver::class);
    }


    public function scopeSelection($query){

        return $query->select('id','name','photo','username','email'
            ,'city_id','is_active','membership_id','address','social','phone');
    }



    public function getPhotoAttribute($val)
    {
        return ($val !== null) ? asset('front-end/' . $val) : asset('front-end/images/advertiser-images/16051278.jpg');

    }

    public  function advertiserFollower(){
        return $this->hasMany(Advertise_Follower::class,'advertiser_id','id');
    }


    public  function advertiserFollowerAnother(){
        return $this->hasMany(Advertise_Follower::class,'follower_id','id');
    }

    public  function advertiserFavourite(){
        return $this->hasMany(Advertiser_Favourite::class,'advertiser_id','id');
    }


    public  function advertiserRating(){
        return $this->hasMany(Advertise_Rating::class,'advertiser_id','id');
    }

    public  function voterRating(){
        return $this->hasMany(Advertise_Rating::class,'voter_id','id');
    }

    public function  advertiserCode(){
        return $this-> hasOne(Advertiser_Code::class,'advertiser_id' , 'id');
    }



  public function  black(){
        return $this-> hasOne(Black_List::class,'advertiser_id' , 'id');
    }


    public  function advertiserPoints(){
        return $this->hasMany(Advertiser_Points::class,'advertiser_id','id');
    }

    public function advertiserWriteComment(){
        return $this ->hasMany(AdvertisingComment::class , 'writer_id','id');
    }


    public  function advertiserGift(){
        return $this->hasMany(Gift_Replace::class,'advertiser_id','id');
    }

    public  function advertising(){
        return $this->hasMany(Advertising::class,'advertiser_id','id');
    }


  public  function abues(){
        return $this->hasMany(Report_Abuse::class,'advertiser_id','id');
    }

    public  function consultations(){
        return $this->hasMany(Consultation::class,'advertiser_id','id');
    }


    public function advertiserMembership(){
        return $this ->belongsTo(Membership::class , 'membership_id','id');
    }


    public function advertiserCity(){
        return $this ->belongsTo(City::class , 'city_id','id');
    }

    /**
     * Get all of the uuids for this advertiser.
     */
    public function uuids(){
        return $this->morphToMany(UUID::class,'uuidable');
    }

    public function getUuidsAttribute(){
        return $this->uuids()->get()->pluck('uuid');
    }

    public function getUuidAttribute(){
        return !$this->uuids()->orderBy('created_at','desc')->first()?: $this->uuids()->orderBy('created_at','desc')->first()->uuid;
    }

    /**
     * Route notifications for the FCM channel.
     *
     * @return string
     */
    public function routeNotificationForFcm($notification)
    {
//        return json_encode($this->uuids);
        return $this->uuid ?? '';
    }

}
