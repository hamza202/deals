<?php

namespace App\Http\Controllers\FrontEnd;

use App\Http\Controllers\Controller;
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

class SearchController extends Controller
{
    public function firstSearch(Request $request)
    {
        try {

            $rows = null;

            $first_form = '1';

            if (request()->has('filter')) {
                $filter = request('filter');
                $rows1 = Advertising::where('id', 'LIKE', "%$filter%")
                    ->orWhere('description', 'LIKE', "%$filter%")
                    ->orWhere('price', 'LIKE', "%$filter%")
                    ->orWhere('phone', 'LIKE', "%$filter%")
                    ->orWhere('special_conditions', 'LIKE', "%$filter%")
                    ->orWhere('title', 'LIKE', "%$filter%")
                    ->get();


                $rows2 = $rows1->filter(function ($value, $key) {
                    return $value['status'] == 1 OR $value['status'] == 2 ;
                });


                $rows = $rows2->filter(function ($value, $key) {
                    return $value['start_date'] <= Carbon::today()->format('Y-m-d');
                });
            }

            return view('front-end.advertising.result', compact('rows', 'first_form'));
        } catch (\Exception $ex) {

            return redirect()->route('index')->with(['error' => 'هناك خطا ما يرجي المحاوله فيما بعد']);
        }
    }

    public function secondSearch(Request $request)
    {

        try {

            $rows = null;
            $second_form = '1';
            $cities = City::all();
            $category = Category::all();
            $main_category = $category->filter(function ($value, $key) {
                return $value['parent_id'] == 0;
            })->pluck("name", "id");


            if (request()->has('city_id') AND request()->has('category_id') AND request()->has('state')) {
                $city_id = request('city_id');
                $category_id = request('category_id');
                $subCategory = request('state');
                $rows = Advertising::where('city_id', $city_id)
                    ->orwhere('category_id', $category_id)
                    ->orwhere('sub_category_id', $subCategory)
                    ->get();
            } elseif (request()->has('city_id')) {
                $city_id = request('city_id');
                $rows = Advertising::where('city_id', $city_id)
                    ->get();
            } elseif (request()->has('category_id') AND request()->has('state')) {
                $category_id = request('category_id');
                $subCategory = request('state');
                $rows = Advertising::where('category_id', $category_id)
                    ->orwhere('sub_category_id', $subCategory)
                    ->get();
            }

            if ($rows != null) {
                $rows2 = $rows->filter(function ($value, $key) {
                    return $value['status'] == 1 OR $value['status'] == 2 ;
                });


                $rows = $rows2->filter(function ($value, $key) {
                    return $value['start_date'] <= Carbon::today()->format('Y-m-d');
                });
            }

            return view('front-end.advertising.result', compact('rows', 'second_form', 'main_category', 'cities'));
        } catch (\Exception $ex) {

            return redirect()->route('index')->with(['error' => 'هناك خطا ما يرجي المحاوله فيما بعد']);
        }
    }


    public function thirdSearch(Request $request)
    {

        try {

            $rows = null;
            $third_form = '1';

            $cities = City::all();
            $category = Category::all();

            $main_category = $category->filter(function ($value, $key) {
                return $value['parent_id'] == 0;
            })->pluck("name", "id");

            if (request()->has('city_id') AND request()->has('name') AND request()->has('category_id') AND request()->has('state')) {
                $city_id = request('city_id');
                $category_id = request('category_id');
                $subCategory = request('state');
                $name = request('name');
                $rows = Advertising::where('city_id', $city_id)
                    ->orwhere('category_id', $category_id)
                    ->orwhere('sub_category_id', $subCategory)
                    ->orwhere('title', $name)
                    ->get();
            } elseif (request()->has('city_id') AND request()->has('category_id') AND request()->has('state')) {
                $city_id = request('city_id');
                $category_id = request('category_id');
                $subCategory = request('state');
                $rows = Advertising::where('city_id', $city_id)
                    ->orwhere('category_id', $category_id)
                    ->orwhere('sub_category_id', $subCategory)
                    ->get();
            } elseif (request()->has('city_id')) {
                $city_id = request('city_id');
                $rows = Advertising::where('city_id', $city_id)
                    ->get();
            } elseif (request()->has('category_id') AND request()->has('state')) {
                $category_id = request('category_id');
                $subCategory = request('state');
                $rows = Advertising::where('category_id', $category_id)
                    ->orwhere('sub_category_id', $subCategory)
                    ->get();
            }

            if ($rows != null) {
                $rows2 = $rows->filter(function ($value, $key) {
                    return $value['status'] == 1 OR $value['status'] == 2 ;
                });


                $rows = $rows2->filter(function ($value, $key) {
                    return $value['start_date'] <= Carbon::today()->format('Y-m-d');
                });
            }

            return view('front-end.advertising.result', compact('rows', 'third_form', 'main_category', 'cities'));
        } catch (\Exception $ex) {
            return redirect()->route('index')->with(['error' => 'هناك خطا ما يرجي المحاوله فيما بعد']);
        }
    }

