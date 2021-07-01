<?php

namespace App\Http\Controllers\BackEnd\Admin;

use App\Http\Controllers\Controller;
use App\Models\Advertiser;
use App\Models\Consultation;
use App\Models\Contact_Us;
use App\Models\Report_Abuse;
use App\Notifications\ContactUs;
use App\Notifications\ReportAbuse;
use App\Notifications\VendorCreated;
use Illuminate\Http\Request;
use Illuminate\Mail\Mailable;
use Illuminate\Support\Facades\Notification;

class ConsultingController extends Controller
{
    public function contactUs()
    {

        $rows = Contact_Us::where('status', 0)->paginate(10);
        $data = Contact_Us::where('status', 1)->paginate(10);
        return view('back-end.control-panel.contact-us', compact('rows', 'data'));
    }

    public function consultations(Request $request)
    {

        if (request()->has('filter')) {
            $filter = request('filter');
            $data = Consultation::with('advertiser')->get();
            $rows = array();
            if (!empty($data)) {
                foreach ($data as $list) {
                    $id = $list->advertiser->id;
                    $rowss = Advertiser::where('id', $id)->first();

                    if ($rowss != null) {
                        if ($rowss->email == $filter) {
                            array_push($rows, $list);
                        } elseif ($rowss->name == $filter) {
                            array_push($rows, $list);
                        } elseif ($rowss->username == $filter) {
                            array_push($rows, $list);
                        } elseif ($rowss->phone == $filter) {
                            array_push($rows, $list);
                        } elseif ($list->phone == $filter) {
                            array_push($rows, $list);
                        } elseif ($list->name == $filter) {
                            array_push($rows, $list);
                        } elseif ($list->email == $filter) {
                            array_push($rows, $list);
                        } elseif ($list->id == $filter) {
                            array_push($rows, $list);
                        }
                    }


                }
            }
            $filtter = 0;
            return view('back-end.control-panel.consultations', compact('filtter', 'rows'));

        } else {
            $rows = Consultation::where('status', 0)->get();
            $rows1 = Consultation::where('status', 1)->get();
            $filtter = 1;
            return view('back-end.control-panel.consultations', compact('filtter', 'rows', 'rows1'));
        }


    }

    public function abuse()
    {
        $rows = Report_Abuse::paginate(10);
        return view('back-end.control-panel.abuse', compact('rows'));
    }


    public function abuseAnswer(Request $request)
    {

        try {

            $name = $request->name;
            $advertiser = Advertiser::where('id', $request->id)->first();

            Notification::send($advertiser, new ReportAbuse($advertiser, $name));

            $delete = Report_Abuse::where('id', $request->abous)->delete();
            if (!$delete) {
                return redirect()->route('admin.abuse')->with(['error' => 'هناك خطأ يرجي المحاوله فيما بعد']);
            }
            return redirect()->route('admin.abuse')->with(['success' => 'تم ارسال الرد ']);

        } catch (\Exception $ex) {

            return redirect()->route('admin.abuse')->with(['error' => 'هناك خطا ما يرجي المحاوله فيما بعد']);
        }
    }

    public function consultationsAnswer(Request $request)
    {

        try {

            $name = $request->name;
            $advertiser = Advertiser::where('id', $request->id)->first();


            $data = Consultation::where('id', $request->abous)->update(
                [
                    'status' => 1,
                    'answer' => $request->name
                ]
            );
            if (!$data) {

                return redirect()->route('admin.consultations')->with(['error' => 'هناك خطأ يرجي المحاوله فيما بعد']);
            }
            Notification::send($advertiser, new \App\Notifications\Consultation($advertiser, $name));

            return redirect()->route('admin.consultations')->with(['success' => 'تم ارسال الرد ']);

        } catch (\Exception $ex) {

            return redirect()->route('admin.consultations')->with(['error' => 'هناك خطا ما يرجي المحاوله فيما بعد']);
        }
    }


    public function contactAnswer(Request $request)
    {

        try {

            $name = $request->name;
            $email = $request->email;
            $answer = $request->answer;

            $data = Contact_Us::where('id', $request->abous)->update([
                'status' => 1,
                'answer' => $request->answer
            ]);
            if (!$data) {
                return redirect()->route('admin.contact-us')->with(['error' => 'هناك خطأ يرجي المحاوله فيما بعد']);
            }

            Notification::route('mail', $email)->notify(new ContactUs($name, $email, $answer));

            return redirect()->route('admin.contact-us')->with(['success' => 'تم ارسال الرد ']);

        } catch (\Exception $ex) {

            return redirect()->route('admin.contact-us')->with(['error' => 'هناك خطا ما يرجي المحاوله فيما بعد']);
        }
    }


}
