<?php

namespace App\Http\Controllers\FrontEnd;

use App\Http\Controllers\Controller;
use App\Http\Requests\ReportRequest;
use App\Models\Advertiser_Points;
use App\Models\Black_List;
use App\Models\Point;
use App\Models\Report_Abuse;
use Illuminate\Http\Request;

class ReportAbuseController extends Controller
{

        public function store(ReportRequest $request){
            try {

                if(advertiser() ->email == null OR advertiser() ->is_active == 0){

                    return redirect()->route('advertiser.profile')->with(['error' => 'لا يمكنك الاستفادة من خدمات الموقع قبل اكمال بيانات حسابك']);
                }

                $check = Black_List::where('advertiser_id' , advertiser() ->id)->first();
                if ($check != null){
                    return redirect()->route('advertiser.profile')->with(['error' => 'لا يمكنك الاستفادة من خدامات الموقع بسبب وجودك بالقائمة السوداء']);

                }
                $points = Point::where('code', 10)->first();
                if ($points -> active == 1){
                $point = new Advertiser_Points();
                $point->advertiser_id = advertiser() -> id;
                $point->num_points = $points->num_points;
                $point->activity = $points->activity;
                $point->point_id = $points->id;
                $point->save();}

                $vendor = Report_Abuse::create([
                    'advertiser_id' => advertiser() -> id,
                    'address' => $request->address,
                    'abuse_type' => $request->abuse_type,
                    'comment' => $request->comment,

                    ]);
                return redirect()->route('advertiser.profile')->with(['success' => 'تم حفظ الرسالة بنجاح']);
            } catch (\Exception $ex) {
                return redirect()->route('advertiser.profile')->with(['error' => 'هناك خطا ما يرجي المحاوله فيما بعد']);
            }
        }


        public function storeAdvertising(ReportRequest $request){
            try {

                if(advertiser() ->email == null OR advertiser() ->is_active == 0){

                    return redirect()->route('advertising.card-details')->with(['error' => 'لا يمكنك الاستفادة من خدمات الموقع قبل اكمال بيانات حسابك']);
                }


                $check = Black_List::where('advertiser_id' , advertiser() ->id)->first();
                if ($check != null){
                    return redirect()->route('advertising.card-details',$request -> id)->with(['error' => 'لا يمكنك الاستفادة من خدامات الموقع بسبب وجودك بالقائمة السوداء']);

                }
                $vendor = Report_Abuse::create([
                    'advertiser_id' => advertiser() -> id,
                    'address' => $request->address,
                    'abuse_type' => $request->abuse_type,
                    'comment' => $request->comment,
                    ]);
                return redirect()->route('advertising.card-details',$request -> id)->with(['success' => 'تم حفظ الرسالة بنجاح']);

            } catch (\Exception $ex) {
                return redirect()->route('advertising.card-details',$request -> id)->with(['error' => 'هناك خطا ما يرجي المحاوله فيما بعد']);
            }
        }
}
