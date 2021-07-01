<?php

namespace App\Http\Controllers\FrontEnd;

use App\Http\Controllers\Controller;
use App\Http\Requests\ConsultationRequest;
use App\Models\AttachmentKnowRight;
use App\Models\Black_List;
use App\Models\Consultation;
use App\Models\Know_Rights;
use Illuminate\Http\Request;

class KnowRightsController extends Controller
{
    public function index(){
        $rights = Know_Rights::all();
        $files = AttachmentKnowRight::all();
        return view('front-end.app.know-rights',compact('rights' , 'files') );
    }

    public function store(ConsultationRequest $request){
        try {

            if(advertiser() ->email == null OR advertiser() ->is_active == 0){

                return redirect()->route('know-rights')->with(['error' => 'لا يمكنك الاستفادة من خدمات الموقع قبل اكمال بيانات حسابك']);
            }


            $check = Black_List::where('advertiser_id' , advertiser() ->id)->first();
            if ($check != null){
                return redirect()->route('know-rights')->with(['error' => 'لا يمكنك الاستفادة من خدامات الموقع بسبب وجودك بالقائمة السوداء']);

            }
            $vendor = Consultation::create([
                'advertiser_id' => advertiser() -> id,
                'name' => $request -> name,
                'email' => $request -> email,
                'phone' => $request -> phone,
                'consultations' => $request -> consultations,
            ]);
            return redirect()->route('know-rights')->with(['alert' => 'تم حفظ الطلب بنجاح']);
        } catch (\Exception $ex) {
            return redirect()->route('know-rights')->with(['alertErrore' => 'هناك خطا ما يرجي المحاوله فيما بعد']);
        }
    }
}
