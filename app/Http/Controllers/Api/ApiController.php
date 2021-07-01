<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\AdvertisingRequest;
use App\Models\Advertise_Rating;
use App\Models\Advertiser;
use App\Models\Advertising;
use App\Models\AdvertisingComment;
use App\Models\Category;
use App\Models\City;
use Illuminate\Http\Request;

class ApiController extends Controller
{

    public function index(Request $request)
    {
        $advertising = Advertising::all();
        return response()->json($advertising);
    }



}
