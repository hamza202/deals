<?php

namespace App\Http\Controllers\BackEnd\Moderator;

use App\Http\Controllers\Controller;
use App\Http\Requests\CityRequest;
use App\Models\Advertiser;
use App\Models\Advertising;
use App\Models\AttachmentKnowRight;
use App\Models\City;
use Illuminate\Http\Request;

class AttachmentKnowRightsController extends Controller
{
    public function index()
    {
        $datas = AttachmentKnowRight::select()->paginate(10);
        return view('back-end.moderator-panel.attachmentKnowRights', compact('datas'));
    }

    public function store(Request $request)
    {
        try {
            if ($files = $request->file('url')) {
                $destinationPath = 'front-end/images/advertising-images/'; // upload path
                $profilefile = date('YmdHis') . "." . $files->getClientOriginalExtension();
                $files->move($destinationPath, $profilefile);
                $insert['files'] = $profilefile;
            }
            AttachmentKnowRight::create(
                [
                    'url' => $profilefile,
                    'name' => $request -> name,
                ]
            );
            return redirect()->route('moderator.attachmentKnowRights')->with(['success' => 'تم حفظ المرفق بنجاح']);
        } catch (\Exception $ex) {
            return redirect()->route('moderator.attachmentKnowRights')->with(['error' => 'هناك خطا ما يرجي المحاوله فيما بعد']);
        }

    }

    public function destroy($id)
    {
        try {
            //delete AttachmentKnowRight
            $delete = AttachmentKnowRight::where('id', $id)->delete();
            if ($delete) {
                $message = 'success';
            } else {
                $message = 'fail';
            }
            return json_encode($message);

        } catch (\Exception $ex) {
            return redirect()->route('moderator.attachmentKnowRight')->with(['error' => 'هناك خطا ما يرجي المحاوله فيما بعد']);
        }
    }

}