    //اضافة اعلان االى المفضلة
    public function addFavourite($id, $form_type)
    {
        try {
            if(advertiser() ->email == null OR advertiser() ->is_active == 0){

                return redirect()->route('index')->with(['error' => 'لا يمكنك الاستفادة من خدمات الموقع قبل اكمال بيانات حسابك']);
            }

            $check = Black_List::where('advertiser_id' , advertiser() ->id)->first();
            if ($check != null){
                return redirect()->route('index')->with(['error' => 'لا يمكنك الاستفادة من خدامات الموقع بسبب وجودك بالقائمة السوداء']);

            }

            if ($form_type == 0) {
                $type = 'index.first_search';
            } elseif ($form_type == 2) {

                $type = 'index.third_search';
            } else {
                $type = 'index.second_search';
            }

            $advertiser = Advertiser::find(advertiser()->id);

            if (!$advertiser)
                return redirect()->route($type)->with(['error' => 'هناك خطأ حاول فى وقت اخر ']);


            $advertising_data = Advertising::find($id);

            if (!$advertising_data)
                return redirect()->route($type)->with(['error' => 'هناك خطأ حاول فى وقت اخر ']);

            $advertiserFavorite = $advertiser->advertiserFavourite;


            if (!empty($advertiserFavorite)) {
                foreach ($advertiserFavorite as $favorite) {
                    if ($favorite->advertising_id == $id) {
                        return redirect()->route($type)->with(['error' => '  لقد قمت بإضافة الاعلان الى المفضلة من قبل']);
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
            $advertiser->advertising_id = $id;
            $advertiser->save();
            return redirect()->route($type)->with(['success' => 'تمت الاضافة الى المفضلة بنجاح']);

        } catch (\Exception $ex) {
            return redirect()->route($type)->with(['error' => 'حدث خطا ما الرجاء المحاوله لاحقا']);
        }

    }

    //حذف الاعلان من المفضلة
    public function removeFavourite($id, $form_type)
    {


        try {

            if(advertiser() ->email == null OR advertiser() ->is_active == 0){

                return redirect()->route('index')->with(['error' => 'لا يمكنك الاستفادة من خدمات الموقع قبل اكمال بيانات حسابك']);
            }
            $check = Black_List::where('advertiser_id' , advertiser() ->id)->first();
            if ($check != null){
                return redirect()->route('index')->with(['error' => 'لا يمكنك الاستفادة من خدامات الموقع بسبب وجودك بالقائمة السوداء']);

            }
            $advertiser = Advertiser::find(advertiser()->id);

            if ($form_type == 0) {
                $type = 'index.first_search';
            } elseif ($form_type == 2) {

                $type = 'index.third_search';
            } else {
                $type = 'index.second_search';
            }

            if (!$advertiser)
                return redirect()->route($type)->with(['error' => 'هناك خطأ حاول فى وقت اخر ']);


            $advertising_data = Advertising::find($id);

            if (!$advertising_data)
                return redirect()->route($type)->with(['error' => 'هناك خطأ حاول فى وقت اخر ']);

            $advertiserFavorite = $advertiser->advertiserFavourite;


            if (!empty($advertiserFavorite)) {
                foreach ($advertiserFavorite as $favorite) {
                    if ($favorite->advertising_id == $id) {
                        $favorite->delete();
                        return redirect()->route($type)->with(['success' => ' لقد قمت بحذف الاعلان من المفضلة بنجاح ']);
                    }
                }
            }

            return redirect()->route($type)->with(['error' => 'حدث خطا ما الرجاء المحاوله لاحقا']);

        } catch (\Exception $ex) {
            return redirect()->route($type)->with(['error' => 'حدث خطا ما الرجاء المحاوله لاحقا']);
        }

    }
}
