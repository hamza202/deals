<?php

namespace App\Http\Controllers;

use App\Models\Advertising;
use App\Models\ModeratorAction;
use App\Models\Subscription;
use DateTime;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Sarfraznawaz2005\VisitLog\Facades\VisitLog;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function __construct()
    {
            VisitLog::save();
        $today_dt = \Carbon\Carbon::today()->format('Y-m-d');
        $rows = Advertising::where('status' ,'!=' , 4)->get();
        foreach ($rows as $row){
            $date = $row -> end_date;
            if ($date != null){
                if ($date < $today_dt ){
                        $row->update([
                            'status' =>4,
                        ]);
                }
            }
        }
        $packages = Subscription::where('status' ,1)->get();
        foreach ($packages as $package){
            $date = $package -> end_date;
            if ($date != null){
                if ($date < $today_dt ){
                    $package -> update([
                        'status' => 2,
                    ]);
                }
            }
        }
    }

    public function checkRole($role){
        $check = ModeratorAction::where('role_id' ,$role)->where('moderator_id',moderator()->id)->first();
        if ($check == null){
           return false;
        }
        return true ;
    }
}
