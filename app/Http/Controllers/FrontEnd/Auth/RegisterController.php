<?php

namespace App\Http\Controllers\FrontEnd\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Advertiser1Request;
use App\Http\Requests\AdvertiserRequest;
use App\Models\Advertiser;
use App\Models\Advertiser_Code;
use App\Models\Advertiser_Points;
use App\Models\City;
use App\Models\Point;
use App\Notifications\ActiveAccount;
use App\Notifications\PasswordSend;
use Carbon\Carbon;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Notification;
use Twilio\Rest\Client;


class RegisterController extends Controller
{

    protected $guard = 'advertiser';


    public function __construct()
    {
        $this->middleware('guest:advertiser')->except('logout');
    }

    /**
     * @return bool
     *
     */
    public function deleteCode($id)
    {

        $data = Advertiser_Code::where('advertiser_id', $id)->first();
        if ($data) {
            $data->delete();
        }
        return true;
    }

    public function index()
    {
        $cities = City::all();
        return view('front-end.auth.form-sign-up', compact('cities'));
    }

    public function fast()
    {
        return view('front-end.auth.fast-sign-up');
    }

    public function formActivation($id)
    {
        return view('front-end.app.form-activation', compact('id'));
    }

    public function sendActiveCode($id)
    {
        return view('front-end.app.form-send-activation', compact('id'));
    }

    public function sendPassword()
    {
        return view('front-end.app.form-send-password');
    }

    public function sendPasswordValue(Request $request)
    {
        try {

            $activeAccount = $request->activeAccount;
            $value = $request->name;
            if ($activeAccount == 1) {
                $row = Advertiser::where('email', $value)
                    ->orWhere('phone', $value)->first();

                $active = generateRandomString(8);
                Advertiser::where('email', $row->email)
                    ->orWhere('phone', $value)
                    ->update([
                        'password' => bcrypt($active),
                    ]);
                Notification::route('mail', $row->email)->notify(new PasswordSend($row->name, $row->email, $active));
                return redirect()->route('advertiser.login')->with(['success' => 'تم ارسال كلمة المرور بنجاح']);

            } elseif ($activeAccount == 2) {
                $row = Advertiser::where('email', $value)
                    ->orWhere('phone', $value)->first();
                $active = generateRandomString(8);
                Advertiser::where('email', $row->email)
                    ->orWhere('phone', $value)
                    ->update([
                        'password' => bcrypt($active),
                    ]);
                // Notification::route('mail', $value)->notify(new PasswordSend($row->name, $row->email, $active));

                $response = Http::get("http://www.oursms.net/api/sendsms.php?username=Deal&password=123456&message=Your Password for Deal is :" . $active . "&numbers=" . $row->phone . "&sender=Deal&unicode=E&return=full");

                return redirect()->route('advertiser.login')->with(['success' => 'تم ارسال كلمة المرور بنجاح']);

            } elseif ($activeAccount === "3") {
                $row = Advertiser::where('email', $value)
                    ->orWhere('phone', $value)->first();
                $active = generateRandomString(8);
               $new = Advertiser::where('email', $row->email)
                    ->update([
                        'password' => bcrypt($active),
                    ]);
                if ($new){
                    $this->sendWhatsAppSMS($row->phone, "Your password is :", $active);

                    return redirect()->route('advertiser.login')->with(['success' => 'تم ارسال كلمة المرور بنجاح']);
                }

                //Notification::route('mail', $value)->notify(new PasswordSend($row->name, $row->email, $active));

            }
            return redirect()->route('advertiser.login')->with(['error' => 'حثت مشكلة حاول مجددا ']);

        } catch (\Exception $exception) {
            return redirect()->route('advertiser.login')->with(['error' => 'حثت مشكلة حاول مجددا ']);


        }
    }

    public function storeActiveCode(Request $request)
    {
        try {
            $active_code = generateRandomString();
            $advertiser = Advertiser::where('id', $request->id)->first();
            if (Advertiser_Code::where('advertiser_id', $advertiser->id)->count() > 0) {
                Advertiser_Code::where('advertiser_id', $advertiser->id)
                    ->update([
                        'code' => $active_code,
                    ]);
            } else {
                $code = new Advertiser_Code();
                $code->advertiser_id = $advertiser->id;
                $code->code = $active_code;
                $code->advertiser_number = $advertiser->phone;
                $code->status = 0; //0 :available , 1 : not available
                $code->save();
            }

            $data = Advertiser_Code::where('advertiser_id', $advertiser->id)->first();
            $activeAccount = $request->activeAccount;
            if ($activeAccount == 1) {
                Notification::send($advertiser, new ActiveAccount($data->code, $advertiser));
            } elseif ($activeAccount == 2) {

                $response = Http::get("http://www.oursms.net/api/sendsms.php?username=Deal&password=123456&message=Your Active code for Deal is :" . $data->code . "&numbers=" . $advertiser->phone . "&sender=Deal&unicode=E&return=full");

            } else {


                $this->sendWhatsAppSMS($advertiser->phone, "Your Active code is :", $data->code);
            }
            return redirect()->route('advertiser.activation', ['id' => $request->id])->with(['success' => 'تم التسجيل بنجاح']);

        } catch (\Exception $exception) {
            $id = $request->id;
            return redirect()->route('advertiser.sendActiveCode', ['id' => $id]);

        }
    }

