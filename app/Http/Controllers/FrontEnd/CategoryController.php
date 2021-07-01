<?php

namespace App\Http\Controllers\FrontEnd;

use App\Http\Controllers\Controller;
use App\Models\Advertise_Follower;
use App\Models\Advertiser;
use App\Models\Advertiser_Favourite;
use App\Models\Advertiser_Points;
use App\Models\Advertising;
use App\Models\Black_List;
use App\Models\Category;
use App\Models\City;
use App\Models\Point;
use Carbon\Carbon;
use Illuminate\Http\Request;

class CategoryController extends Controller
{

    // صفحة عرض اعلانات القسم
    public function index($id){
        $cities = City::all();
        $category = Category::all();

        $main_category = $category->filter(function ($value, $key) {
            return $value['parent_id'] == 0;
        })->pluck("name", "id");

        $category_advertising = Category::with('advertising') ->where('id' , $id) -> first();


        if (advertiser() != null){
            $category_advertising->increment('counter', 1);
        }


        $constant_category =   $category_advertising -> advertising -> filter(function ($value, $key) {
            return $value['status'] == 2 AND $value['start_date'] <= Carbon::today()->format('Y-m-d');
        }) ;
        $today = Carbon::today()->format('Y-m-d');

        $first_advertising  = Advertising::where('status' , 2)
            ->whereDate('start_date', '<=', $today)
            ->first();
        foreach($constant_category as $k => $val) {
            if($val-> start_date > Carbon::today()->format('Y-m-d') OR $val-> start_date == null) {
                unset($constant_category[$k]);
            }
        }

        $change_category =   $category_advertising -> advertising -> filter(function ($value, $key) {
            return $value['status'] == 1  AND $value['start_date'] <= Carbon::today()->format('Y-m-d');
        }) ;

        foreach($change_category as $k => $val) {
            if($val-> start_date > Carbon::today()->format('Y-m-d') OR $val-> start_date == null) {
                unset($change_category[$k]);
            }
        }

        return view('front-end.advertising.Category' , compact('first_advertising','category_advertising' , 'constant_category' , 'change_category', 'main_category', 'cities' ));
    }


    //اضافة اعلان االى المفضلة
    public function addFavourite($id ,$card_id){

        try {

            if(advertiser() ->email == null OR advertiser() ->is_active == 0){

                return redirect()->route('advertising.edit')->with(['error' => 'لا يمكنك الاستفادة من خدمات الموقع قبل اكمال بيانات حسابك']);
            }


            $check = Black_List::where('advertiser_id' , advertiser() ->id)->first();
            if ($check != null){
                return redirect()->route('advertising.edit', $card_id)->with(['error' => 'لا يمكنك الاستفادة من خدامات الموقع بسبب وجودك بالقائمة السوداء']);

            }

            $advertiser = Advertiser::find(advertiser() -> id);

            if (!$advertiser)
                return redirect()->route('Category',$card_id)->with(['error' => 'هناك خطأ حاول فى وقت اخر ']);


            $advertising_data = Advertising::find($id);

            if (!$advertising_data)
                return redirect()->route('Category',$card_id)->with(['error' => 'هناك خطأ حاول فى وقت اخر ']);

            $advertiserFavorite = $advertiser -> advertiserFavourite  ;


            if (!empty($advertiserFavorite)){
                foreach ($advertiserFavorite as $favorite){
                    if ($favorite -> advertising_id == $id){
                        return redirect()->route('Category',$card_id)->with(['error' => ' لقد قمت بإضافة الاعلان الى المفضلة من قبل']);
                    }
                }
            }

            $row = Advertiser_Favourite::where('advertising_id', $id)->first();
            $adveriser_id = Advertising::where('id' ,$id) ->first();
            if ($row == null ) {
                $points = Point::where('code', 7)->first();
                if ($points ->active == 1){
                $point = new Advertiser_Points();
                $point->advertiser_id = $adveriser_id -> advertiser_id;
                $point->num_points = $points->num_points;
                $point->activity = $points->activity;
                $point->point_id = $points->id;
                $point->save();}
            }

            // save date
            $advertiser = new Advertiser_Favourite();
            $advertiser->advertiser_id = advertiser()->id;
            $advertiser->advertising_id =  $id;
            $advertiser->save();
            return redirect()->route('Category',$card_id)->with(['success' => 'تمت الاضافة الى المفضلة بنجاح']);

        } catch (\Exception $ex) {
            return redirect()->route('Category',$card_id)->with(['error' => 'حدث خطا ما الرجاء المحاوله لاحقا']);
        }

    }

    //حذف الاعلان من المفضلة

    public function removeFavourite($id ,$card_id ){

        try {

            if(advertiser() ->email == null OR advertiser() ->is_active == 0){

                return redirect()->route('advertising.edit')->with(['error' => 'لا يمكنك الاستفادة من خدمات الموقع قبل اكمال بيانات حسابك']);
            }


            $check = Black_List::where('advertiser_id' , advertiser() ->id)->first();
            if ($check != null){
                return redirect()->route('advertising.edit', $card_id)->with(['error' => 'لا يمكنك الاستفادة من خدامات الموقع بسبب وجودك بالقائمة السوداء']);

            }
            $advertiser = Advertiser::find(advertiser() -> id);

            if (!$advertiser)
                return redirect()->route('Category',$card_id)->with(['error' => 'هناك خطأ حاول فى وقت اخر ']);


            $advertising_data = Advertising::find($id);

            if (!$advertising_data)
                return redirect()->route('Category',$card_id)->with(['error' => 'هناك خطأ حاول فى وقت اخر ']);

            $advertiserFavorite = $advertiser -> advertiserFavourite  ;


            if (!empty($advertiserFavorite)){
                foreach ($advertiserFavorite as $favorite){
                    if ($favorite -> advertising_id == $id){
                        $favorite -> delete();
                        return redirect()->route('Category',$card_id)->with(['success' => ' لقد قمت بحذف الاعلان من المفضلة بنجاح ']);
                    }
                }
            }

            return redirect()->route('Category',$card_id)->with(['error' => 'حدث خطا ما الرجاء المحاوله لاحقا']);

        } catch (\Exception $ex) {
            return redirect()->route('Category',$card_id)->with(['error' => 'حدث خطا ما الرجاء المحاوله لاحقا']);
        }

    }
}
