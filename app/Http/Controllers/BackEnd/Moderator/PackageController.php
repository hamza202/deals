<?php

namespace App\Http\Controllers\BackEnd\Moderator;

use App\Http\Controllers\Controller;
use App\Http\Requests\PackageRequest;
use App\Models\Advertiser;
use App\Models\Advertising;
use App\Models\Gift_Replace;
use App\Models\Plan;
use App\Models\Subscription;
use App\Models\Subscription_Package;
use App\Models\SubscriptionRequest;
use Facade\Ignition\Support\Packagist\Package;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;

class PackageController extends Controller
{
    public function index()
    {
        $check = $this->checkRole(35);
        if ($check == false) {
            return view('back-end.moderator-panel.notRole');
        }
        $rows = Subscription_Package::with('plan')->paginate(10);
        return view('back-end.moderator-panel.subscription_package', compact('rows'));
    }

    public function store(PackageRequest $request)
    {
        $check = $this->checkRole(36);
        if ($check == false) {
            return view('back-end.moderator-panel.notRole');
        }
        try {
            $row = new Subscription_Package();
            $row->name = $request->name;
            $row->price = $request->price;
            $row->time_line = $request->time_line;
            $row->discount = $request->discount;
            $row->save();

            $plan = new Plan();
            $plan->advertising = $request->advertising;
            $plan->membership = $request->membership;
            $plan->subscriptions_id = $row->id;
            $plan->save();

            if (!$row) {
                return redirect()->route('moderator.packages')->with(['error' => 'هناك خطأ يرجي المحاوله فيما بعد']);
            }


            return redirect()->route('moderator.packages')->with(['success' => 'تم اضافة الباقة بنجاح']);

        } catch (\Exception $ex) {

            return redirect()->route('moderator.packages')->with(['error' => 'هناك خطا ما يرجي المحاوله فيما بعد']);
        }

    }

    public function update(PackageRequest $request)
    {
        $check = $this->checkRole(37);
        if ($check == false) {
            return view('back-end.moderator-panel.notRole');
        }
        try {
            $row = Subscription_Package::find($request->id);
            if (!$row) {
                return redirect()->route('moderator.packages')->with(['error' => 'هذه الباقة غير موجوده']);
            }

            Subscription_Package::where('id', $request->id)
                ->update([
                    'name' => $request->name,
                    'price' => $request->price,
                    'time_line' => $request->time_line,
                    'discount' => $request->discount
                ]);


            Plan::where('subscriptions_id', $request->id)
                ->update([
                    'advertising' => $request->advertising,
                    'membership' => $request->membership,
                ]);


            return redirect()->route('moderator.packages')->with(['success' => 'تم تحديث الباقة بنجاح']);

        } catch (\Exception $ex) {
            return redirect()->route('moderator.packages')->with(['error' => 'هناك خطا ما يرجي المحاوله فيما بعد']);
        }
    }

    public function destroy($id)
    {
        $check = $this->checkRole(38);
        if ($check == false) {
            return view('back-end.moderator-panel.notRole');
        }

        try {
            $row = Subscription_Package::where('id', $id)->first();

            //delete advertising && use observer
            $advertising = $row->advertisingPackage;
            foreach ($advertising as $advertise) {
                Advertising::find($advertise->id)->delete();
            }


            //delete Subscription_Package
            $delete = Subscription_Package::where('id', $id)->delete();
            if ($delete) {
                $message = 'success';
            } else {
                $message = 'fail';
            }
            return json_encode($message);

        } catch (\Exception $ex) {
            return redirect()->route('moderator.packages')->with(['error' => 'هناك خطا ما يرجي المحاوله فيما بعد']);
        }


    }

    public function subscription()
    {

        $check = $this->checkRole(90);
        if ($check == false) {
            return view('back-end.moderator-panel.notRole');
        }
        $rows = Subscription::with('package', 'advertiser')->where('status', 0)->paginate(10);
        $accepts = Subscription::with('package', 'advertiser')->where('status', 1)->paginate(10);
        $finish = Subscription::with('package', 'advertiser')->where('status', 2)->paginate(10);
        $newRequests = SubscriptionRequest::with('package', 'advertiser')->where('status', 0)->paginate(10);
        $oldRequests = SubscriptionRequest::with('package', 'advertiser')->where('status', 1)->paginate(10);
        return view('back-end.moderator-panel.subscription',
            compact('rows', 'accepts', 'finish', 'newRequests', 'oldRequests'));


    }

    public function storeSubscription($id)
    {

        $check = $this->checkRole(91);
        if ($check == false) {
            return view('back-end.moderator-panel.notRole');
        }
        try {
            $row = Subscription::find($id);
            if (!$row) {
                return redirect()->route('moderator.subscription.show')->with(['error' => 'هذه الباقة غير موجوده']);
            }

            $rows = Subscription::with('package')->where('id', $id)->first();
            $count = $rows->package->time_line;
            $start_date = \Carbon\Carbon::today()->format('Y-m-d');
            $end_date = \Carbon\Carbon::parse($start_date)->addDays($count)->format('Y-m-d');

            $advertiser = Advertiser::where('id', $rows->advertiser_id)->first();
            if ($advertiser->membership_id != 4) {
                $plus = $advertiser->membership_id;
                $plus1 = $rows->package->plan->membership;
                $plues = $plus + $plus1;
                if ($plues <= 4) {
                    $result = $plues;
                } else {
                    $result = 4;
                }
                Advertiser::where('id', $rows->advertiser_id)
                    ->update([
                        'membership_id' => $result,
                    ]);
            }

            Subscription::where('id', $id)
                ->update([
                    'start_date' => $start_date,
                    'end_date' => $end_date,
                    'status' => 1,
                ]);


            return redirect()->route('moderator.subscription.show')->with(['success' => 'تم تحديث الباقة بنجاح']);

        } catch (\Exception $ex) {
            return redirect()->route('moderator.subscription.show')->with(['error' => 'هناك خطا ما يرجي المحاوله فيما بعد']);
        }
    }

    /**
     * 4/2/2021
     * By Mai Ghazal , 4:30PM
     * @param Request $request
     */
    public function PackageAnswer(Request $request)
    {
        try {

            $answer = $request->answer;

            $advertiser = Advertiser::where('id', $request->id)->first();

            $data = SubscriptionRequest::where('id', $request->sponsored)->update(
                [
                    'status' => 1,
                    'answer' => $request->answer
                ]
            );
            if (!$data) {
                return redirect()->route('moderator.subscription.show')->with(['error' => 'هناك خطأ يرجي المحاوله فيما بعد']);
            }
            Notification::send($advertiser, new \App\Notifications\SubscriptionPackage($advertiser, $answer));

            return redirect()->route('moderator.subscription.show')->with(['success' => 'تم ارسال الرد ']);

        } catch (\Exception $ex) {
            return redirect()->route('moderator.subscription.show')->with(['error' => 'هناك خطا ما يرجي المحاوله فيما بعد']);
        }

    }

}
