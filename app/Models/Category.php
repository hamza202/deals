<?php

namespace App\Models;

use App\Observers\CategoryObserver;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = 'categories' ;

    protected $fillable = [
        'name', 'parent_id','counter', 'created_at', 'updated_at',
    ];

    protected static function boot()
    {
        parent::boot();
        Category::observe(CategoryObserver::class);
    }


    public function scopeSelection($query){
        return $query -> select('id','name', 'parent_id');
    }

    // get all main categories
    public function scopeMaincategory($query){
        return  $query -> where('parent_id',0);
    }



    // get all sub categories of main Category
    public function subCategories()
    {
        return $this->hasMany(self::class, 'parent_id');
    }

    public function subMainCategories()
    {
        return $this->belongsTo(self::class, 'parent_id');
    }


    public function advertising()
    {
        return $this->hasMany(Advertising::class, 'category_id','id');
    }

    public function advertisingSubCategory()
    {
        return $this->hasMany(Advertising::class, 'sub_category_id','id');
    }

}
