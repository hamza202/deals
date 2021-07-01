<?php

namespace App\Http\Controllers\FrontEnd;

use App\Http\Controllers\Controller;
use App\Http\Requests\AdvertisingRequest;
use App\Http\Requests\PriceRequest;
use App\Models\Advertise_Rating;
use App\Models\Advertiser;
use App\Models\Advertiser_Favourite;
use App\Models\Advertiser_Points;
use App\Models\Advertising;
use App\Models\AdvertisingComment;
use App\Models\Black_List;
use App\Models\Category;
use App\Models\Chat;
use App\Models\City;
use App\Models\FixedAdvertising;
use App\Models\Money_Transfer;
use App\Models\Notification;
use App\Models\Point;
use App\Models\Subscription;
use Illuminate\Http\Request;

class AdvertisingController extends Controller
{

    public function index()
    {
        if(advertiser() ->email == null OR advertiser() ->is_active == 0){

            return redirect()->route('index')->with(['error' => 'لا يمكنك الاستفادة من خدمات الموقع قبل اكمال بيانات حسابك']);
        }

        $cities = City::all();

        $categories = Category::selection()
            ->get();

        $main_categories1 = $categories->filter(function ($value, $key) {
            return $value['parent_id'] == 0;
        });

        $main_categories = $main_categories1->pluck("name", "id");


        return view('front-end.advertising.create-ad', compact('cities', 'main_categories'));
    }

    public function getSubCategoryList(Request $request)
    {

        $states = Category::where('parent_id', $request->country_id)
            ->pluck("name", "id");

        return response()->json($states);
    }

    public function store(AdvertisingRequest $request)
    {


        try {

            if(advertiser() ->email == null OR advertiser() ->is_active == 0){

                return redirect()->route('advertising')->with(['error' => 'لا يمكنك الاستفادة من خدمات الموقع قبل اكمال بيانات حسابك']);
            }


            $check = Black_List::where('advertiser_id', advertiser()->id)->first();
            if ($check != null) {
                return redirect()->route('advertising')->with(['error' => 'لا يمكنك الاستفادة من خدامات الموقع بسبب وجودك بالقائمة السوداء']);

            }

            $advertiser = Advertiser::find(advertiser()->id);

            if (!$advertiser)
                return redirect()->route('advertising')->with(['error' => 'هناك خطأ حاول فى وقت اخر ']);

            // save date
            $advertising = new Advertising();
            $advertising->advertiser_id = advertiser()->id;
            $advertising->title = $request->title;
            $advertising->start_date = $request->start_date;
            $advertising->end_date = $request->end_date;
            $advertising->title = $request->title;
            $advertising->category_id = $request->category;
            $advertising->package_id = null;
            $advertising->status = 1;
            $advertising->sub_category_id = $request->state;
            $advertising->address = $request->address;
            $advertising->lng = $request->longitude;
            $advertising->lat = $request->latitude;
            $advertising->description = $request->description;
            $advertising->city_id = $request->city_id;
            $advertising->title = $request->title;
            $advertising->photos = $request->photos;
            $advertising->price = $request->price;
            $advertising->insurance_price = $request->insurance_price;
            $advertising->phone = $request->phone;
            $advertising->vedio_url = $request->vedio_url;
            $advertising->commission = $request->discount1;
            $advertising->save();


            // save image

            if ($request->has('files')) {
                $images = array();
                if ($files = $request->file('files')) {
                    foreach ($files as $file) {
                        $filePath = uploadImage('advertising-images', $file);
                        $images[] = $filePath;
                    }
                }

                /*Insert your data*/

                $advertising->update([
                    'photos' => json_encode($images),
                ]);

            }

            if ($request->has('is_specialconditions')) {
                $advertising->update([
                    'is_specialconditions' => '1',
                    'special_conditions' => $request->special_conditions,
                ]);
            }


            if ($request->has('comments')) {
                $advertising->update([
                    'comments' => '1',
                ]);
            }

            if ($request->has('is_phone')) {
                $advertising->update([
                    'is_phone' => '1',
                ]);
            }

            return redirect()->route('index')->with(['success' => '  تم اضافة الاعلان بنجاح ']);

        } catch (\Exception $ex) {
            return redirect()->route('advertising')->with(['error' => 'حدث خطا ما الرجاء المحاوله لاحقا']);
        }
    }


