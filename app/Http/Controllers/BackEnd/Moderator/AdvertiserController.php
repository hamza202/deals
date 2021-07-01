<?php

namespace App\Http\Controllers\BackEnd\Moderator;

use App\Http\Controllers\Controller;
use App\Http\Requests\AdvertiserRequest;
use App\Models\Advertiser;
use App\Models\Advertiser_Code;
use App\Models\Advertiser_Points;
use App\Models\Advertising;
use App\Models\City;
use App\Models\ModeratorAction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdvertiserController extends Controller
{
    public function index(Request $request){
        $check = $this -> checkRole(20);
        if($check == false){
            return view('back-end.moderator-panel.notRole');
        }

        $advertisers = Advertiser::with('advertiserMembership' , 'advertiserPoints')
            ->paginate(10);
        if (request()->has('filter')){
            $name = $request -> name;
            $city_id = $request -> city_id;
            $membership_id = $request -> membership_id;
            $advertisers = Advertiser::with('advertiserMembership' , 'advertiserPoints')
                ->where('name'  , 'LIKE', "%$name%")
                ->where('city_id'  , 'LIKE', "%$city_id%")
                ->where('membership_id'  , 'LIKE', "%$membership_id%")
                ->paginate(10);
        }
        return view('back-end.moderator-panel.advertiser' , compact('advertisers'));
    }

    public function store(AdvertiserRequest $request)
    {

        $check = $this -> checkRole(22);
        if($check == false){
            return view('back-end.moderator-panel.notRole');
        }

        try{
            DB::beginTransaction();
            $advertiser = new Advertiser();
            $advertiser->name = $request->name;
            $advertiser->username = $request->username;
            $advertiser->email = $request->email;
            $advertiser->password = bcrypt($request->password);
            $advertiser->phone = $request->phone;
            $advertiser->city_id = $request->city_id;
            $advertiser->address = $request->address;
            $advertiser->membership_id =  $request->membership_id;
            $advertiser->save();
            if (!$advertiser) {
                return redirect()->route('moderator.advertisers')->with(['error' => 'هناك خطأ يرجي المحاوله فيما بعد']);
            }
            else{

                $active_code = generateRandomString();
                $code = new Advertiser_Code();
                $code -> advertiser_id = $advertiser -> id;
                $code -> code = $active_code;
                $code -> advertiser_number = $advertiser -> phone;
                $code -> status = 0; //0 :available , 1 : not available
                $code -> save();
                DB::commit();
                return redirect()->route('moderator.advertisers' )->with(['success' => 'تم التسجيل بنجاح']);
             }
        }
        catch (\Exception $ex) {
            DB::rollback();
            return redirect()->route('moderator.advertisers')->with(['error' => 'هناك خطا ما يرجي المحاوله فيما بعد']);
        }
    }

    public function update( AdvertiserRequest $request)
    {
        $check = $this -> checkRole(23);
        if($check == false){
            return view('back-end.moderator-panel.notRole');
        }

        try {
            $advertiser = Advertiser::find($request -> id);
            if (!$advertiser) {
                return redirect()->route('moderator.advertisers')->with(['error' => 'هذا المعلن غير موجود']);
            }

            Advertiser::where('id', $request -> id)
                ->update([
                    'name' => $request->name,
                    'username' => $request->username,
                    'address' => $request->address,
                    'phone' => $request->phone,
                    'email' => $request->email,
                ]);
            return redirect()->route('moderator.advertisers')->with(['success' => 'تم تحديث بيانات المعلن بنجاح']);

        } catch (\Exception $ex) {
            return redirect()->route('moderator.advertisers')->with(['error' => 'هناك خطا ما يرجي المحاوله فيما بعد']);
        }
    }

    public function updateMembership(Request $request)
    {
        $check = $this -> checkRole(24);
        if($check == false){
            return view('back-end.moderator-panel.notRole');
        }
        try {
            $advertiser = Advertiser::find($request -> id);
            if (!$advertiser) {
                return redirect()->route('moderator.advertisers')->with(['error' => 'هذا المعلن غير موجود']);
            }

            Advertiser::where('id', $request -> id)
                ->update([
                    'membership_id' => $request->membership_id,
                ]);
            return redirect()->route('moderator.advertisers')->with(['success' => 'تم تحديث بيانات المعلن بنجاح']);

        } catch (\Exception $ex) {
            return redirect()->route('moderator.advertisers')->with(['error' => 'هناك خطا ما يرجي المحاوله فيما بعد']);
        }
    }


    public function updatePoints(Request $request)
    {
        $check = $this -> checkRole(95);
        if($check == false){
            return view('back-end.moderator-panel.notRole');
        }
        try {
            $advertiser = Advertiser::find($request->id);
            if (!$advertiser) {
                return redirect()->route('moderator.advertisers')->with(['error' => 'هذا المعلن غير موجود']);
            }

            $data = new Advertiser_Points();
            $data->advertiser_id = $request->id;
            $data->num_points = $request->numPoints;
            $data->activity = $request->activity;
            $data->save();
            if ($data)
                return redirect()->route('moderator.advertisers')->with(['success' => 'تم اضافة نقاط المعلن بنجاح']);
            return redirect()->route('moderator.advertisers')->with(['error' => 'هناك خطا ما يرجي المحاوله فيما بعد']);

        } catch (\Exception $ex) {
            return redirect()->route('moderator.advertisers')->with(['error' => 'هناك خطا ما يرجي المحاوله فيما بعد']);
        }
    }


    public function destroy($id)
    {

        $check = $this -> checkRole(25);
        if($check == false){
            return view('back-end.moderator-panel.notRole');
        }
        try {

            $row=  Advertiser::where('id', $id) -> first();

            //delete advertising && use observer
            $advertising = $row ->advertising ;
            foreach ($advertising as $advertise){
                Advertising::find($advertise -> id)-> delete();
            }


            //delete advertiser && use observer
            $delete =  Advertiser::where('id',$id)->delete();
            if($delete) {
                $message = 'success';
            }else {
                $message = 'fail';
            }
            return json_encode($message);

        } catch (\Exception $ex) {
            return redirect()->route('moderator.cities')->with(['error' => 'هناك خطا ما يرجي المحاوله فيما بعد']);
        }


    }


}


