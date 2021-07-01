<?php

namespace App\Http\Controllers\BackEnd\Moderator;

use App\Http\Controllers\Controller;
use App\Http\Requests\AdvertiserRequest;
use App\Models\Advertiser;
use App\Models\Advertiser_Code;
use App\Models\Advertising;
use App\Models\City;
use App\Models\Moderator;
use App\Models\ModeratorAction;
use App\Models\ModeratoreRole;
use http\Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ModeratorController extends Controller
{
    public function index()
    {
        $check = $this -> checkRole(39);
        if($check == false){
            return view('back-end.moderator-panel.notRole');
        }

        $rows = Moderator::get();
        return view('back-end.moderator-panel.terms-supervisors' ,compact('rows'));
    }

    public function store(Request $request)
    {
        $check = $this -> checkRole(40);
        if($check == false){
            return view('back-end.moderator-panel.notRole');
        }
        try {
            $row = new Moderator();
            $row->name = $request->name;
            $row->username = $request->username;
            $row->email = $request->email;
            $row->password = bcrypt($request->password);
            $row->phone = $request->phone;
            $row->save();
            if (!$row) {
                return redirect()->route('moderator.moderators')->with(['error' => 'هناك خطأ يرجي المحاوله فيما بعد']);
            }
            return redirect()->route('moderator.moderators')->with(['success' => 'تم  اضافة المشرف بنجاح']);

        }
        catch
            (\Exception $ex) {
                return redirect()->route('moderator.moderators')->with(['error' => 'هناك خطا ما يرجي المحاوله فيما بعد']);
    }
}

    public function update(Request $request)
    {
        $check = $this -> checkRole(41);
        if($check == false){
            return view('back-end.moderator-panel.notRole');
        }

        try {
            $row = Moderator::find($request -> id);
            if (!$row) {
                return redirect()->route('moderator.moderators')->with(['error' => 'هذا المشرف غير موجود']);
            }

            Moderator::where('id', $request -> id)
                ->update([
                    'name' => $request->name,
                    'username' => $request->username,
                    'phone' => $request->phone,
                    'email' => $request->email,
                ]);

            if ($request->has('password') ) {
                if ($request->password != null){
                    Moderator::where('id', $request -> id)
                        ->update([
                            'password' =>  bcrypt($request->password)
                        ]);
                }
            }
            return redirect()->route('moderator.moderators')->with(['success' => 'تم تحديث بيانات المشرف بنجاح']);

        } catch (\Exception $ex) {
            return redirect()->route('moderator.moderators')->with(['error' => 'هناك خطا ما يرجي المحاوله فيما بعد']);
        }
    }

    public function destroy($id)
    {
        $check = $this -> checkRole(45);
        if($check == false){
            return view('back-end.moderator-panel.notRole');
        }

        try {

            $delete =  Moderator::where('id',$id)->delete();
            if($delete) {
                $message = 'success';
            }else {
                $message = 'fail';
            }
            return json_encode($message);

        } catch (\Exception $ex) {
            return redirect()->route('moderator.moderators')->with(['error' => 'هناك خطا ما يرجي المحاوله فيما بعد']);
        }


    }

    public function addRole($id){
        $check = $this -> checkRole(42);
        if($check == false){
            return view('back-end.moderator-panel.notRole');
        }
        $rows = ModeratoreRole::get();
        $data = Moderator::where('id' , $id) -> first();
        return view('back-end.moderator-panel.moderator_role' ,compact('rows','data'));
    }

    public function saveRole(Request $request){

        $check = $this -> checkRole(43);
        if($check == false){
            return view('back-end.moderator-panel.notRole');
        }

        try {

            $row = Moderator::find($request -> moderator_id);
            if (!$row) {
                return redirect()->route('moderator.add.role',$request -> moderator_id)->with(['error' => 'هذا المشرف غير موجود']);
            }

            $id = $request -> moderator_id;
            $data1 = $request->except(['_token','moderator_id']);

            foreach ($data1 as $key => $datas){
                $row1 = new ModeratorAction();
                $row1->role_id = $key;
                $row1->moderator_id = $id;
                $row1->save();
            }
            return redirect()->route('moderator.moderators')->with(['success' => 'تم اضاقة الصلاحيات بنجاح']);

        } catch (\Exception $ex) {
            return redirect()->route('moderator.add.role',$request -> moderator_id)->with(['error' => 'هناك خطا ما يرجي المحاوله فيما بعد']);
        }

    }

    public function addRoleAll($id){

        $check = $this -> checkRole(43);
        if($check == false){
            return view('back-end.moderator-panel.notRole');
        }
        try {

            $row = Moderator::find($id);
            if (!$row) {
                return redirect()->route('admin.add.role',$id)->with(['error' => 'هذا المشرف غير موجود']);
            }

            $id = $id;

            $new = ModeratorAction::where('moderator_id',$id)->delete();

            $data1 = ModeratoreRole::get();

            foreach ($data1 as $datas){
                $row1 = new ModeratorAction();
                $row1->role_id = $datas ->id;
                $row1->moderator_id = $id;
                $row1->save();
            }
            return redirect()->route('admin.moderators')->with(['success' => 'تم اضاقة الصلاحيات بنجاح']);

        } catch (\Exception $ex) {
            return redirect()->route('admin.add.role',$id)->with(['error' => 'هناك خطا ما يرجي المحاوله فيما بعد']);
        }

    }

}
