<?php

namespace App\Http\Controllers\BackEnd\Admin;

use App\Http\Controllers\Controller;
use App\Models\Advertiser;
use App\Models\Advertising;
use App\Models\Category;
use App\Models\City;
use App\Models\FixedAdvertising;
use App\Models\Subscription;
use Illuminate\Http\Request;

class AdvertisingController extends Controller
{

    public function newestAdvertising()
    {
        $rows = Advertising::where('status', 1)->paginate(10);
        return $rows;
    }

    public function index()
    {
        $rows = Category::with('advertising')
            ->where('parent_id', 0)->paginate(10);

        return view('back-end.control-panel.advertising', compact('rows'));
    }


    public function advertise($id)
    {
        $rows = Advertising::where('id', $id)->first();
        $packages = Subscription::where('status', 1)->where('advertiser_id', $rows->advertiser_id)->get();
        return view('back-end.control-panel.advertise', compact('rows', 'packages'));
    }

    public function advertiseNewUpdate()
    {
        $rows = Advertising::all();
        return view('back-end.control-panel.advertisingNew', compact('rows'));
    }

    public function advertiseNewUpdateAll(Request $request)
    {
        try {
            $data = $request->except(['_token','start_date','end_date']);
            $start_date = $request->start_date;
            $end_date = $request->end_date;
            foreach ($data as $key => $datas){
                $check = Advertising::where('id',$key)->first();
                $status = $check -> status;
                if ($check -> status == 3){
                    $status =1;
                }
             Advertising::where('id',$key)->update([
                'created_at' => $start_date,
                'start_date' => $start_date,
                'end_date' => $end_date,
                'status' => $status,
             ]);
            }
            return redirect()->route('admin.advertising.new.update')->with(['success' => 'تم تحديث الاعلانات بنجاح']);

        }
        catch (\Exception $ex) {

            return redirect()->route('admin.advertising.new.update')->with(['error' => 'هناك خطا ما يرجي المحاوله فيما بعد']);
        }

    }


    public function saveStatus(Request $request)
    {

            try {
                $row = Advertising::find($request->id);
                if (!$row) {
                    return redirect()->route('admin.advertise', ['id' => $request->id])->with(['error' => 'هذا الاعلان غير موجود']);
                }

                Advertising::where('id', $request->id)
                    ->update([
                        'status' => $request->status,
                        'start_date' => $request->start_date,
                        'end_date' => $request->end_date,
                    ]);

                if ($request->status == 2) {
                    $DATA = FixedAdvertising::where('advertising_id', $request->id)->update(
                        'status', 1
                    );
                    if (!$DATA) {
                        $new = new FixedAdvertising();
                        $new->status = 1;
                        $new->advertising_id = $request->id;
                        $new->advertiser_id = $row->advertiser->id;
                        $new->save();
                    }
                }

                if (request()->has('package_id')) {
                    Advertising::where('id', $request->id)
                        ->update([
                            'package_id' => $request->package_id,
                        ]);
                }

                return redirect()->route('admin.advertise', ['id' => $request->id])->with(['success' => 'تم تحديث الاعلان بنجاح']);

            } catch (\Exception $ex) {

                return redirect()->route('admin.advertise', ['id' => $request->id])->with(['error' => 'هناك خطا ما يرجي المحاوله فيما بعد']);
            }
    }

    public function refuseStatus(Request $request)
    {
        {
            try {
                $row = Advertising::find($request->id);
                if (!$row) {
                    return redirect()->route('admin.advertise', ['id' => $request->id])->with(['error' => 'هذا الاعلان غير موجود']);
                }

                FixedAdvertising::where('id', $request->id)
                    ->update([
                        'status' => 5,
                        'reason' => $request->reason,
                    ]);

                return redirect()->route('admin.advertise', ['id' => $request->id])->with(['success' => 'تم تحديث الاعلان بنجاح']);

            } catch (\Exception $ex) {

                return redirect()->route('admin.advertise', ['id' => $request->id])->with(['error' => 'هناك خطا ما يرجي المحاوله فيما بعد']);
            }
        }
    }

    public function allAdvertising($id)
    {
        $rows = Advertising::where('category_id', $id)->paginate(10);
        return view('back-end.control-panel.advertising-details', compact('rows'));
    }

    public function mainFixedAdvertising($id)
    {
        $rows = Advertising::where('category_id', $id)
            ->where('status', 2)
            ->paginate(10);
        return view('back-end.control-panel.advertising-details', compact('rows'));
    }

    public function newAdvertising($id)
    {
        $rows = Advertising::where('category_id', $id)
            ->where('status', 1)
            ->paginate(10);
        return view('back-end.control-panel.advertising-details', compact('rows'));


    }

    public function acceptAdvertising($id)
    {
        $rows = Advertising::where('category_id', $id)
            ->where('status', 1)
            ->paginate(10);
        return view('back-end.control-panel.advertising-details', compact('rows'));


    }

    public function finishAdvertising($id)
    {
        $rows = Advertising::where('category_id', $id)
            ->where('status', 3)
            ->paginate(10);
        return view('back-end.control-panel.advertising-details', compact('rows'));


    }

    public function destroy($id)
    {

        try {

            $delete = Advertising::where('id', $id)->delete();
            if ($delete) {
                $message = 'success';
            } else {
                $message = 'fail';
            }
            return json_encode($message);

        } catch (\Exception $ex) {
            return redirect()->route('admin.cities')->with(['error' => 'هناك خطا ما يرجي المحاوله فيما بعد']);
        }


    }

    public function search(Request $request)
    {
        if (request()->has('filter')) {
            $data = Advertising::with('advertiser')->get();
            $filter = request('filter');
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
                        } elseif ($list->title == $filter) {
                            array_push($rows, $list);
                        } elseif ($list->phone == $filter) {
                            array_push($rows, $list);
                        } elseif ($list->id == $filter) {
                            array_push($rows, $list);
                        }
                    }
                }
            }
            return view('back-end.control-panel.searchAdvertising', compact('rows'));

        } else {
            $rows = Gift_Replace::where('accept', 0)->get();
            $accepts = Gift_Replace::where('accept', 1)->paginate(5);
            return view('back-end.control-panel.replace_gift', compact('rows', 'accepts'));

        }
    }
}