    public function updateActiveAccount(Request $request)
    {

        try {
            $advertiser = Advertiser::where('id', $request->id)->first();
            if (Advertiser_Code::where('advertiser_id', $advertiser->id) != null) {
                $newTest = Advertiser_Code::where('advertiser_id', $advertiser->id)->first();

                if ($newTest->created_at < Carbon::now()->subMinutes(10)->toDateTimeString()) {
                    $newTest->delete();
                    return redirect()->route('advertiser.activation', ['id' => $request->id])->with(['error' => 'الرمز المدخل منتهي الصلاحية']);
                }

                $row = Advertiser_Code::where('advertiser_id', $advertiser->id)->first();
                if ($row->code == $request->code) {
                    $advertiser->update([
                        'is_active' => 1,
                    ]);
                    $points = Point::where('code', 9)->first();
                    if ($points->active == 1) {
                        $point = new Advertiser_Points();
                        $point->advertiser_id = $request->id;
                        $point->num_points = $points->num_points;
                        $point->activity = $points->activity;
                        $point->point_id = $points->id;
                        $point->save();
                    }

                    auth()->guard('advertiser')->login($advertiser);
                    return redirect()->route('index');
                } else {
                    return redirect()->route('advertiser.activation', ['id' => $request->id])->with(['error' => 'الرمز المدخل خطأ']);
                }
            } else {
                return redirect()->route('advertiser.activation', ['id' => $request->id])->with(['error' => 'الرمز المدخل خطأ']);
            }

        } catch (\Exception $exception) {
            $id = $request->id;
            return redirect()->route('advertiser.sendActiveCode', ['id' => $id]);
        }
    }

    public function loginForm()
    {
        return view('front-end.auth.form-sign-in');
    }

    public function register(AdvertiserRequest $request)
    {

        try {

            DB::beginTransaction();

            $advertiser = new Advertiser();
            $advertiser->name = $request->name;
            $advertiser->username = $request->username;
            $advertiser->email = $request->email;
            $advertiser->password = bcrypt($request->password);
            $advertiser->phone = $request->country_code . $request->phone;
            $advertiser->city_id = $request->city_id;
            $advertiser->know_us = $request->know_us;
            $advertiser->active_account = $request->activeAccount;
            $advertiser->membership_id = '1';
            $advertiser->save();

            if ($request->has('messeges')) {
                Advertiser::where('id', $advertiser->id)
                    ->update([
                        'messages' => 1,
                    ]);
            }

            if (!$advertiser) {
                return redirect()->route('advertiser.register')->with(['error' => 'هناك خطأ يرجي المحاوله فيما بعد']);
            } else {

                //save code to database
                $active_code = generateRandomString();
                $code = new Advertiser_Code();
                $code->advertiser_id = $advertiser->id;
                $code->code = $active_code;
                $code->advertiser_number = $advertiser->phone;
                $code->status = 0; //0 :available , 1 : not available
                $code->save();
                DB::commit();

                //check how you need to send the code
                $activeAccount = $request->activeAccount;
                if ($activeAccount == 1) {
                    Notification::send($advertiser, new ActiveAccount($code->code, $advertiser));
                } elseif ($activeAccount == 2) {
                    $response = Http::get("http://www.oursms.net/api/sendsms.php?username=Deal&password=123456&message=Active Code for Deal is :" . $code->code . "&numbers=" . $advertiser->phone . "&sender=Deal&unicode=E&return=full");
                } else {

                    $this->sendWhatsAppSMS($request->phone, "Your Active code is :", $code->code);
                    $points = Point::where('code', 11)->first();
                    if ($points->active == 1) {
                        $point = new Advertiser_Points();
                        $point->advertiser_id = $advertiser->id;
                        $point->num_points = $points->num_points;
                        $point->activity = $points->activity;
                        $point->point_id = $points->id;
                        $point->save();
                    }
                }

                return redirect()->route('advertiser.activation', $advertiser->id)->with(['success' => 'تم التسجيل بنجاح']);
            }
        } catch (\Exception $ex) {
            DB::rollback();
            return redirect()->route('advertiser.register')->with(['error' => 'هناك خطا ما يرجي المحاوله فيما بعد']);
        }

    }

    public function register1(Advertiser1Request $request)
    {
        try {
            $advertiser = new Advertiser();
            $advertiser->username = $request->username;
            $advertiser->password = bcrypt($request->password);
            $advertiser->phone = $request->country_code . $request->phone;
            $advertiser->membership_id = '1';
            $advertiser->save();
            if (!$advertiser) {
                return redirect()->route('advertiser.register.fast')->with(['error' => 'هناك خطأ يرجي المحاوله فيما بعد']);
            } else {
                if ($advertiser) {
                    auth()->guard('advertiser')->login($advertiser);
                    return redirect()->route('index');
                }
            }
        } catch (\Exception $ex) {
            return redirect()->route('advertiser.register.fast')->with(['error' => 'هناك خطا ما يرجي المحاوله فيما بعد']);
        }

    }

    public function sendSMS($message, $mobile)
    {
        $response = Http::get("http://www.oursms.net/api/sendsms.php?username=Deal&password=123456&message=Active Code for Deal is :" . $message . "&numbers=" . $mobile . "&sender=Deal&unicode=E&return=full");
        return;
    }


    public function sendWhatsAppSMS($to , $massege, $code)
    {
        $sid = "AC85ed6281be3aa7d4176ea8f02eada1a7";
        $token = "e4afaa88f1ce7cebdb5e6dfdd5742b9b";
//        $twilio = new Client($sid, $token);
//        $message = $twilio->messagesp
//            ->create("whatsapp:$to",
//                [
//                    "body" => $massege . " " . $code,
//                    "from" => "whatsapp:+14155238886"
//                ]
//            );
        $client = new Client($sid, $token);
        $client->messages->create($to,
            ['from' => '+966566355199', 'body' => $massege . " " . $code] );
        return true;
    }
}

