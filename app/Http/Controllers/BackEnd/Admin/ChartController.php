<?php

namespace App\Http\Controllers\BackEnd\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CityRequest;
use App\Models\Advertiser;
use App\Models\Advertiser_Favourite;
use App\Models\Advertising;
use App\Models\City;
use App\Models\Consultation;
use App\Models\Gift_Replace;
use App\Models\Money_Transfer;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Sarfraznawaz2005\VisitLog\Models\VisitLog;

class ChartController extends Controller
{

    public function index()
    {
        $d = now()->year;

        $rows = [$this->countAdvertiser(Carbon::create($d, 01, 01)), $this->countAdvertiser(Carbon::create($d, 02, 01)), $this->countAdvertiser(Carbon::create($d, 03, 01)), $this->countAdvertiser(Carbon::create($d, 04, 01)), $this->countAdvertiser(Carbon::create($d, 05, 01)), $this->countAdvertiser(Carbon::create($d, 06, 01)), $this->countAdvertiser(Carbon::create($d, 07, 01)), $this->countAdvertiser(Carbon::create($d, 8, 01)), $this->countAdvertiser(Carbon::create($d, 9, 01)), $this->countAdvertiser(Carbon::create($d, 10, 01)), $this->countAdvertiser(Carbon::create($d, 11, 01)), $this->countAdvertiser(Carbon::create($d, 12, 01))];

        $rows1 = [$this->countAdvertising(Carbon::create($d, 01, 01)), $this->countAdvertising(Carbon::create($d, 02, 01)), $this->countAdvertising(Carbon::create($d, 03, 01)), $this->countAdvertising(Carbon::create($d, 04, 01)), $this->countAdvertising(Carbon::create($d, 05, 01)), $this->countAdvertising(Carbon::create($d, 06, 01)), $this->countAdvertising(Carbon::create($d, 07, 01)), $this->countAdvertising(Carbon::create($d, 8, 01)), $this->countAdvertising(Carbon::create($d, 9, 01)), $this->countAdvertising(Carbon::create($d, 10, 01)), $this->countAdvertising(Carbon::create($d, 11, 01)), $this->countAdvertising(Carbon::create($d, 12, 01))];

        $rows2 = [$this->countMoney(Carbon::create($d, 01, 01)), $this->countMoney(Carbon::create($d, 02, 01)), $this->countMoney(Carbon::create($d, 03, 01)), $this->countMoney(Carbon::create($d, 04, 01)), $this->countMoney(Carbon::create($d, 05, 01)), $this->countMoney(Carbon::create($d, 06, 01)), $this->countMoney(Carbon::create($d, 07, 01)), $this->countMoney(Carbon::create($d, 8, 01)), $this->countMoney(Carbon::create($d, 9, 01)), $this->countMoney(Carbon::create($d, 10, 01)), $this->countMoney(Carbon::create($d, 11, 01)), $this->countMoney(Carbon::create($d, 12, 01))];

        $rows3 = [$this->countGift(Carbon::create($d, 01, 01)), $this->countGift(Carbon::create($d, 02, 01)), $this->countGift(Carbon::create($d, 03, 01)), $this->countGift(Carbon::create($d, 04, 01)), $this->countGift(Carbon::create($d, 05, 01)), $this->countGift(Carbon::create($d, 06, 01)), $this->countGift(Carbon::create($d, 07, 01)), $this->countGift(Carbon::create($d, 8, 01)), $this->countGift(Carbon::create($d, 9, 01)), $this->countGift(Carbon::create($d, 10, 01)), $this->countGift(Carbon::create($d, 11, 01)), $this->countGift(Carbon::create($d, 12, 01))];

        $rows4 = [$this->countVisitores(Carbon::create($d, 01, 01)), $this->countVisitores(Carbon::create($d, 02, 01)), $this->countVisitores(Carbon::create($d, 03, 01)), $this->countVisitores(Carbon::create($d, 04, 01)), $this->countVisitores(Carbon::create($d, 05, 01)), $this->countVisitores(Carbon::create($d, 06, 01)), $this->countVisitores(Carbon::create($d, 07, 01)), $this->countVisitores(Carbon::create($d, 8, 01)), $this->countVisitores(Carbon::create($d, 9, 01)), $this->countVisitores(Carbon::create($d, 10, 01)), $this->countVisitores(Carbon::create($d, 11, 01)), $this->countVisitores(Carbon::create($d, 12, 01))];

        $rows5 = [$this->countFavourite(Carbon::create($d, 01, 01)), $this->countFavourite(Carbon::create($d, 02, 01)), $this->countFavourite(Carbon::create($d, 03, 01)), $this->countFavourite(Carbon::create($d, 04, 01)), $this->countFavourite(Carbon::create($d, 05, 01)), $this->countFavourite(Carbon::create($d, 06, 01)), $this->countFavourite(Carbon::create($d, 07, 01)), $this->countFavourite(Carbon::create($d, 8, 01)), $this->countFavourite(Carbon::create($d, 9, 01)), $this->countFavourite(Carbon::create($d, 10, 01)), $this->countFavourite(Carbon::create($d, 11, 01)), $this->countFavourite(Carbon::create($d, 12, 01))];

        $rows8 = [$this->today(1), $this->today(2), $this->today(3), $this->today(4), $this->today(5), $this->today(6), $this->today(7)];

        return view('back-end.control-panel.charts', compact('rows','rows8', 'rows1', 'rows2', 'rows3', 'rows4', 'rows5', 'd'));
    }


