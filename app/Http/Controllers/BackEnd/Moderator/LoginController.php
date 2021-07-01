<?php

namespace App\Http\Controllers\Backend\Moderator;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use Illuminate\Http\Request;

use Illuminate\Foundation\Auth\AuthenticatesUsers;

use Auth;

class LoginController extends Controller
{

    use AuthenticatesUsers;


    public function __construct()
    {
        $this->middleware('guest:moderator')->except('logout');
    }


    public function getLogin()
    {
        return view('back-end.auth.moderator-login');
    }

    public function moderatorLogin(LoginRequest $request)
    {

        $remember_me = $request->has('remember_me') ? true : false;

        if (auth()->guard('moderator')->attempt(['email' => $request->input("email"), 'password' => $request->input("password")], $remember_me)) {
            // notify()->success('تم الدخول بنجاح  ');
            return redirect() -> route('moderator.dashboard');
        }
        // notify()->error('خطا في البيانات  برجاء المجاولة مجدا ');
        return redirect()->back()->with(['error' => 'هناك خطا بالبيانات']);
    }



    public function logout(Request $request)
    {
        \Illuminate\Support\Facades\Auth::guard('moderator')->logout();
        return $this->loggedOut($request) ?: redirect(route('get.moderator.login'));
    }

}
