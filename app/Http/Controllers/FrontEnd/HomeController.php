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
use App\Models\Questionnaier;
use App\Models\Slider;
use App\Models\SponsoredAds;
use Carbon\Carbon;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {

        $dateNow = Carbon::now();

        $firstPaner = SponsoredAds::where('position', 0)
            ->whereRaw('"'.$dateNow.'" between `start_date` and `end_date`')
            ->first();

        $secondPaner = SponsoredAds::where('position', 1)
            ->whereRaw('"'.$dateNow.'" between `start_date` and `end_date`')
            ->first();

        //today date to get advertising
        $today = Carbon::today()->format('Y-m-d');

        //fixed advertising in main page
        $first_advertising = Advertising::where('status', 2)
            ->whereDate('start_date', '<=', $today)
            ->first();

        $first_advertising = null;
        $second_advertising = null;

        $fixed_advertising = Advertising::where('status', 2)
            ->whereDate('start_date', '<=', $today)
            ->orderBy('created_at', 'desc')
            ->take(4)
            ->get();

        if (count($fixed_advertising) > 0) {
            $first_advertising = $fixed_advertising[0];
            $second_advertising = $fixed_advertising->shift(0);
        }
        //all advertising & its active
        $all_advertising = Advertising::where('status', 1)
            ->whereDate('start_date', '<=', $today)
            ->orderBy('created_at', 'desc')
            ->get();


        $slider = Slider::orderBy('created_at', 'desc')->get();
        $cities = City::all();
        $category = Category::all();

        //filter category to get main category only
        $main_category = $category->filter(function ($value, $key) {
            return $value['parent_id'] == 0;
        })->pluck("name", "id");


        return view('front-end.app.index', compact('firstPaner','secondPaner' ,'all_advertising', 'first_advertising', 'second_advertising', 'fixed_advertising', 'main_category', 'slider', 'cities'));
    }

    public function index1()
    {
        $dateNow = Carbon::now();

        $firstPaner = SponsoredAds::where('position', 0)
            ->whereRaw('"'.$dateNow.'" between `start_date` and `end_date`')
            ->first();

        $secondPaner = SponsoredAds::where('position', 1)
            ->whereRaw('"'.$dateNow.'" between `start_date` and `end_date`')
            ->first();

        $questionnaires = Questionnaier::first();

        //today date to get advertising
        $today = Carbon::today()->format('Y-m-d');

        //fixed advertising in main page
        $first_advertising = Advertising::where('status', 2)
            ->whereDate('start_date', '<=', $today)
            ->first();

        $first_advertising = null;
        $second_advertising = null;

        $fixed_advertising = Advertising::where('status', 2)
            ->whereDate('start_date', '<=', $today)
            ->orderBy('created_at', 'desc')
            ->take(4)
            ->get();

        if (count($fixed_advertising) > 0) {
            $first_advertising = $fixed_advertising[0];
            $second_advertising = $fixed_advertising->shift(0);
        }
        //all advertising & its active
        $all_advertising = Advertising::where('status', 1)
            ->whereDate('start_date', '<=', $today)
            ->orderBy('created_at', 'desc')
            ->get();


        $slider = Slider::orderBy('created_at', 'desc')->get();
        $cities = City::all();
        $category = Category::all();

        //filter category to get main category only
        $main_category = $category->filter(function ($value, $key) {
            return $value['parent_id'] == 0;
        })->pluck("name", "id");


        return view('front-end.app.index', compact('firstPaner','secondPaner' ,'all_advertising', 'first_advertising', 'second_advertising', 'fixed_advertising', 'main_category', 'slider', 'cities', 'questionnaires'));
    }

    //اضافة اعلان االى المفضلة
    public function addFavourite($id)
    {

        try {


            if (advertiser()->email == null or advertiser()->is_active == 0) {

                return redirect()->route('index')->with(['error' => 'لا يمكنك الاستفادة من خدمات الموقع قبل اكمال بيانات حسابك']);
            }

            $check = Black_List::where('advertiser_id', advertiser()->id)->first();
            if ($check != null) {
                return redirect()->route('index')->with(['error' => 'لا يمكنك الاستفادة من خدامات الموقع بسبب وجودك بالقائمة السوداء']);

            }

            $advertiser = Advertiser::find(advertiser()->id);

            if (!$advertiser)
                return redirect()->route('index')->with(['error' => 'هناك خطأ حاول فى وقت اخر ']);


            $advertising_data = Advertising::find($id);

            if (!$advertising_data)
                return redirect()->route('index')->with(['error' => 'هناك خطأ حاول فى وقت اخر ']);

            $advertiserFavorite = $advertiser->advertiserFavourite;


            if (!empty($advertiserFavorite)) {
                foreach ($advertiserFavorite as $favorite) {
                    if ($favorite->advertising_id == $id) {
                        return redirect()->route('index')->with(['error' => ' لقد قمت بإضافة الاعلان الى المفضلة من قبل']);
                    }
                }
            }
            $row = Advertiser_Favourite::where('advertising_id', $id)->first();
            $adveriser_id = Advertising::where('id', $id)->first();
            if ($row == null) {
                $points = Point::where('code', 7)->first();
                if ($points->active == 1) {
                    $point = new Advertiser_Points();
                    $point->advertiser_id = $adveriser_id->advertiser_id;
                    $point->num_points = $points->num_points;
                    $point->activity = $points->activity;
                    $point->point_id = $points->id;
                    $point->save();
                }
            }
            // save date
            $advertiser = new Advertiser_Favourite();
            $advertiser->advertiser_id = advertiser()->id;
            $advertiser->advertising_id = $id;
            $advertiser->save();
            return redirect()->route('index')->with(['success' => 'تمت الاضافة الى المفضلة بنجاح']);

        } catch (\Exception $ex) {
            return redirect()->route('index')->with(['error' => 'حدث خطا ما الرجاء المحاوله لاحقا']);
        }

    }

    //حذف الاعلان من المفضلة
    public function removeFavourite($id)
    {

        try {

            if (advertiser()->email == null or advertiser()->is_active == 0) {

                return redirect()->route('index')->with(['error' => 'لا يمكنك الاستفادة من خدمات الموقع قبل اكمال بيانات حسابك']);
            }

            $check = Black_List::where('advertiser_id', advertiser()->id)->first();
            if ($check != null) {
                return redirect()->route('index')->with(['error' => 'لا يمكنك الاستفادة من خدامات الموقع بسبب وجودك بالقائمة السوداء']);

            }
            $advertiser = Advertiser::find(advertiser()->id);

            if (!$advertiser)
                return redirect()->route('index')->with(['error' => 'هناك خطأ حاول فى وقت اخر ']);


            $advertising_data = Advertising::find($id);

            if (!$advertising_data)
                return redirect()->route('index')->with(['error' => 'هناك خطأ حاول فى وقت اخر ']);

            $advertiserFavorite = $advertiser->advertiserFavourite;


            if (!empty($advertiserFavorite)) {
                foreach ($advertiserFavorite as $favorite) {
                    if ($favorite->advertising_id == $id) {
                        $favorite->delete();
                        return redirect()->route('index')->with(['success' => ' لقد قمت بحذف الاعلان من المفضلة بنجاح ']);
                    }
                }
            }

            return redirect()->route('index')->with(['error' => 'حدث خطا ما الرجاء المحاوله لاحقا']);

        } catch (\Exception $ex) {
            return redirect()->route('index')->with(['error' => 'حدث خطا ما الرجاء المحاوله لاحقا']);
        }

    }
}