    private function countAdvertiser($date1)
    {
        $date23 = $date1->copy()->addMonth();
        $date2 = $date23->subday(1);

        $data = Advertiser::whereBetween('created_at', [$date1, $date2])
            ->count();

        return $data;
    }

    private function countAdvertising($date1)
    {
        $date23 = $date1->copy()->addMonth();
        $date2 = $date23->subday(1);

        $data = Advertising::whereBetween('created_at', [$date1, $date2])
            ->count();

        return $data;
    }


    private function countMoney($date1)
    {
        $date23 = $date1->copy()->addMonth();
        $date2 = $date23->subday(1);

        $data = Money_Transfer::whereBetween('created_at', [$date1, $date2])
            ->count();

        return $data;
    }

    private function countGift($date1)
    {
        $date23 = $date1->copy()->addMonth();
        $date2 = $date23->subday(1);

        $data = Gift_Replace::whereBetween('created_at', [$date1, $date2])
            ->count();

        return $data;
    }

    private function countVisitores($date1)
    {
        $date23 = $date1->copy()->addMonth();
        $date2 = $date23->subday(1);

        $data = VisitLog::whereBetween('created_at', [$date1, $date2])
            ->count();

        return $data;
    }


    private function today($id)
    {
        $today = carbon::now();
        switch ($id) {
            case 1:
                $data = VisitLog::whereDate('created_at', $today)
                    ->count();
                return $data;
            case 2:
                $data = Advertising::whereDate('created_at', $today)
                    ->count();
                return $data;
            case 3:
                $data = Advertiser_Favourite::whereDate('created_at', $today)
                    ->count();
                return $data;

            case 4:
                $data = Money_Transfer::whereDate('created_at', $today)
                    ->count();
                return $data;
            case 5:
                $data = Gift_Replace::whereDate('created_at', $today)
                    ->count();
                return $data;

            case 6:
                $data = Advertiser::whereDate('created_at', $today)
                    ->count();
                return $data;

            case 7:
                $data = Consultation::whereDate('created_at', $today)
                    ->count();
                return $data;


        }
    }


    private function countFavourite($date1)
    {
        $date23 = $date1->copy()->addMonth();
        $date2 = $date23->subday(1);

        $data = Advertiser_Favourite::whereBetween('created_at', [$date1, $date2])
            ->count();

        return $data;
    }


}
