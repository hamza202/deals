<?php

namespace App\Http\Controllers\BackEnd\Moderator;

use App\Http\Controllers\Controller;
use App\Models\Advertiser;
use App\Models\Advertising;
use App\Models\Money_Transfer;
use App\Notifications\Money;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;


class CommissionController extends Controller
{
    public function index(){

        $check = $this -> checkRole(87);
        if($check == false){
            return view('back-end.moderator-panel.notRole');
        }

        $finish = Money_Transfer::where('status' ,1) ->get();
        $review = Money_Transfer::where('status' ,0) ->get();
        $unacceptable = Money_Transfer::where('status' ,2) ->get();

        return view('back-end.moderator-panel.commission' ,
            compact('finish' ,'review','unacceptable'));
    }

    public function update($id)
    {
        $check = $this -> checkRole(88);
        if($check == false){
            return view('back-end.moderator-panel.notRole');
        }
        try {
            $row = Money_Transfer::find($id);
            if (!$row) {
                return redirect()->route('moderator.commission')->with(['error' => 'هذه العمولة غير موجوده']);
            }

            Money_Transfer::where('id', $id)
                ->update([
                    'status' => 1,
                ]);

            $advertising = Advertising::where('id', $row->advertising_id)->first();
            $advertiser = Advertiser::where('id' , $advertising -> advertiser_id)->first();


            Notification::send($advertiser, new Money($advertiser,'تم قبول العمولة'));

            return redirect()->route('moderator.commission')->with(['success' => 'تم التحديث بنجاح']);

        } catch (\Exception $ex) {
            return redirect()->route('moderator.commission')->with(['error' => 'هناك خطا ما يرجي المحاوله فيما بعد']);
        }
    }


    public function accept(Request $request)
    {
        $check = $this -> checkRole(89);
        if($check == false){
            return view('back-end.moderator-panel.notRole');
        }
        try {
            $row = Money_Transfer::find($request ->id);
            if (!$row) {
                return redirect()->route('moderator.commission')->with(['error' => 'هذه العمولة غير موجوده']);
            }

            Money_Transfer::where('id', $request ->id)
                ->update([
                    'status' => 2,
                    'reason' => $request -> reason,
                ]);

            $name = $request -> reason;

            $advertising = Advertising::where('id', $row->advertising_id)->first();
            $advertiser = Advertiser::where('id' , $advertising -> advertiser_id)->first();


            Notification::send($advertiser, new Money($advertiser,$name));

            return redirect()->route('moderator.commission')->with(['success' => 'تم الرفض بنجاح']);

        } catch (\Exception $ex) {
            return redirect()->route('moderator.commission')->with(['error' => 'هناك خطا ما يرجي المحاوله فيما بعد']);
        }
    }

}
