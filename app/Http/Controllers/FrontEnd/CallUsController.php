<?php

namespace App\Http\Controllers\FrontEnd;

use App\Http\Controllers\Controller;
use App\Http\Requests\CallUsRequest;
use App\Models\Contact_Us;
use Illuminate\Http\Request;

class CallUsController extends Controller
{
    public function index(){
        return view('front-end.app.call-us');
    }

    public function store(CallUsRequest $request){
        try {
            Contact_Us::create($request->except(['_token']));
            return redirect()->route('call_us')->with(['success' => 'تم حفظ الرسالة بنجاح']);
        } catch (\Exception $ex) {
            return redirect()->route('call_us')->with(['error' => 'هناك خطا ما يرجي المحاوله فيما بعد']);
        }
    }
}
