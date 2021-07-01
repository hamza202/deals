<?php

namespace App\Http\Controllers\BackEnd\Moderator;

use App\Http\Controllers\Controller;
use App\Http\Requests\CityRequest;
use App\Models\Advertiser;
use App\Models\Advertising;
use App\Models\City;
use App\Models\ModeratorAction;
use Illuminate\Http\Request;

class CityController extends Controller
{
    public function index(){

        $check = $this -> checkRole(3);
        if($check == false){
            return view('back-end.moderator-panel.notRole');
        }
        $cities = City::select()->paginate(10);
        return view('back-end.moderator-panel.cities' , compact('cities'));
    }

    public function store(CityRequest $request)
    {
        $check = $this -> checkRole(4);
        if($check == false){
            return view('back-end.moderator-panel.notRole');
        }
        try {
            City::create($request->except(['_token']));
            return redirect()->route('moderator.cities')->with(['success' => 'تم حفظ المدينة بنجاح']);
        } catch (\Exception $ex) {
            return redirect()->route('moderator.cities')->with(['error' => 'هناك خطا ما يرجي المحاوله فيما بعد']);
        }

    }

    public function update(CityRequest $request)
    {
        $check = $this -> checkRole(5);
        if($check == false){
            return view('back-end.moderator-panel.notRole');
        }
        try {
            $city = City::find($request -> id);
            if (!$city) {
                return redirect()->route('moderator.cities')->with(['error' => 'هذه المدينة غير موجوده']);
            }

            City::where('id', $request -> id)
                ->update([
                    'name' => $request->name,
                ]);
            return redirect()->route('moderator.cities')->with(['success' => 'تم تحديث المدينة بنجاح']);

        } catch (\Exception $ex) {
            return redirect()->route('moderator.cities')->with(['error' => 'هناك خطا ما يرجي المحاوله فيما بعد']);
        }
    }


    public function destroy($id)
    {
        $check = $this -> checkRole(6);
        if($check == false){
            return view('back-end.moderator-panel.notRole');
        }

        try {

            $city=  City::where('id', $id) -> first();

            //delete advertising && use observer
            $advertising = $city ->cityAdvertising ;
            foreach ($advertising as $advertise){
               Advertising::find($advertise -> id)-> delete();
            }

            //delete advertiser && use observer
            $advertisers = $city ->advertiserCity ;
            foreach ($advertisers as $advertiser){
                $advertising = $advertiser ->advertising ;
                foreach ($advertising as $advertise){
                    Advertising::find($advertise -> id)-> delete();
                }
                Advertiser::find($advertiser -> id)-> delete();
            }

            //delete city
            $delete =  City::where('id',$id)->delete();
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
