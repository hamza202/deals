<?php

namespace App\Http\Controllers\FrontEnd;

use App\Http\Controllers\Controller;
use App\Models\Black_List;
use App\Models\Report_Abuse;
use App\Models\Subscription;
use App\Models\Subscription_Package;
use App\Models\SubscriptionRequest;
use Illuminate\Http\Request;

class SubscriptionController extends Controller
{
    public function index($true = null)
    {
        $rows = Subscription_Package::with('plan')->get();
        return view('front-end.app.type-package', compact('rows', 'true'));
    }

    public function store($id)
    {
        try {
            if (advertiser()->email == null or advertiser()->is_active == 0) {

                return redirect()->route('advertiser.subscription')->with(['error' => 'لا يمكنك الاستفادة من خدمات الموقع قبل اكمال بيانات حسابك']);
            }

            $check = Black_List::where('advertiser_id', advertiser()->id)->first();
            if ($check != null) {
                return redirect()->route('advertiser.subscription')->with(['error' => 'لا يمكنك الاستفادة من خدامات الموقع بسبب وجودك بالقائمة السوداء']);

            }
            $row = Subscription::create([
                'advertiser_id' => advertiser()->id,
                'package_id' => $id,
                'status' => 0,
            ]);
            if ($row) {
                alert()->success('SuccessAlert', 'Lorem ipsum dolor sit amet.');
                return redirect()->route('advertiser.subscription')->with(['alert' => 'تم اضافة الاشتراك بنجاح سيتم التواصل معك من قبل فريق ديل']);

            }

            return redirect()->route('advertiser.subscription')->with(['error' => 'هناك خطا ما يرجي المحاوله فيما بعد']);

        } catch (\Exception $ex) {

            return redirect()->route('advertiser.subscription')->with(['error' => 'هناك خطا ما يرجي المحاوله فيما بعد']);
        }


    }

    public function storeRequest($id)
    {
        try {
            if (advertiser()->email == null or advertiser()->is_active == 0) {

                return redirect()->route('advertiser.subscription')->with(['error' => 'لا يمكنك الاستفادة من خدمات الموقع قبل اكمال بيانات حسابك']);
            }

            $check = Black_List::where('advertiser_id', advertiser()->id)->first();
            if ($check != null) {
                return redirect()->route('advertiser.subscription')->with(['error' => 'لا يمكنك الاستفادة من خدامات الموقع بسبب وجودك بالقائمة السوداء']);

            }
            $row = SubscriptionRequest::create([
                'advertiser_id' => advertiser()->id,
                'package_id' => $id,
                'status' => 0,
            ]);
            if ($row)
                return redirect()->route('advertiser.subscription')->with(['alert' => 'تم  ارسال الطلب بنجاح سيتم التواصل معك من قبل فريق ديل ']);
            return redirect()->route('advertiser.subscription')->with(['error' => 'هناك خطا ما يرجي المحاوله فيما بعد']);

        } catch (\Exception $ex) {

            return redirect()->route('advertiser.subscription')->with(['error' => 'هناك خطا ما يرجي المحاوله فيما بعد']);
        }


    }


}