    public function fixed(Request $request)
    {
        try {
            $check = Black_List::where('advertiser_id', advertiser()->id)->first();
            if ($check != null) {
                return redirect()->route('advertiser.profile')->with(['error' => 'لا يمكنك الاستفادة من خدامات الموقع بسبب وجودك بالقائمة السوداء']);
            }

            $advertiser = Advertiser::find(advertiser()->id);

            if (!$advertiser)
                return redirect()->route('advertiser.profile')->with(['error' => 'هناك خطأ حاول فى وقت اخر ']);

            $subscription = Subscription::with('package')->where(['advertiser_id' => advertiser()->id,
                'status' => 1])->first();

            if (!$subscription)
                return redirect()->route('advertiser.profile')->with(['error' => 'غير مشترك بالباقات , الرجاء الاشتراك بالباقات  ']);

            $subscription_count_fixed = FixedAdvertising::where([
                'subscriptions_id' => $subscription->id,
                'status' => 1
            ])->count();

            if ($subscription_count_fixed >= $subscription->package -> plan ->advertising) {
                return redirect()->route('advertiser.profile')->with(['error' => 'قمت بتثبيت عدد الاعلانات المسموح بتثبيتها , الرجاء تجديد باقة الاشتراك ']);
            }

            // save date
            $advertising = new FixedAdvertising();
            $advertising->advertiser_id = advertiser()->id;
            $advertising->advertising_id = $request->id;
            $advertising->subscriptions_id = $subscription->id;
            $advertising->status = 0;
            $advertising->save();
            if ($advertising)
                return redirect()->route('advertiser.profile')->with(['success' => '  تم ارسال الطلب بنجاح ']);

            return redirect()->route('advertiser.profile')->with(['error' => 'حدث خطا ما الرجاء المحاوله لاحقا']);

        } catch (\Exception $ex) {
            return redirect()->route('advertiser.profile')->with(['error' => 'حدث خطا ما الرجاء المحاوله لاحقا']);
        }
    }

    public function cardDetails($id)
    {


        $advertising = Advertising::with('advertisingComments', 'ratingAdvertising', 'advertiserCategory', 'Advertiser', 'cityAdvertising')
            ->where('id', $id)->first();

        $advertising->increment('counter', 1);

        if ($advertising->counter == 1) {

            $points = Point::where('code', 6)->first();
            if ($points->active == 1) {
                $point = new Advertiser_Points();
                $point->advertiser_id = $advertising->advertiser_id;
                $point->num_points = $points->num_points;
                $point->activity = $points->activity;
                $point->point_id = $points->id;
                $point->save();
            }

        }


        $same_advertising = Advertising::with('advertisingComments', 'ratingAdvertising', 'advertiserCategory', 'Advertiser', 'cityAdvertising')
            ->where('city_id', $advertising->city_id)
            ->where('id', '!=', $id)
            ->whereIn('status', [1, 2])
            ->take(6)
            ->get();


        $comments = $advertising->advertisingComments;

        $comments = $comments->filter(function ($value, $key) {
            return $value['parent_id'] == 0;
        });

        $rating = $advertising->ratingAdvertising;

        $count = $advertising->ratingAdvertising->count();

        if (!empty(advertiser()->id)) {
            $advertiserFollowing = advertiser()->advertiserFollowerAnother;
        }

        $follow = false;

        if (!empty($advertiserFollowing)) {
            foreach ($advertiserFollowing as $following) {
                if ($following->advertiser_id == $advertising->advertiser_id) {
                    $follow = true;
                }
            }
        }

        $total_rate = 0;

        if (!empty($rating)) {
            foreach ($rating as $rate) {
                $total_rate += $rate->rating;
            }
        }

        if ($total_rate != 0) {
            $total_rate = round($total_rate / $count);
        }

        $voter_rate = null;

        if (!empty($rating) and !empty(advertiser())) {
            foreach ($rating as $rate) {
                if ($rate->voter_id == advertiser()->id) {
                    $voter_rate = $rate->rating;
                }
            }
        }

        return view('front-end.advertising.card-details', compact('advertising', 'follow', 'total_rate', 'voter_rate', 'comments', 'same_advertising'));

    }

