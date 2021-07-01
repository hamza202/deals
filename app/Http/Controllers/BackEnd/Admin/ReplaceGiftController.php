<?php

namespace App\Http\Controllers\BackEnd\Admin;

use App\Http\Controllers\Controller;
use App\Models\Advertiser;
use App\Models\Advertiser_Points;
use App\Models\Gift_Replace;
use App\Notifications\Gift;
use App\Notifications\Money;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;

class ReplaceGiftController extends Controller
{

    public function index(Request $request)
    {
        if (request()->has('filter')) {
            $data = Gift_Replace::with('advertiser')->where('accept', 0)->get();
            $filter = request('filter');
            $accepts = Gift_Replace::where('accept', 1)->paginate(5);
            $noAccepts = Gift_Replace::where('accept', 2)->paginate(5);
            $rows = array();
            if (!empty($data)) {
                foreach ($data as $list) {
                    $id = $list->advertiser->id;
                    $rowss = Advertiser::where('id', $id)->first();

                    if ($rowss != null) {
                        if ($rowss->email == $filter) {
                            array_push($rows, $list);
                        } elseif ($rowss->name == $filter) {
                            array_push($rows, $list);
                        } elseif ($rowss->username == $filter) {
                            array_push($rows, $list);
                        } elseif ($rowss->phone == $filter) {
                            array_push($rows, $list);
                        }
                    }
                }
            }
            return view('back-end.control-panel.replace_gift', compact('rows', 'noAccepts','accepts'));

        } else {
            $rows = Gift_Replace::where('accept', 0)->get();
            $noAccepts = Gift_Replace::where('accept', 2)->paginate(5);
            $accepts = Gift_Replace::where('accept', 1)->paginate(5);
            return view('back-end.control-panel.replace_gift', compact('rows', 'noAccepts','accepts'));

        }
    }

    public function update($id)
    {
        try {
            $row = Gift_Replace::find($id);
            if (!$row) {
                return redirect()->route('admin.replace_gifts')->with(['error' => 'هذا الطلب غير موجود']);
            }

            $advertiser = Advertiser::where('id', $row->advertiser_id)->first();

            $points = advertiserPoints($advertiser->id);

            if ($points < $row -> gift ->points){
                return redirect()->route('admin.replace_gifts')->with(['error' => 'عدد نقاط المعلن غير كافية']);
            }

            $data = Gift_Replace::where('id', $id)
                ->update([
                    'accept' => 1,
                ]);

            $point = new Advertiser_Points();
            $point->advertiser_id = $advertiser -> id;
            $point->num_points = -1*($row -> gift ->points);
            $point->activity = "استبدال نقاط بهدية";
            $point->point_id = null;
            $point->save();

            Notification::send($advertiser, new Gift($advertiser, 'تم قبول الطلب'));

            return redirect()->route('admin.replace_gifts')->with(['success' => 'تم تأكيد الطلب بنجاح']);

        } catch (\Exception $ex) {

            return redirect()->route('admin.replace_gifts')->with(['error' => 'هناك خطا ما يرجي المحاوله فيما بعد']);
        }
    }
    public function updateNotAccept(Request $request)
    {
        try {
            $row = Gift_Replace::find($request->id);
            if (!$row) {
                return redirect()->route('admin.replace_gifts')->with(['error' => 'هذا الطلب غير موجود']);
            }

            $advertiser = Advertiser::where('id', $row->advertiser_id)->first();


            $data = Gift_Replace::where('id', $request->id)
                ->update([
                    'accept' => 2,
                    'reason' => $request->reason,
                ]);

            Notification::send($advertiser, new Gift($advertiser, $request->reason.'  تم رفض طلب الهدية'));

            return redirect()->route('admin.replace_gifts')->with(['success' => 'تم تأكيد الرفض بنجاح']);

        } catch (\Exception $ex) {

            return redirect()->route('admin.replace_gifts')->with(['error' => 'هناك خطا ما يرجي المحاوله فيما بعد']);
        }
    }
}
