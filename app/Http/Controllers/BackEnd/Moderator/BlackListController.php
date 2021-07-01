<?php

namespace App\Http\Controllers\BackEnd\Moderator;

use App\Http\Controllers\Controller;
use App\Models\Advertiser;
use App\Models\Black_List;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BlackListController extends Controller
{
    public function index()
    {

        $check = $this->checkRole(82);
        if ($check == false) {
            return view('back-end.moderator-panel.notRole');
        }

        $rows = Black_List::paginate(10);
        $advertisers = Advertiser::where('is_active', 0)->paginate(10);
        $data = [];
        return view('back-end.moderator-panel.black-list', compact('data', 'rows', 'advertisers'));
    }

    public function search(Request $request)
    {
        $check = $this->checkRole(82);
        if ($check == false) {
            return view('back-end.moderator-panel.notRole');
        }
        $data = [];
        if (request()->has('filter')) {
            $name = $request->name;
            $advertisers = Advertiser::where('name', 'LIKE', "%$name%")
                ->paginate(10);
            $data = $advertisers;
        }
        $rows = [];
        $advertisers = [];
        return view('back-end.moderator-panel.black-list', compact('data', 'rows', 'advertisers'));
    }

    public function store(Request $request)
    {
        $check = $this->checkRole(83);
        if ($check == false) {
            return view('back-end.moderator-panel.notRole');
        }
        try {
            DB::beginTransaction();

            $data = new Black_List();
            $data->advertiser_id = $request->id;
            $data->reason = $request->reason;
            $data->save();
            if (!$data) {
                return redirect()->route('moderator.black_list')->with(['error' => 'هناك خطأ يرجي المحاوله فيما بعد']);
            }

            Advertiser::where('id', $request->id)
                ->update([
                    'is_active' => 1
                ]);

            DB::commit();
            return redirect()->route('moderator.black_list')->with(['success' => 'تم اضافة المعلن للقائمة السوداء بنجاح']);
        } catch (\Exception $ex) {
            DB::rollback();
            return redirect()->route('moderator.black_list')->with(['error' => 'هناك خطا ما يرجي المحاوله فيما بعد']);
        }
    }


    public function delete($id)
    {
        $check = $this->checkRole(84);
        if ($check == false) {
            return view('back-end.moderator-panel.notRole');
        }
        try {
            DB::beginTransaction();

            $row = Black_List::find($id);
            $advertiser_id = $row->advertiser_id;
            if (!$row) {
                return redirect()->route('moderator.black_list')->with(['error' => 'هناك خطأ يرجي المحاوله فيما بعد']);
            }
            $row->delete();


            Advertiser::where('id', $advertiser_id)
                ->update([
                    'is_active' => 0
                ]);

            DB::commit();
            return redirect()->route('moderator.black_list')->with(['success' => 'تم ازالة المعلن من القائمة السوداء بنجاح']);
        } catch (\Exception $ex) {
            DB::rollback();
            return redirect()->route('moderator.black_list')->with(['error' => 'هناك خطا ما يرجي المحاوله فيما بعد']);
        }
    }
}
