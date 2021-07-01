<?php

namespace App\Http\Controllers\BackEnd\Admin;

use App\Http\Controllers\Controller;
use App\Models\Advertising;
use App\Models\Money_Transfer;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class DashboardController extends Controller
{
    public function index(){
        $rows = Advertising::orderBy('id', 'DESC') -> get() -> take(8);
        $rowss = Advertising::orderBy('id', 'DESC') ->where('status' , 1) -> get() -> take(5);
        $data = Money_Transfer::where('status' , 0) -> get();
        return view('back-end.control-panel.main' , compact('rows' , 'rowss' , 'data'));
    }

    public function review($id){
        try {
            $row = Money_Transfer::find($id);
            if (!$row) {
                return redirect()->route('admin.dashboard')->with(['error' => 'هذه العمولة غير موجوده']);
            }

            Money_Transfer::where('id', $id)
                ->update([
                    'status' => 1,
                ]);
            return redirect()->route('admin.dashboard')->with(['success' => 'تم تحديث البيانات بنجاح']);

        } catch (\Exception $ex) {
            return redirect()->route('admin.dashboard')->with(['error' => 'هناك خطا ما يرجي المحاوله فيما بعد']);
        }
    }


}
