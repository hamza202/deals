<?php

namespace App\Http\Controllers\BackEnd\Moderator;

use App\Http\Controllers\Controller;
use App\Http\Requests\PointRequest;
use App\Models\City;
use App\Models\Point;
use PDF;
use Illuminate\Http\Request;

class AmrtidallController extends Controller
{
    public function index(){
        $check = $this -> checkRole(46);
        if($check == false){
            return view('back-end.moderator-panel.notRole');
        }

        $points = Point::paginate(5);
        return view('back-end.moderator-panel.amr-tidalal' , compact('points'));
    }

    public function store(PointRequest $request)
    {

        $check = $this -> checkRole(47);
        if($check == false){
            return view('back-end.moderator-panel.notRole');
        }

        try {
            Point::create($request->except(['_token']));
            return redirect()->route('moderator.amrtidall')->with(['success' => 'تم حفظ النشاط بنجاح']);
        } catch (\Exception $ex) {
            return redirect()->route('moderator.amrtidall')->with(['error' => 'هناك خطا ما يرجي المحاوله فيما بعد']);
        }
    }


    public function downloadPDF() {
        $check = $this -> checkRole(49);
        if($check == false){
            return view('back-end.moderator-panel.notRole');
        }
        $points = Point::all();
        $pdf = PDF::loadView('back-end.moderator-panel.pdf', compact('points'));
       return $pdf->download('AmrTidall.pdf');

    }

    public function update(PointRequest $request)
    {
        $check = $this -> checkRole(48);
        if($check == false){
            return view('back-end.moderator-panel.notRole');
        }

        try {
            $point = Point::find($request -> id);
            if (!$point) {
                return redirect()->route('moderator.amrtidall')->with(['error' => 'هذا البرنامج غير موجود']);
            }

            Point::where('id', $request -> id)
                ->update([
                    'activity' => $request->activity,
                    'num_points' => $request->num_points,
                    'total_subscriptions' => $request->total_subscriptions,
                ]);

            return redirect()->route('moderator.amrtidall')->with(['success' => 'تم تحديث البرنامج بنجاح']);

        } catch (\Exception $ex) {
            return redirect()->route('moderator.amrtidall')->with(['error' => 'هناك خطا ما يرجي المحاوله فيما بعد']);
        }
    }

    public function active($id)
    {

        $check = $this -> checkRole(85);
        if($check == false){
            return view('back-end.moderator-panel.notRole');
        }

        try {
            $point = Point::find($id);
            if (!$point) {
                return redirect()->route('moderator.amrtidall')->with(['error' => 'هذا البرنامج غير موجود']);
            }

            $status =  $point -> active  == 0 ? 1 : 0;


            Point::where('id', $id)
                ->update([
                    'active' => $status,
                ]);

            return redirect()->route('moderator.amrtidall')->with(['success' => 'تم تحديث البرنامج بنجاح']);

        } catch (\Exception $ex) {
            return redirect()->route('moderator.amrtidall')->with(['error' => 'هناك خطا ما يرجي المحاوله فيما بعد']);
        }
    }


}
