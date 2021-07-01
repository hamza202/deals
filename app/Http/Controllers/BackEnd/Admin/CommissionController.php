<?php

namespace App\Http\Controllers\BackEnd\Admin;

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
        $finish = Money_Transfer::where('status' ,1) ->get();
        $review = Money_Transfer::where('status' ,0) ->get();
        $unacceptable = Money_Transfer::where('status' ,2) ->get();

        return view('back-end.control-panel.commission' ,
            compact('finish' ,'review','unacceptable'));
    }

    public function update($id)
    {
        try {
            $row = Money_Transfer::find($id);
            if (!$row) {
                return redirect()->route('admin.commission')->with(['error' => 'هذه العمولة غير موجوده']);
            }

            Money_Transfer::where('id', $id)
                ->update([
                    'status' => 1,
                ]);

            $advertising = Advertising::where('id', $row->advertising_id)->first();
            $advertiser = Advertiser::where('id' , $advertising -> advertiser_id)->first();


            Notification::send($advertiser, new Money($advertiser,'تم قبول العمولة'));

            return redirect()->route('admin.commission')->with(['success' => 'تم التحديث بنجاح']);

        } catch (\Exception $ex) {
            return redirect()->route('admin.commission')->with(['error' => 'هناك خطا ما يرجي المحاوله فيما بعد']);
        }
    }


    public function accept(Request $request)
    {
        try {
            $row = Money_Transfer::find($request ->id);
            if (!$row) {
                return redirect()->route('admin.commission')->with(['error' => 'هذه العمولة غير موجوده']);
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

            return redirect()->route('admin.commission')->with(['success' => 'تم الرفض ']);

        } catch (\Exception $ex) {
            return redirect()->route('admin.commission')->with(['error' => 'هناك خطا ما يرجي المحاوله فيما بعد']);
        }
    }

}
