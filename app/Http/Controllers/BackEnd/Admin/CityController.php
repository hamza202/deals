<?php

namespace App\Http\Controllers\BackEnd\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CityRequest;
use App\Models\Advertiser;
use App\Models\Advertising;
use App\Models\City;
use Illuminate\Http\Request;

class CityController extends Controller
{
    public function index(){
        $cities = City::select()->paginate(10);
        return view('back-end.control-panel.cities' , compact('cities'));
    }

    public function store(CityRequest $request)
    {
        try {
            City::create($request->except(['_token']));
            return redirect()->route('admin.cities')->with(['success' => 'تم حفظ المدينة بنجاح']);
        } catch (\Exception $ex) {
            return redirect()->route('admin.cities')->with(['error' => 'هناك خطا ما يرجي المحاوله فيما بعد']);
        }

    }

    public function update(CityRequest $request)
    {
        try {
            $city = City::find($request -> id);
            if (!$city) {
                return redirect()->route('admin.cities')->with(['error' => 'هذه المدينة غير موجوده']);
            }

            City::where('id', $request -> id)
                ->update([
                    'name' => $request->name,
                ]);
            return redirect()->route('admin.cities')->with(['success' => 'تم تحديث المدينة بنجاح']);

        } catch (\Exception $ex) {
            return redirect()->route('admin.cities')->with(['error' => 'هناك خطا ما يرجي المحاوله فيما بعد']);
        }
    }


    public function destroy($id)
    {

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
            return redirect()->route('admin.cities')->with(['error' => 'هناك خطا ما يرجي المحاوله فيما بعد']);
        }


    }

}
