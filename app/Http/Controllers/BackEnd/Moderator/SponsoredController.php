<?php

namespace App\Http\Controllers\BackEnd\Moderator;

use App\Http\Controllers\Controller;
use App\Models\SponsoredAds;
use Illuminate\Http\Request;

class SponsoredController extends Controller
{
    /**
     * 3/2/2021 11:00PM by:Mai Ghazal
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $check = $this->checkRole(96);
        if ($check == false) {
            return view('back-end.moderator-panel.notRole');
        }
        $rows = SponsoredAds::orderByDesc('created_at')
            ->paginate(10);
        return view('back-end.moderator-panel.Sponsored', compact('rows'));
    }

    public function store(Request $request)
    {
        $check = $this->checkRole(96);
        if ($check == false) {
            return view('back-end.moderator-panel.notRole');
        }
        try {
            $profilefile = null;

            if ($files = $request->file('photo')) {
                $destinationPath = 'front-end/images/advertising-images/'; // upload path
                $profilefile = date('YmdHis') . "." . $files->getClientOriginalExtension();
                $files->move($destinationPath, $profilefile);
                $insert['files'] = $profilefile;
            }

            $checkData = SponsoredAds::where('position', $request->position)
                ->whereBetween('start_date', [$request->start_date, $request->end_date])
                ->WhereBetween('end_date', [$request->start_date, $request->end_date])
                ->first();

            if ($checkData) {
                return redirect()->route('moderator.sponsored')->with(['error' => 'يوجد اعلان مفعل خلال هذه الفترة الرجاء تعديل تاريخ الاضافة و الانتهاء ']);
            }

            if (!$checkData) {
                SponsoredAds::create(
                    [
                        'photo' => $profilefile,
                        'url' => $request->url,
                        'start_date' => $request->start_date,
                        'end_date' => $request->end_date,
                        'position' => $request->position,
                    ]
                );
                return redirect()->route('moderator.sponsored')->with(['success' => 'تم حفظ الاعلان بنجاح']);
            } else {
                return redirect()->route('moderator.sponsored')->with(['error' => 'يوجد اعلان مفعل خلال هذه الفترة الرجاء تعديل تاريخ الاضافة و الانتهاء ']);
            }
        } catch (\Exception $ex) {
            return redirect()->route('moderator.sponsored')->with(['error' => 'هناك خطا ما يرجي المحاوله فيما بعد']);
        }

    }

    /**
     * By:Mai Ghazal 4/2/2021 12:48AM
     * @param $id
     * @return false|\Illuminate\Http\RedirectResponse|string
     *
     */
    public function destroy($id)
    {
        $check = $this->checkRole(96);
        if ($check == false) {
            return view('back-end.moderator-panel.notRole');
        }
        try {
            //delete sponsored
            $delete = SponsoredAds::where('id', $id)->delete();
            if ($delete) {
                $message = 'success';
            } else {
                $message = 'fail';
            }
            return json_encode($message);

        } catch (\Exception $ex) {
            return redirect()->route('moderator.sponsored')->with(['error' => 'هناك خطا ما يرجي المحاوله فيما بعد']);
        }
    }
}
