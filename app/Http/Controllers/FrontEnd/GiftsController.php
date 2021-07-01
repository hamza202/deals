<?php

namespace App\Http\Controllers\FrontEnd;

use App\Http\Controllers\Controller;
use App\Models\Advertiser_Points;
use App\Models\Black_List;
use App\Models\Gift;
use App\Models\Gift_Replace;
use App\Models\Membership;
use App\Models\Page;
use Illuminate\Http\Request;
use Alert;


class GiftsController extends Controller
{
    //صفحة الهدايا م عرض الهدايا المتاحة و الهدايا الغير متوفرة
    public function index()
    {
        if (advertiser() == null) {
            $gifts = Gift::with('memberShip')->get();
            $gifts_available = null;
            $gifts_not_available = null;
        } else {
            $gifts = null;
            $mem =advertiser() ->membership_id;
           // $gifts = Gift::with('memberShip')->where('membership_id','!=',$mem)->get();
            $gifts_available = Gift::with('memberShip') -> available()->get();
            $gifts_not_available = Gift::with('memberShip')->notAvailable()->get();
        }
        return view('front-end.app.gifts-deal', compact('gifts' ,'gifts_available', 'gifts_not_available'));
    }

    public function store(Request $request){
        try {

            if(advertiser() ->email == null OR advertiser() ->is_active == 0){

                return redirect()->route('gifts-deal')->with(['error' => 'لا يمكنك الاستفادة من خدمات الموقع قبل اكمال بيانات حسابك']);
            }


            $check = Black_List::where('advertiser_id' , advertiser() ->id)->first();
            if ($check != null){
                return redirect()->route('gifts-deal')->with(['error' => 'لا يمكنك الاستفادة من خدامات الموقع بسبب وجودك بالقائمة السوداء']);

            }
            $points = advertiserPoints(advertiser() -> id);
            $gift = Gift::where('id' , $request->id) -> first();
            if ($gift -> points > $points){
                return redirect()->route('gifts-deal')->with(['error' => 'عدد النقاط لا يكفي لطلب الهدية']);
            }else{
                $row = new Gift_Replace();
                $row->gift_id = $request -> id;
                $row->address = $request -> address;
                $row->advertiser_id = advertiser() -> id;
                $row->accept = 0;
                $row->save();
            }

            alert()->success('SuccessAlert','Lorem ipsum dolor sit amet.');

            return redirect()->route('gifts-deal')->with(['alert' => 'تم ارسال طلب الهدية بنجاح']);
        } catch (\Exception $ex) {
            return redirect()->route('gifts-deal')->with(['alertErrore' => 'هناك خطا ما يرجي المحاوله فيما بعد']);
        }
    }
}