    public function storeRating(Request $request)
    {

        try {

            if(advertiser() ->email == null OR advertiser() ->is_active == 0){

                return redirect()->route('advertising.card-details')->with(['error' => 'لا يمكنك الاستفادة من خدمات الموقع قبل اكمال بيانات حسابك']);
            }



            $check = Black_List::where('advertiser_id', advertiser()->id)->first();
            if ($check != null) {
                return redirect()->route('advertising.card-details', $request->id)->with(['error' => 'لا يمكنك الاستفادة من خدامات الموقع بسبب وجودك بالقائمة السوداء']);

            }

            $advertiser = Advertiser::find(advertiser()->id);

            if (!$advertiser)
                return redirect()->route('advertising.card-details', $request->id)->with(['error' => 'هناك خطأ حاول فى وقت اخر ']);


            $advertising_data = Advertising::find($request->id);

            if (!$advertising_data)
                return redirect()->route('advertising.card-details', $request->id)->with(['error' => 'هناك خطأ حاول فى وقت اخر ']);


            $rating = $advertising_data->ratingAdvertising;


            if (!empty($rating)) {
                foreach ($rating as $rate) {
                    if ($rate->voter_id == advertiser()->id) {
                        $rate->update([
                            'rating' => $request->star,
                        ]);

                        return redirect()->route('advertising.card-details', $request->id)->with(['success' => 'تم اضافة التقييم بنجاح']);

                    }
                }
            }

            $row = Advertise_Rating::where('advertising_id', $request->id)->first();
            $adveriser_id = Advertising::where('id', $request->id)->first();
            if ($row == null) {
                $points = Point::where('code', 5)->first();
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
            $advertising = new Advertise_Rating();
            $advertising->voter_id = advertiser()->id;
            $advertising->advertising_id = $request->id;
            $advertising->advertiser_id = $advertising_data->advertiser_id;
            $advertising->rating = $request->star;
            $advertising->save();


            return redirect()->route('advertising.card-details', $request->id)->with(['success' => 'تم اضافة التقييم بنجاح']);

        } catch (\Exception $ex) {
            return redirect()->route('advertising.card-details', $request->id)->with(['error' => 'حدث خطا ما الرجاء المحاوله لاحقا']);
        }
    }

    public function storeComment(Request $request)
    {

        try {
            if(advertiser() ->email == null OR advertiser() ->is_active == 0){

                return redirect()->route('advertising.card-details')->with(['error' => 'لا يمكنك الاستفادة من خدمات الموقع قبل اكمال بيانات حسابك']);
            }

            $check = Black_List::where('advertiser_id', advertiser()->id)->first();
            if ($check != null) {
                return redirect()->route('advertising.card-details', $request->id)->with(['error' => 'لا يمكنك الاستفادة من خدامات الموقع بسبب وجودك بالقائمة السوداء']);

            }
            $advertiser = Advertiser::find(advertiser()->id);

            if (!$advertiser)
                return redirect()->route('advertising.card-details', $request->id)->with(['error' => 'هناك خطأ حاول فى وقت اخر ']);


            $advertising_data = Advertising::find($request->id);

            if (!$advertising_data)
                return redirect()->route('advertising.card-details', $request->id)->with(['error' => 'هناك خطأ حاول فى وقت اخر ']);


            // save date
            $advertising = new AdvertisingComment();
            $advertising->writer_id = advertiser()->id;
            $advertising->advertising_id = $request->id;
            $advertising->comment = $request->comment;
            $advertising->parent_id = $request->parent_id;
            $advertising->save();

            $user_data = Advertising::where('id', $request->id)->first();

            $user = \App\Models\Advertiser::find($user_data->advertiser_id);
            $dddd = $user->notify(new \App\Notifications\NewCommentNotification($advertising));


            return redirect()->route('advertising.card-details', $request->id)->with(['success' => 'تم اضافة التعليق بنجاح']);

        } catch (\Exception $ex) {
            return redirect()->route('advertising.card-details', $request->id)->with(['error' => 'حدث خطا ما الرجاء المحاوله لاحقا']);
        }
    }

    public function storeMassege(Request $request)
    {

        try {
            if(advertiser() ->email == null OR advertiser() ->is_active == 0){

                return redirect()->route('advertising.card-details')->with(['error' => 'لا يمكنك الاستفادة من خدمات الموقع قبل اكمال بيانات حسابك']);
            }

            $check = Black_List::where('advertiser_id', advertiser()->id)->first();
            if ($check != null) {
                return redirect()->route('advertising.card-details', $request->id)->with(['error' => 'لا يمكنك الاستفادة من خدامات الموقع بسبب وجودك بالقائمة السوداء']);

            }
            $advertiser = Advertiser::find(advertiser()->id);

            if (!$advertiser)
                return redirect()->route('advertising.card-details', $request->id)->with(['error' => 'هناك خطأ حاول فى وقت اخر ']);


            $advertising_data = Advertising::find($request->id);

            if (!$advertising_data)
                return redirect()->route('advertising.card-details', $request->id)->with(['error' => 'هناك خطأ حاول فى وقت اخر ']);


            // save date
            $advertising = new Chat();
            $advertising->sender_id = advertiser()->id;
            $advertising->advertiser_id = $request->advertiser_id;
            $advertising->message = $request->message;
            $advertising->save();
            $user = Advertiser::where('id', $request->advertiser_id)->first();
            $dddd = $user->notify(new \App\Notifications\NewMessagesNotification($advertising));

            $user_data = Advertising::where('id', $request->id)->first();

            return redirect()->route('advertising.card-details', $request->id)->with(['success' => 'تم ارسال الرسالة بنجاح']);

        } catch (\Exception $ex) {
            return redirect()->route('advertising.card-details', $request->id)->with(['error' => 'حدث خطا ما الرجاء المحاوله لاحقا']);
        }
    }

    //اضافة اعلان االى المفضلة
    public function addFavourite($id, $card_id)
    {

        try {

            if(advertiser() ->email == null OR advertiser() ->is_active == 0){

                return redirect()->route('advertising.card-details')->with(['error' => 'لا يمكنك الاستفادة من خدمات الموقع قبل اكمال بيانات حسابك']);
            }


            $check = Black_List::where('advertiser_id', advertiser()->id)->first();
            if ($check != null) {
                return redirect()->route('advertising.card-details', $card_id)->with(['error' => 'لا يمكنك الاستفادة من خدامات الموقع بسبب وجودك بالقائمة السوداء']);

            }
            $advertiser = Advertiser::find(advertiser()->id);

            if (!$advertiser)
                return redirect()->route('advertising.card-details', $card_id)->with(['error' => 'هناك خطأ حاول فى وقت اخر ']);


            $advertising_data = Advertising::find($id);

            if (!$advertising_data)
                return redirect()->route('advertising.card-details', $card_id)->with(['error' => 'هناك خطأ حاول فى وقت اخر ']);

            $advertiserFavorite = $advertiser->advertiserFavourite;


            if (!empty($advertiserFavorite)) {
                foreach ($advertiserFavorite as $favorite) {
                    if ($favorite->advertising_id == $id) {
                        return redirect()->route('advertising.card-details', $card_id)->with(['error' => ' لقد قمت بإضافة الاعلان الى المفضلة من قبل']);
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
            return redirect()->route('advertising.card-details', $card_id)->with(['success' => 'تمت الاضافة الى المفضلة بنجاح']);

        } catch (\Exception $ex) {
            return redirect()->route('advertising.card-details', $card_id)->with(['error' => 'حدث خطا ما الرجاء المحاوله لاحقا']);
        }

    }

    //حذف الاعلان من المفضلة

    public function removeFavourite($id, $card_id)
    {

        try {

            if(advertiser() ->email == null OR advertiser() ->is_active == 0){

                return redirect()->route('advertising.card-details')->with(['error' => 'لا يمكنك الاستفادة من خدمات الموقع قبل اكمال بيانات حسابك']);
            }


            $check = Black_List::where('advertiser_id', advertiser()->id)->first();
            if ($check != null) {
                return redirect()->route('advertising.card-details', $card_id)->with(['error' => 'لا يمكنك الاستفادة من خدامات الموقع بسبب وجودك بالقائمة السوداء']);

            }
            $advertiser = Advertiser::find(advertiser()->id);

            if (!$advertiser)
                return redirect()->route('advertising.card-details', $card_id)->with(['error' => 'هناك خطأ حاول فى وقت اخر ']);


            $advertising_data = Advertising::find($id);

            if (!$advertising_data)
                return redirect()->route('advertising.card-details', $card_id)->with(['error' => 'هناك خطأ حاول فى وقت اخر ']);

            $advertiserFavorite = $advertiser->advertiserFavourite;


            if (!empty($advertiserFavorite)) {
                foreach ($advertiserFavorite as $favorite) {
                    if ($favorite->advertising_id == $id) {
                        $favorite->delete();
                        return redirect()->route('advertising.card-details', $card_id)->with(['success' => ' لقد قمت بحذف الاعلان من المفضلة بنجاح ']);
                    }
                }
            }

            return redirect()->route('advertising.card-details', $card_id)->with(['error' => 'حدث خطا ما الرجاء المحاوله لاحقا']);

        } catch (\Exception $ex) {
            return redirect()->route('advertising.card-details', $card_id)->with(['error' => 'حدث خطا ما الرجاء المحاوله لاحقا']);
        }

    }


    public function edit($id)
    {

        $row = Advertising::where('id', $id)->first();

        $cities = City::all();

        $categories = Category::selection()
            ->get();

        $main_categories1 = $categories->filter(function ($value, $key) {
            return $value['parent_id'] == 0;
        });

        $main_categories = $main_categories1->pluck("name", "id");


        return view('front-end.advertising.edit', compact('row', 'cities', 'main_categories'));
    }

    public function price($id)
    {

        $row = Advertising::where('id', $id)->first();


        return view('front-end.advertising.price', compact('row'));
    }


    public function update(Request $request)
    {

        try {

            if(advertiser() ->email == null OR advertiser() ->is_active == 0){

                return redirect()->route('advertising.edit')->with(['error' => 'لا يمكنك الاستفادة من خدمات الموقع قبل اكمال بيانات حسابك']);
            }


            $check = Black_List::where('advertiser_id', advertiser()->id)->first();
            if ($check != null) {
                return redirect()->route('advertising.edit', $request->id)->with(['error' => 'لا يمكنك الاستفادة من خدامات الموقع بسبب وجودك بالقائمة السوداء']);

            }
            $advertising = Advertising::find($request->id);

            if (!$advertising) {
                return redirect()->route('advertising.edit', $request->id)->with(['error' => 'هذا الاعلان غير موجود']);
            }

            Advertising::where('id', $request->id)
                ->update([
                    'title' => $request->title,
                    'description' => $request->description,
                    'city_id' => $request->city_id,
                    'price' => $request->price,
                    'insurance_price' => $request->insurance_price,
                    'phone' => $request->phone,
                    'vedio_url' => $request->vedio_url,
                ]);


            if ($request->has('files')) {
                $images = array();
                if ($files = $request->file('files')) {
                    foreach ($files as $file) {
                        $filePath = uploadImage('advertising-images', $file);
                        $images[] = $filePath;
                    }
                }

                /*Insert your data*/

                $advertising->update([
                    'photos' => json_encode($images),
                ]);

            }

            if ($request->has('is_specialconditions')) {
                $advertising->update([
                    'is_specialconditions' => '1',
                    'special_conditions' => $request->special_conditions,
                ]);
            }


            if ($request->has('comments')) {
                $advertising->update([
                    'comments' => '1',
                ]);
            }

            if ($request->has('is_phone')) {
                $advertising->update([
                    'is_phone' => '1',
                ]);
            }


            return redirect()->route('advertising.edit', $request->id)->with(['success' => 'تم تحديث الاعلان بنجاح']);

        } catch (\Exception $ex) {
            return redirect()->route('advertising.edit', $request->id)->with(['error' => 'هناك خطا ما يرجي المحاوله فيما بعد']);
        }
    }


    public function updatePrice(PriceRequest $request)
    {

        try {

            $row = Money_Transfer::where('advertising_id', $request->id)->first();

            $profilefile = null;
            if ($files = $request->file('files')) {
                $destinationPath = 'front-end/images/advertising-images/'; // upload path
                $profilefile = date('YmdHis') . "." . $files->getClientOriginalExtension();
                $files->move($destinationPath, $profilefile);
                $insert['files'] = $profilefile;
            }


            if (empty($row)) {
                $new = new  Money_Transfer();
                $new->bank_name = $request->bank_name;
                $new->name = $request->name;
                $new->email = $request->email;
                $new->phone = $request->phone;
                $new->advertising_id = $request->id;
                $new->status = 0;
                $new->money = $request->money;
                $new->files = $profilefile;
                $new->save();

                $points = Point::where('code', 8)->first();
                if ($points->active == 1) {
                    $point = new Advertiser_Points();
                    $point->advertiser_id = advertiser()->id;
                    $point->num_points = $points->num_points;
                    $point->activity = $points->activity;
                    $point->point_id = $points->id;
                    $point->save();
                }

                return redirect()->route('advertising.price', $request->id)->with(['success' => 'تمت الاضافة بنجاح']);

            } else {
                Money_Transfer::where('advertising_id', $request->id)
                    ->update([
                        'bank_name' => $request->bank_name,
                        'advertising_id' => $request->id,
                        'status' => 0,
                        'money' => $request->money,
                        'files' => $profilefile,
                    ]);

                return redirect()->route('advertising.price', $request->id)->with(['success' => 'تمت الاضافة بنجاح']);

            }

        } catch (\Exception $ex) {
            return redirect()->route('advertising.price', $request->id)->with(['error' => 'هناك خطا ما يرجي المحاوله فيما بعد']);
        }
    }

}
