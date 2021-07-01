<?php

namespace App\Http\Controllers\BackEnd\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MembershipRequest;
use App\Models\Advertiser;
use App\Models\Advertising;
use App\Models\Category;
use App\Models\Membership;
use Illuminate\Http\Request;

class MembershipController extends Controller
{
    public function index(){
        $memberships = Membership::with('advertiserMembership')->get();
        return view('back-end.control-panel.memberships' , compact('memberships'));
    }

    public function store(MembershipRequest $request){
        try {

//            $qualifications = $request -> qualifications;
//            $qualifications_data = [];
//            foreach($qualifications as $qualification) {
//                if ($qualification != null){
//                    array_push($qualifications_data,$qualification);
//                }
//            }
//
//
//            $features = $request -> features;
//            $features_data = [];
//            foreach($features as $feature) {
//                if ($feature != null){
//                    array_push($features_data,$feature);
//                  }
//            }


            $membership = new Membership();
            $membership->title = $request -> title;
            $membership->qualifications = $request -> qualifications;
            $membership->features = $request -> features;
            $membership->save();

            if ($request->has('photo')) {
                $filePath = uploadImage('membership', $request->photo);
                $membership->update([
                        'photo' => $filePath,
                    ]);
            }

            return redirect()->route('admin.membership')->with(['success' => 'تم اضافة العضوية بنجاح']);
        } catch (\Exception $ex) {
            return redirect()->route('admin.membership')->with(['error' => 'هناك خطا ما يرجي المحاوله فيما بعد']);
        }
    }

    public function update(MembershipRequest $request){
        try {
            $row = Membership::find($request -> id);
            if (!$row)
                return redirect()->route('admin.membership')->with(['error' => 'هناك خطأ حاول فى وقت اخر ']);

            // update date

            Membership::where('id', $request -> id)
                ->update([
                    'title' => $request->title,
                    'qualifications' => $request->qualifications,
                    'features' => $request->features,
                ]);

            if ($request->has('photo')) {
                $filePath = uploadImage('membership', $request->photo);
                $row->update([
                    'photo' => $filePath,
                ]);
            }

            return redirect()->route('admin.membership')->with(['success' => 'تم تحديث العضوية بنجاح']);
        } catch (\Exception $ex) {
            return redirect()->route('admin.membership')->with(['error' => 'هناك خطا ما يرجي المحاوله فيما بعد']);
        }
    }

    public function destroy($id)
    {

        try {

            $row=  Membership::where('id', $id) -> first();

            //delete advertising && use observer
            $advertisers = $row ->advertiserMembership ;
            foreach ($advertisers as $advertiser){
                $advertising = $advertiser ->advertising ;
                foreach ($advertising as $advertise){
                    Advertising::find($advertise -> id)-> delete();
                }
                Advertiser::find($advertiser -> id)-> delete();
            }


            //delete category
            $delete =  Membership::where('id',$id)->delete();
            if($delete) {
                $message = 'success';
            }else {
                $message = 'fail';
            }
            return json_encode($message);

        } catch (\Exception $ex) {
            return redirect()->route('admin.membership')->with(['error' => 'هناك خطا ما يرجي المحاوله فيما بعد']);
        }


    }

}
