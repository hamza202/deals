<?php

namespace App\Http\Controllers\FrontEnd;

use App\Http\Controllers\Controller;
use App\Http\Requests\AccountRequest;
use App\Http\Requests\UpdatePasswordRequest;
use App\Models\Advertise_Follower;
use App\Models\Advertiser;
use App\Models\Advertiser_Code;
use App\Models\Advertiser_Favourite;
use App\Models\Advertiser_Points;
use App\Models\Advertising;
use App\Models\Black_List;
use App\Models\Chat;
use App\Models\City;
use App\Models\Point;
use App\Models\Notification;
use App\Models\UUID;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AdvertiserController extends Controller
{
    /**
     * @param $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function fastActive($id)
    {
        $id = advertiser()->id;
        Auth::guard('advertiser')->logout();
        return view('front-end.app.form-send-activation', compact('id'));
    }


    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function advertiserPoints()
    {
        $rows = Advertiser_Points::where('advertiser_id', advertiser()->id)->get();
        return view('front-end.auth.detection-points', compact('rows'));
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function advertiserProfile()
    {
        $followers = Advertise_Follower::with('follower')
            ->where('advertiser_id', advertiser()->id)->get();


        $advertising = Advertising::where('advertiser_id', advertiser()->id)
            ->get();


        $advertising_favourite = Advertiser_Favourite::with('advertising')
            ->where('advertiser_id', advertiser()->id)
            ->get();

        if (Advertising::where('advertiser_id', advertiser()->id)
                ->first() == null) {
            $advertising = null;
        }

        if (Advertiser_Favourite::where('advertiser_id', advertiser()->id)
                ->first() == null) {
            $advertising_favourite = null;
        }

        // chat
        $senders2 = Chat::with('sender')
            ->where('advertiser_id', advertiser()->id)
            ->orWhere('sender_id', advertiser()->id)
            ->get();

        $senders = $senders2->unique('sender_id');

        $data_new = array();
        foreach ($senders2 as $senders1) {
            if ($senders1->sender->id == advertiser()->id) {
                $new = $senders1->advertiser_id;
                array_push($data_new, $new);
            } else {
                array_push($data_new, $senders1->sender->id);
            }
        }

        $senders = array_unique($data_new);

        return view('front-end.auth.profile', compact('followers', 'advertising', 'advertising_favourite', 'senders'));
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function updateAccount()
    {
        $rows = City::all();
        return view('front-end.auth.update-account', compact('rows'));
    }

    /**
     * @param AccountRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(AccountRequest $request)
    {

        try {
            $check = Black_List::where('advertiser_id', advertiser()->id)->first();
            if ($check != null) {
                return redirect()->route('advertiser.update-account')->with(['error' => 'لا يمكنك الاستفادة من خدامات الموقع بسبب وجودك بالقائمة السوداء']);

            }

            $advertiser = Advertiser::find(advertiser()->id);

            if (!$advertiser)
                return redirect()->route('advertiser.update-account')->with(['error' => 'هناك خطأ حاول فى وقت اخر ']);

            // update date

            Advertiser::where('id', advertiser()->id)
                ->update([
                    'name' => $request->name,
                    'username' => $request->username,
                    'phone' => $request->phone,
                    'email' => $request->email,
                    'address' => $request->address,
                    'twitter' => $request->twitter,
                    'city_id' => $request->city_id,
                ]);

            // save image

            if ($request->has('image_url')) {
                $filePath = uploadImage('advertiser-images', $request->image_url);
                Advertiser::where('id', advertiser()->id)
                    ->update([
                        'photo' => $filePath,
                    ]);
            }

            return redirect()->route('advertiser.update-account')->with(['success' => 'تم ألتحديث بنجاح']);

        } catch (\Exception $ex) {
            return redirect()->route('advertiser.update-account')->with(['error' => 'حدث خطا ما الرجاء المحاوله لاحقا']);
        }
    }

    /**
     * @param UpdatePasswordRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function updatePassword(UpdatePasswordRequest $request)
    {
        try {
            $check = Black_List::where('advertiser_id', advertiser()->id)->first();
            if ($check != null) {
                return redirect()->route('advertiser.update-account')->with(['error' => 'لا يمكنك الاستفادة من خدامات الموقع بسبب وجودك بالقائمة السوداء']);

            }
            $data = $request->all();

            if (!\Hash::check($data['old_password'], advertiser()->password)) {

                return redirect()->route('advertiser.update-account')->with(['error' => 'كلمة المرور الحالية غير متطابقة ']);

            } else {

                Advertiser::where('id', advertiser()->id)
                    ->update([
                        'password' => bcrypt($request->password)
                    ]);

                return redirect()->route('advertiser.update-account')->with(['success' => 'تم ألتحديث بنجاح']);

            }
        } catch (\Exception $ex) {
            return redirect()->route('advertiser.update-account')->with(['error' => 'حدث خطا ما الرجاء المحاوله لاحقا']);
        }

    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function updateMesseges(Request $request)
    {
        try {
            $check = Black_List::where('advertiser_id', advertiser()->id)->first();
            if ($check != null) {
                return redirect()->route('advertiser.update-account')->with(['error' => 'لا يمكنك الاستفادة من خدامات الموقع بسبب وجودك بالقائمة السوداء']);

            }

            $messages = advertiser()->messages;
            if ($messages == 0) {
                $messages_new = 1;
            } else {
                $messages_new = 0;
            }

            Advertiser::where('id', advertiser()->id)
                ->update([
                    'messages' => $messages_new
                ]);

            return redirect()->route('advertiser.update-account')->with(['success' => 'تم ألتحديث بنجاح']);

        } catch (\Exception $ex) {
            return redirect()->route('advertiser.update-account')->with(['error' => 'حدث خطا ما الرجاء المحاوله لاحقا']);
        }

    }

    /**
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function addFollowing($id)
    {

        try {

            if(advertiser() ->email == null OR advertiser() ->is_active == 0){

                return redirect()->route('advertiser.update-account')->with(['error' => 'لا يمكنك الاستفادة من خدمات الموقع قبل اكمال بيانات حسابك']);
            }

            $check = Black_List::where('advertiser_id', advertiser()->id)->first();
            if ($check != null) {
                return redirect()->route('advertiser.update-account')->with(['error' => 'لا يمكنك الاستفادة من خدامات الموقع بسبب وجودك بالقائمة السوداء']);

            }

            $advertiser = Advertiser::find(advertiser()->id);

            if (!$advertiser)
                return redirect()->route('advertising.card-details', $id)->with(['error' => 'هناك خطأ حاول فى وقت اخر ']);


            $advertising_data = Advertising::find($id);

            if (!$advertising_data)
                return redirect()->route('advertising.card-details', $id)->with(['error' => 'هناك خطأ حاول فى وقت اخر ']);

            $advertiserFollowing = $advertiser->advertiserFollowerAnother;


            if (!empty($advertiserFollowing)) {
                foreach ($advertiserFollowing as $following) {
                    if ($following->advertiser_id == $advertising_data->advertiser_id) {
                        return redirect()->route('advertising.card-details', $id)->with(['error' => ' لقد قمت بمتابعة المعلن من قبل']);
                    }
                }
            }
            $row = Advertise_Follower::where('advertiser_id', $advertising_data->advertiser_id)->first();

            if ($row == null) {

                $points = Point::where('code', 4)->first();
                if ($points->active == 1) {
                    $point = new Advertiser_Points();
                    $point->advertiser_id = $advertising_data->advertiser_id;
                    $point->num_points = $points->num_points;
                    $point->activity = $points->activity;
                    $point->point_id = $points->id;
                    $point->save();
                }
            }

            // save date
            $advertiser = new Advertise_Follower();
            $advertiser->follower_id = advertiser()->id;
            $advertiser->advertiser_id = $advertising_data->advertiser_id;
            $advertiser->save();

            $user = Advertiser::where('id', $advertising_data->advertiser_id)->first();

            $dddd = $user->notify(new \App\Notifications\NewFollowingNotification($advertiser));

            return redirect()->route('advertising.card-details', $id)->with(['success' => 'تمت المتابعة بنجاح']);

        } catch (\Exception $ex) {
            return redirect()->route('advertising.card-details', $id)->with(['error' => 'حدث خطا ما الرجاء المحاوله لاحقا']);
        }

    }

    /**
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function removeFollowing($id)
    {

        try {

            if(advertiser() ->email == null OR advertiser() ->is_active == 0){

                return redirect()->route('advertiser.update-account')->with(['error' => 'لا يمكنك الاستفادة من خدمات الموقع قبل اكمال بيانات حسابك']);
            }

            $check = Black_List::where('advertiser_id', advertiser()->id)->first();
            if ($check != null) {
                return redirect()->route('advertiser.update-account')->with(['error' => 'لا يمكنك الاستفادة من خدامات الموقع بسبب وجودك بالقائمة السوداء']);

            }

            $advertiser = Advertiser::find(advertiser()->id);

            if (!$advertiser)
                return redirect()->route('advertising.card-details', $id)->with(['error' => 'هناك خطأ حاول فى وقت اخر ']);


            $advertising_data = Advertising::find($id);

            if (!$advertising_data)
                return redirect()->route('advertising.card-details', $id)->with(['error' => 'هناك خطأ حاول فى وقت اخر ']);

            $advertiserFollowing = $advertiser->advertiserFollowerAnother;


            if (!empty($advertiserFollowing)) {
                foreach ($advertiserFollowing as $following) {
                    if ($following->advertiser_id == $advertising_data->advertiser_id) {
                        $following->delete();
                        return redirect()->route('advertising.card-details', $id)->with(['success' => ' تم إلغاء المتابعة بنجاح  ']);
                    }
                }
            }
            return redirect()->route('advertising.card-details', $id)->with(['error' => 'حدث خطا ما الرجاء المحاوله لاحقا']);

        } catch (\Exception $ex) {
            return redirect()->route('advertising.card-details', $id)->with(['error' => 'حدث خطا ما الرجاء المحاوله لاحقا']);
        }

    }

    /**
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function addFollow($id)
    {

        try {

            if(advertiser() ->email == null OR advertiser() ->is_active == 0){

                return redirect()->route('advertiser.update-account')->with(['error' => 'لا يمكنك الاستفادة من خدمات الموقع قبل اكمال بيانات حسابك']);
            }


            $check = Black_List::where('advertiser_id', advertiser()->id)->first();
            if ($check != null) {
                return redirect()->route('advertiser.update-account')->with(['error' => 'لا يمكنك الاستفادة من خدامات الموقع بسبب وجودك بالقائمة السوداء']);

            }
            $advertiser = Advertiser::find(advertiser()->id);

            if (!$advertiser)
                return redirect()->route('advertiser.profile')->with(['error' => 'هناك خطأ حاول فى وقت اخر ']);


            $follower = Advertiser::find($id);

            if (!$follower)
                return redirect()->route('advertiser.profile')->with(['error' => 'هناك خطأ حاول فى وقت اخر ']);

            $advertiserFollowing = $advertiser->advertiserFollowerAnother;

            if (!empty($advertiserFollowing)) {
                foreach ($advertiserFollowing as $following) {
                    if ($following->advertiser_id == $id) {
                        return redirect()->route('advertiser.profile')->with(['error' => ' لقد قمت بمتابعة المعلن من قبل']);
                    }
                }
            }
            $row = Advertise_Follower::where('advertiser_id', $id)->first();

            if ($row == null) {
                $points = Point::where('code', 4)->first();
                if ($points->active == 1) {
                    $point = new Advertiser_Points();
                    $point->advertiser_id = $id;
                    $point->num_points = $points->num_points;
                    $point->activity = $points->activity;
                    $point->point_id = $points->id;
                    $point->save();
                }
            }

            // save date
            $advertiser = new Advertise_Follower();
            $advertiser->follower_id = advertiser()->id;
            $advertiser->advertiser_id = $id;
            $advertiser->save();

            $user = Advertiser::where('id', $id)->first();

            $dddd = $user->notify(new \App\Notifications\NewFollowingNotification($advertiser));

            return redirect()->route('advertiser.profile')->with(['success' => 'تمت المتابعة بنجاح']);

        } catch (\Exception $ex) {
            return redirect()->route('advertiser.profile')->with(['error' => 'حدث خطا ما الرجاء المحاوله لاحقا']);
        }

    }

    /**
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function removeFollow($id)
    {

        try {

            if(advertiser() ->email == null OR advertiser() ->is_active == 0){

                return redirect()->route('advertiser.update-account')->with(['error' => 'لا يمكنك الاستفادة من خدمات الموقع قبل اكمال بيانات حسابك']);
            }

            $check = Black_List::where('advertiser_id', advertiser()->id)->first();
            if ($check != null) {
                return redirect()->route('advertiser.update-account')->with(['error' => 'لا يمكنك الاستفادة من خدامات الموقع بسبب وجودك بالقائمة السوداء']);

            }

            $advertiser = Advertiser::find(advertiser()->id);

            if (!$advertiser)
                return redirect()->route('advertiser.profile')->with(['error' => 'هناك خطأ حاول فى وقت اخر ']);


            $advertising_data = Advertiser::find($id);

            if (!$advertising_data)
                return redirect()->route('advertiser.profile')->with(['error' => 'هناك خطأ حاول فى وقت اخر ']);

            $advertiserFollowing = $advertiser->advertiserFollowerAnother;


            if (!empty($advertiserFollowing)) {
                foreach ($advertiserFollowing as $following) {
                    if ($following->advertiser_id == $id) {
                        $following->delete();
                        return redirect()->route('advertiser.profile')->with(['success' => ' تم إلغاء المتابعة بنجاح  ']);
                    }
                }
            }
            return redirect()->route('advertiser.profile')->with(['error' => 'حدث خطا ما الرجاء المحاوله لاحقا']);

        } catch (\Exception $ex) {
            return redirect()->route('advertiser.profile')->with(['error' => 'حدث خطا ما الرجاء المحاوله لاحقا']);
        }

    }

    /**
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function addFavourite($id)
    {

        try {

            if(advertiser() ->email == null OR advertiser() ->is_active == 0){

                return redirect()->route('advertiser.update-account')->with(['error' => 'لا يمكنك الاستفادة من خدمات الموقع قبل اكمال بيانات حسابك']);
            }


            $check = Black_List::where('advertiser_id', advertiser()->id)->first();
            if ($check != null) {
                return redirect()->route('advertiser.update-account')->with(['error' => 'لا يمكنك الاستفادة من خدامات الموقع بسبب وجودك بالقائمة السوداء']);

            }
            $advertiser = Advertiser::find(advertiser()->id);

            if (!$advertiser)
                return redirect()->route('advertising.card-details', $id)->with(['error' => 'هناك خطأ حاول فى وقت اخر ']);


            $advertising_data = Advertising::find($id);

            if (!$advertising_data)
                return redirect()->route('advertising.card-details', $id)->with(['error' => 'هناك خطأ حاول فى وقت اخر ']);

            $advertiserFavorite = $advertiser->advertiserFavourite;


            if (!empty($advertiserFavorite)) {
                foreach ($advertiserFavorite as $favorite) {
                    if ($favorite->advertising_id == $id) {
                        return redirect()->route('advertising.card-details', $id)->with(['error' => ' لقد قمت بإضافة الاعلان الى المفضلة من قبل']);
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
            return redirect()->route('advertising.card-details', $id)->with(['success' => 'تمت الاضافة الى المفضلة بنجاح']);

        } catch (\Exception $ex) {
            return redirect()->route('advertising.card-details', $id)->with(['error' => 'حدث خطا ما الرجاء المحاوله لاحقا']);
        }

    }

    /**
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function removeFavourite($id)
    {

        try {

            if(advertiser() ->email == null OR advertiser() ->is_active == 0){

                return redirect()->route('advertiser.update-account')->with(['error' => 'لا يمكنك الاستفادة من خدمات الموقع قبل اكمال بيانات حسابك']);
            }


            $check = Black_List::where('advertiser_id', advertiser()->id)->first();
            if ($check != null) {
                return redirect()->route('advertiser.update-account')->with(['error' => 'لا يمكنك الاستفادة من خدامات الموقع بسبب وجودك بالقائمة السوداء']);

            }
            $advertiser = Advertiser::find(advertiser()->id);

            if (!$advertiser)
                return redirect()->route('advertising.card-details', $id)->with(['error' => 'هناك خطأ حاول فى وقت اخر ']);


            $advertising_data = Advertising::find($id);

            if (!$advertising_data)
                return redirect()->route('advertising.card-details', $id)->with(['error' => 'هناك خطأ حاول فى وقت اخر ']);

            $advertiserFavorite = $advertiser->advertiserFavourite;


            if (!empty($advertiserFavorite)) {
                foreach ($advertiserFavorite as $favorite) {
                    if ($favorite->advertising_id == $id) {
                        $favorite->delete();
                        return redirect()->route('advertising.card-details', $id)->with(['success' => ' لقد قمت بحذف الاعلان من المفضلة بنجاح ']);
                    }
                }
            }

            return redirect()->route('advertising.card-details', $id)->with(['error' => 'حدث خطا ما الرجاء المحاوله لاحقا']);

        } catch (\Exception $ex) {
            return redirect()->route('advertising.card-details', $id)->with(['error' => 'حدث خطا ما الرجاء المحاوله لاحقا']);
        }
    }

    /**
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function addFavouriteProfile($id)
    {

        try {

            if(advertiser() ->email == null OR advertiser() ->is_active == 0){

                return redirect()->route('advertiser.update-account')->with(['error' => 'لا يمكنك الاستفادة من خدمات الموقع قبل اكمال بيانات حسابك']);
            }

            $check = Black_List::where('advertiser_id', advertiser()->id)->first();
            if ($check != null) {
                return redirect()->route('advertiser.update-account')->with(['error' => 'لا يمكنك الاستفادة من خدامات الموقع بسبب وجودك بالقائمة السوداء']);

            }
            $advertiser = Advertiser::find(advertiser()->id);

            if (!$advertiser)
                return redirect()->route('advertiser.profile')->with(['error' => 'هناك خطأ حاول فى وقت اخر ']);


            $advertising_data = Advertising::find($id);

            if (!$advertising_data)
                return redirect()->route('advertiser.profile')->with(['error' => 'هناك خطأ حاول فى وقت اخر ']);

            $advertiserFavorite = $advertiser->advertiserFavourite;


            if (!empty($advertiserFavorite)) {
                foreach ($advertiserFavorite as $favorite) {
                    if ($favorite->advertising_id == $id) {
                        return redirect()->route('advertiser.profile')->with(['error' => ' لقد قمت بإضافة الاعلان الى المفضلة من قبل']);
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
            return redirect()->route('advertiser.profile')->with(['success' => 'تمت الاضافة الى المفضلة بنجاح']);

        } catch (\Exception $ex) {
            return redirect()->route('advertiser.profile')->with(['error' => 'حدث خطا ما الرجاء المحاوله لاحقا']);
        }
    }

    /**
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function removeFavouriteProfile($id)
    {

        try {

            if(advertiser() ->email == null OR advertiser() ->is_active == 0){

                return redirect()->route('advertiser.update-account')->with(['error' => 'لا يمكنك الاستفادة من خدمات الموقع قبل اكمال بيانات حسابك']);
            }

            $check = Black_List::where('advertiser_id', advertiser()->id)->first();
            if ($check != null) {
                return redirect()->route('advertiser.update-account')->with(['error' => 'لا يمكنك الاستفادة من خدامات الموقع بسبب وجودك بالقائمة السوداء']);

            }

            $advertiser = Advertiser::find(advertiser()->id);

            if (!$advertiser)
                return redirect()->route('advertiser.profile')->with(['error' => 'هناك خطأ حاول فى وقت اخر ']);


            $advertising_data = Advertising::find($id);

            if (!$advertising_data)
                return redirect()->route('advertiser.profile')->with(['error' => 'هناك خطأ حاول فى وقت اخر ']);

            $advertiserFavorite = $advertiser->advertiserFavourite;


            if (!empty($advertiserFavorite)) {
                foreach ($advertiserFavorite as $favorite) {
                    if ($favorite->advertising_id == $id) {
                        $favorite->delete();
                        return redirect()->route('advertiser.profile')->with(['success' => ' لقد قمت بحذف الاعلان من المفضلة بنجاح ']);
                    }
                }
            }

            return redirect()->route('advertiser.profile')->with(['error' => 'حدث خطا ما الرجاء المحاوله لاحقا']);

        } catch (\Exception $ex) {
            return redirect()->route('advertiser.profile')->with(['error' => 'حدث خطا ما الرجاء المحاوله لاحقا']);
        }

    }

    /**
     * @param $id
     * @return false|\Illuminate\Http\RedirectResponse|string
     */
    public function destroy($id)
    {

        try {

            if(advertiser() ->email == null OR advertiser() ->is_active == 0){

                return redirect()->route('advertiser.update-account')->with(['error' => 'لا يمكنك الاستفادة من خدمات الموقع قبل اكمال بيانات حسابك']);
            }


            $check = Black_List::where('advertiser_id', advertiser()->id)->first();
            if ($check != null) {
                return redirect()->route('advertiser.update-account')->with(['error' => 'لا يمكنك الاستفادة من خدامات الموقع بسبب وجودك بالقائمة السوداء']);

            }

            $delete = Advertising::where('id', $id)->delete();
            if ($delete) {
                $message = 'success';
            } else {
                $message = 'fail';
            }
            return json_encode($message);

        } catch (\Exception $ex) {
            return redirect()->route('advertiser.profile')->with(['error' => 'هناك خطا ما يرجي المحاوله فيما بعد']);
        }
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function save_fcm_token(Request $request)
    {

        $errors = NULL;
        $message = "Success";
        $validator = Validator::make($request->all(), [
            'fcm_token' => 'required',
        ],
            [
                'title.fcm_token' => 'fcm token required',
            ]
        );
        if ($validator->fails()) {
            $status = false;
            $errors = $validator->errors();
            $message = " Error !! ";
        }
        $user = auth()->user()->update([
            'fcm_token' => $request->fcm_token
        ]);
        $status = $user ? true : false;
        return response()->json(
            [
                'message' => $message,
                'status' => $status,
                'errors' => $errors,
                'fcm_token' => $request->fcm_token
            ]
        );
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function addUUID(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'uuid' => 'required',
        ]);
        if ($validator->fails()) {
            $status = false;
            $errors = $validator->errors();
            $message = " Error !! ";
            return response()->json([
                'message' => $message,
                'status' => $status,
                'errors' => $errors,
            ]);
        }

        $user = auth('advertiser')->user();
        $uuid = $request->input('uuid');

        $uuid = \App\Models\UUID::create([
            'uuid' => $uuid,
            'uuidable_id' => $user->id,
            'uuidable_type' => \App\Models\Advertiser::class
        ]);
        $user->uuids()->attach($uuid->id);

        return response()->json([
            'status' => true,
            'message' => 'UUID add successfully',
        ]);
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */

    public function advertiserProfile1($id)
    {

        $advertising = Advertising::with('advertisingComments', 'ratingAdvertising', 'advertiserCategory', 'Advertiser', 'cityAdvertising')
            ->where('advertiser_id', $id)
            ->take(6)
            ->get();

        $row = Advertiser::where('id', $id)
            ->first();


        if (Advertising::where('advertiser_id', $id)
                ->first() == null) {
            $advertising = null;
        }


        return view('front-end.app.profile1', compact('row', 'advertising'));
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function notificationAll()
    {
        return view('front-end.app.notification');
    }

    /**
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     * @throws \Throwable
     */
    public function test($id)
    {
        $messeges = \App\Models\Chat::where([
            'advertiser_id' => advertiser()->id,
            'sender_id' => $id
        ])->
        orWhere([
            'advertiser_id' => $id,
            'sender_id' => advertiser()->id
        ])
            ->orderby('created_at', 'ASC')
            ->get();


        $html = view('front-end.layouts.includes.chat', compact('id'))->render();

        return response()->json(compact('html'));

    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function messagesStore(Request $request)
    {
        if ($request->ajax()) {
            $rules = array(
                'message' => 'required',
            );
            $error = Validator::make($request->all(), $rules);
            if ($error->fails()) {
                return response()->json([
                    'error' => $error->errors()->all()
                ]);
            }

            $message = $request->message;
            $sender_id = advertiser()->id;
            if ($sender_id == $request->sender_id)
                $advertiser_id = $request->advertiser_id;
            else
                $advertiser_id = $request->sender_id;


            $data = Chat::create(
                [
                    'message' => $message,
                    'sender_id' => $sender_id,
                    'advertiser_id' => $advertiser_id,
                ]);
            $user = Advertiser::where('id', $advertiser_id)->first();
            $dddd = $user->notify(new \App\Notifications\NewMessagesNotification($data));
            return response()->json([
                'success' => 'تم ارساال الرسالة',
                'data' => $data
            ]);
        }
    }

    /**
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function notificationDelete($id)
    {
        $notify = Notification::where('id', $id)->delete();
        return redirect()->back();
    }
}
