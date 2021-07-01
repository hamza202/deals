<?php

namespace App\Http\Controllers\BackEnd\Moderator;

use App\Http\Controllers\Controller;
use App\Http\Requests\GiftRequest;
use App\Models\City;
use App\Models\Gift;
use Illuminate\Http\Request;

class GiftController extends Controller
{
    public function index(){
        $check = $this -> checkRole(26);
        if($check == false){
            return view('back-end.moderator-panel.notRole');
        }
        $gifts = Gift::with('memberShip')->paginate(10);
        return view('back-end.moderator-panel.gift-program' , compact('gifts'));
    }

    public function store(GiftRequest $request)
    {

        $check = $this -> checkRole(27);
        if($check == false){
            return view('back-end.moderator-panel.notRole');
        }
        try{

            $gift = new Gift();
            $gift->name = $request->name;
            $gift->points = $request->points;
            $gift->available = $request->available;
            $gift->membership_id = $request->membership_id;
            $gift->save();

            if (!$gift) {
                return redirect()->route('moderator.gifts')->with(['error' => 'هناك خطأ يرجي المحاوله فيما بعد']);
            }

            if ($request->has('photo') ) {
                if ($request->photo != null){
                    $filePath = uploadImage('gifts', $request->photo);
                    $gift->update([
                        'photo' => $filePath,
                    ]);
                }
            }

            return redirect()->route('moderator.gifts')->with(['success' => 'تم اضافة الهدية بنجاح']);

        }
        catch (\Exception $ex) {

            return redirect()->route('moderator.gifts')->with(['error' => 'هناك خطا ما يرجي المحاوله فيما بعد']);
        }

    }

    public function update(GiftRequest $request)
    {

        $check = $this -> checkRole(28);
        if($check == false){
            return view('back-end.moderator-panel.notRole');
        }

        try {
            $gift = Gift::find($request -> id);
            if (!$gift) {
                return redirect()->route('moderator.gifts')->with(['error' => 'هذه الهدية غير موجوده']);
            }

            Gift::where('id', $request -> id)
                ->update([
                    'name' => $request->name,
                    'points' => $request->points,
                ]);

            if ($request->has('photo') ) {
                if ($request->photo != null){
                $filePath = uploadImage('gifts', $request->photo);
                $gift->update([
                    'photo' => $filePath,
                ]);
            }
            }

            return redirect()->route('moderator.gifts')->with(['success' => 'تم تحديث الهدية بنجاح']);

        } catch (\Exception $ex) {
            return redirect()->route('moderator.gifts')->with(['error' => 'هناك خطا ما يرجي المحاوله فيما بعد']);
        }
    }

    public function updateMembership(Request $request)
    {
        $check = $this -> checkRole(29);
        if($check == false){
            return view('back-end.moderator-panel.notRole');
        }

        try {
            $gift = Gift::find($request -> id);
            if (!$gift) {
                return redirect()->route('moderator.gifts')->with(['error' => 'هذه الهدية غير موجودة']);
            }

            Gift::where('id', $request -> id)
                ->update([
                    'membership_id' => $request->membership_id,
                ]);
            return redirect()->route('moderator.gifts')->with(['success' => 'تم تحديث بيانات الهدية بنجاح']);

        } catch (\Exception $ex) {
            return redirect()->route('moderator.gifts')->with(['error' => 'هناك خطا ما يرجي المحاوله فيما بعد']);
        }
    }

    public function updateAvailable(Request $request)
    {

        $check = $this -> checkRole(30);
        if($check == false){
            return view('back-end.moderator-panel.notRole');
        }

        try {
            $gift = Gift::find($request -> id);
            if (!$gift) {
                return redirect()->route('moderator.gifts')->with(['error' => 'هذه الهدية غير موجودة']);
            }

            Gift::where('id', $request -> id)
                ->update([
                    'available' => $request->available,
                ]);
            return redirect()->route('moderator.gifts')->with(['success' => 'تم تحديث بيانات الهدية بنجاح']);

        } catch (\Exception $ex) {
            return redirect()->route('moderator.gifts')->with(['error' => 'هناك خطا ما يرجي المحاوله فيما بعد']);
        }
    }

}
