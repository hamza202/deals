<?php

namespace App\Http\Controllers\FrontEnd\Auth;


use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Models\Advertiser;
use App\Providers\RouteServiceProvider;
use Carbon\Carbon;
use http\Exception;
use Illuminate\Http\Request;

use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;

use Illuminate\Validation\ValidationException;
use Laravel\Socialite\Facades\Socialite;


class LoginController extends Controller
{

    protected $guard = 'advertiser';

   // protected $redirectTo = RouteServiceProvider::HOME;

    use AuthenticatesUsers;


    public function __construct()
    {
        $this->middleware('guest:advertiser')->except('logout');
    }


    public function login(Request $request)
    {

        $login = request()->input('username');

        if(is_numeric($login)){
            $remember_me = $request->has('remember_me') ? true : false;
            if (auth()->guard('advertiser')->attempt(['phone' => $request->input("username"), 'password' => $request->input("password") ,'is_active' => 1], $remember_me)) {
                advertiser()->last_login = Carbon::now()->setTimezone('Asia/Riyadh')->toDateTimeString();
                advertiser()->update(['fcm_token' => $request -> _token]);
                return redirect()->route('index');
            }
            elseif (auth()->guard('advertiser')->attempt(['phone' => $request->input("username"), 'password' => $request->input("password") ,'is_active' => 0], $remember_me)) {
                $id =advertiser()->id;
                Auth::guard('advertiser')->logout();
                return view('front-end.app.form-activation' , compact('id'));
                //  return redirect()->route('advertiser.activation', advertiser()->id)->with(['error' => 'حسابك غير مفعل , قم بتفعيل حسابك']);
            }
        }
        elseif (filter_var($login, FILTER_VALIDATE_EMAIL)) {
            $remember_me = $request->has('remember_me') ? true : false;
            if (auth()->guard('advertiser')->attempt(['email' => $request->input("username"), 'password' => $request->input("password") ,'is_active' => 1], $remember_me)) {
                advertiser()->last_login = Carbon::now()->setTimezone('Asia/Riyadh')->toDateTimeString();
                advertiser()->update(['fcm_token' => $request -> _token]);
                return redirect()->route('index');
            }
            elseif (auth()->guard('advertiser')->attempt(['email' => $request->input("username"), 'password' => $request->input("password") ,'is_active' => 0], $remember_me)) {
                $id =advertiser()->id;
                Auth::guard('advertiser')->logout();
                return view('front-end.app.form-activation' , compact('id'));
                //  return redirect()->route('advertiser.activation', advertiser()->id)->with(['error' => 'حسابك غير مفعل , قم بتفعيل حسابك']);
            }
        }

        return redirect()->back()->with(['error' => 'هناك خطا بالبيانات']);
    }

    public function logout(Request $request)
    {
        Auth::guard('advertiser')->logout();
        return $this->loggedOut($request) ?: redirect(route('index1'));
    }

    public function redirectToProvider()
    {
        return Socialite::driver('google')->redirect();
    }

    public function handleProviderCallback()
    {
        try {
            $user = Socialite::driver('google')->user();
        } catch (\Exception $e) {
            return redirect('/advertiser/login');
        }

        // check if they're an existing user
        $existingUser = Advertiser::where('email', $user->email)->first();
        if($existingUser){
            // log them in
            Auth::guard('advertiser')->login($existingUser, true);
        } else {
            // create a new user
            $newUser                  = new Advertiser();
            $newUser->name            = $user->name;
            $newUser->username            = $user->name;
            $newUser->is_active       =1;
            $newUser->membership_id       =1;
            $newUser->email           = $user->email;
            $newUser->google_id       = $user->id;
            $newUser->avatar          = $user->avatar;
            $newUser->avatar_original = $user->avatar_original;
            $newUser->save();
            Auth::guard('advertiser')->login($newUser, true);
        }
        return redirect()->route('index');
    }
}
