<?php

use App\Models\Advertising;
use App\Models\SponsoredAds;
use Carbon\Carbon;
use Illuminate\Support\Facades\Config;


if (!function_exists('generateRandomString')) {
    function generateRandomString($length = 5)
    {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }
}


if (!function_exists('advertiser')) {
    function advertiser()
    {
        return auth()->guard('advertiser')->user();
    }
}

if (!function_exists('moderator')) {
    function moderator()
    {
        return auth()->guard('moderator')->user();
    }
}


if (!function_exists('advertiserPoints')) {
    function advertiserPoints($id)
    {
        $points = 0;
        $rows = \App\Models\Advertiser_Points::where('advertiser_id', $id)->get();
        foreach ($rows as $row) {
            $points += $row->num_points;
        }
        return $points;
    }
}


if (!function_exists('advertiserActive')) {
    function advertiserActive($id)
    {
        $user = \App\Models\Advertiser::where('id', $id)->first();
        if ($user->is_active == 0) {
            return false;
        } else {
            return true;
        }
    }
}


function uploadImage($folder, $image)
{
    $imageName = $image->getClientOriginalName();
    $path = 'images/' . $folder . '/' . $imageName;
    $image->move(public_path('front-end/images/' . $folder), $imageName);
    return $path;
}


if (!function_exists('secondCategoryHeader')) {
    function secondCategoryHeader()
    {
        $categories = \App\Models\Category::where('parent_id', 0)->get();

        $categories1 = $categories->filter(function ($value, $key) {
            return $value['id'] != 1;
        });


        $firstCategory = array();

        foreach ($categories1 as $category) {
            $data['id'] = $category->id;
            $data['count'] = $category->advertising->count();
            array_push($firstCategory, $data);
        }
        $array = collect($firstCategory)->sortBy('count')->reverse()->toArray();

        $a = array_values($array);

        return $a[0]['id'];
    }

}


if (!function_exists('allCategoryHeader')) {
    function allCategoryHeader()
    {
        $categories = \App\Models\Category::all();

        $categories1 = $categories->filter(function ($value, $key) {
            return $value['id'] != 1 && $value['id'] != secondCategoryHeader();
        });


        $categories2 = $categories1->filter(function ($value, $key) {
            return $value['parent_id'] == 0;
        });

        return $categories2;
    }

}


if (!function_exists('CategoryName')) {
    function CategoryName($id)
    {
        $name = \App\Models\Category::find($id);
        return $name->name;
    }

}


if (!function_exists('CategoryRating')) {
    function CategoryRating($id)
    {
        $advertising = Advertising::with('advertisingComments', 'ratingAdvertising', 'advertiserCategory', 'Advertiser', 'cityAdvertising')
            ->where('id', $id)->first();
        $total_rate = 0;


        if (!empty($advertising->ratingAdvertising)) {

            $rating = $advertising->ratingAdvertising;

            $count = $advertising->ratingAdvertising->count();


            foreach ($rating as $rate) {
                $total_rate += $rate->rating;
            }

            if ($total_rate != 0) {
                $total_rate = round($total_rate / $count);
            }
        }


        return $total_rate;
    }

}


if (!function_exists('AdvertisingFavourite')) {
    function AdvertisingFavourite($id)
    {
        $advertising = Advertising::with('favouriteAdvertising')
            ->where('id', $id)->first();

        $data = $advertising->favouriteAdvertising;

        if (!empty($data) and !empty(advertiser()->id)) {
            foreach ($data as $data1) {
                if ($data1->advertiser_id == advertiser()->id) {
                    return true;
                }
            }
        }
        return false;
    }

}


if (!function_exists('isFollowing')) {
    function isFollowing($id)
    {

        $advertising = \App\Models\Advertise_Follower::where('advertiser_id', $id)
            ->where('follower_id', advertiser()->id)
            ->first();

        if (!empty($advertising)) {
            return true;
        }
        return false;
    }

}


if (!function_exists('advertiserRating')) {
    function advertiserRating()
    {
        $advertising = \App\Models\Advertise_Rating::where('advertiser_id', advertiser()->id)
            ->get();

        $total_rate = 0;

        if (!empty($advertising)) {

            $count = $advertising->count();

            foreach ($advertising as $rate) {
                $total_rate += $rate->rating;
            }
        }

        if ($total_rate != 0) {
            $total_rate = round($total_rate / $count);
        }

        return $total_rate;
    }

}


if (!function_exists('CategoryActive')) {
    function CategoryActive($id)
    {
        $name = \App\Models\Category::find($id);
        $data = $name->advertising;
        $count = 0;
        foreach ($data as $row) {
            if ($row->status == 2 or $row->status == 3 or $row->status == 4) {
                $count++;
            }
        }
        return $count;
    }

}

/**
 *  By : Mai Ghazal
 *  4/2/2021 12:43AM
 */
if (!function_exists('statusDate')) {
    function statusDate($id)
    {
        $checkData = SponsoredAds::where('id', $id)->first();
        $check = Carbon::now()->between($checkData->start_date, $checkData->end_date);  // bool(true)
        if ($check) {
            return "مفعل";
        } else {
            return "غير مفعل";

        }
    }

}




