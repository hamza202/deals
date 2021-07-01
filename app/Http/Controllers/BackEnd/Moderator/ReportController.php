<?php

namespace App\Http\Controllers\BackEnd\Moderator;

use App\Exports\AccountExport;
use App\Exports\ActiveExport;
use App\Exports\AdvertisersExport;
use App\Exports\CategoryExport;
use App\Exports\CommissionsExport;
use App\Exports\GitsExport;
use App\Exports\KnowExport;
use App\Exports\VisitorExport;
use App\Http\Controllers\Controller;
use App\Models\Advertiser;
use App\Models\Category;
use App\Models\Gift_Replace;
use App\Models\Money_Transfer;
use Carbon\Carbon;
use Illuminate\Http\Request;
use PDF;
use Maatwebsite\Excel\Facades\Excel;
use Sarfraznawaz2005\VisitLog\Facades\VisitLog;

class ReportController extends Controller
{
    public function index()
    {

        $check = $this -> checkRole(93);
        if($check == false){
            return view('back-end.moderator-panel.notRole');
        }
        return view('back-end.moderator-panel.reports');
    }


    public function AdvertiserReport(Request $request)
    {

        $from = $request->from;
        $to = $request->to;


        $data = Advertiser::whereBetween('created_at', [$from, $to])
            ->get();


        $pdf = PDF::loadView('back-end.reports.advertiser', compact('data'));
        return $pdf->download('Advertiser.pdf');
    }


    function AdvertiserReportExcel(Request $request)
    {


        $from = $request->from;
        $to = $request->to;

        return Excel::download(new AdvertisersExport($from, $to), 'advertisers.xlsx');
    }

    public function AdvertiserSocialReport(Request $request)
    {
        $from = $request->from;
        $to = $request->to;

        $pdf = PDF::loadView('back-end.reports.advertiserSocial',
            compact('from', 'to'));
        return $pdf->download('AdvertiserSocial.pdf');
    }


    function AdvertiserSocialReportExcel(Request $request)
    {

        $from = $request->from;
        $to = $request->to;

        return Excel::download(new KnowExport($from, $to), 'advertisers.xlsx');
    }

    public function GiftReport(Request $request)
    {

        $from = $request->from;
        $to = $request->to;


        $data1 = Gift_Replace::where('accept', 1)
            ->whereBetween('updated_at', [$from, $to])
            ->count();


        $rows = Gift_Replace::with('advertiser', 'gift')->where('accept', 1)
            ->whereBetween('updated_at', [$from, $to])
            ->get();


        $pdf = PDF::loadView('back-end.reports.gift',
            compact('data1', 'rows'));
        return $pdf->download('Gift.pdf');
    }


    function GiftReportExcel(Request $request)
    {
        $from = $request->from;
        $to = $request->to;

        $data1 = Gift_Replace::where('accept', 1)
            ->whereBetween('updated_at', [$from, $to])
            ->count();

        $rows = Gift_Replace::with('advertiser', 'gift')->where('accept', 1)
            ->whereBetween('updated_at', [$from, $to])
            ->get();

        $rowData = array();

        $new1 = array();
        $new1['Gifts Accepte'] = $data1;
        $new1['Name'] = '';
        $new1['Gift'] = '';
        $new1['Address'] = '';
        $new1['Phone'] = '';
        $new1['Email'] = '';
        $new1['Date of Accepte'] = '';
        array_push($rowData, $new1);

        foreach ($rows as $row) {
            $new1 = array();
            $new1['Gifts Accepte'] = '';
            $new1['Name'] = $row->advertiser->name;
            $new1['Gift'] = $row->gift->name;
            $new1['Address'] = $row->address;
            $new1['Phone'] = $row->advertiser->phone;
            $new1['Email'] = $row->advertiser->email;
            $new1['Date of Accepte'] = $row->updated_at;
            array_push($rowData, $new1);
        }

        return Excel::download(new GitsExport($rowData), 'gifts.xlsx');
    }


    public function AdvertiserAccountReport(Request $request)
    {

        $from = $request->from;
        $to = $request->to;


        $data1 = Advertiser::where('active_account', 1)
            ->whereBetween('created_at', [$from, $to])
            ->count();
        $data2 = Advertiser::where('active_account', 2)
            ->whereBetween('created_at', [$from, $to])
            ->count();
        $data3 = Advertiser::where('active_account', 3)
            ->whereBetween('created_at', [$from, $to])
            ->count();

        $pdf = PDF::loadView('back-end.reports.advertiserAccount',
            compact('data1', 'data2', 'data3'));
        return $pdf->download('AdvertiserAccount.pdf');
    }

    function AdvertiserAccountReportExcel(Request $request)
    {

        $from = $request->from;
        $to = $request->to;

        return Excel::download(new AccountExport($from, $to), 'advertisers.xlsx');
    }


    public function VisitorReport(Request $request)
    {

        $from = $request->from;
        $to = $request->to;


        $data1 = Advertiser::whereBetween('created_at', [$from, $to])
            ->count();
        $data2 = VisitLog::all()->whereBetween('created_at', [$from, $to])->count();

        $pdf = PDF::loadView('back-end.reports.visitors',
            compact('data1', 'data2'));
        return $pdf->download('visitors.pdf');
    }

    function VisitorReportExcel(Request $request)
    {

        $from = $request->from;
        $to = $request->to;

        return Excel::download(new VisitorExport($from, $to), 'visitores.xlsx');
    }


    public function AdvertiserActiveReport()
    {

        $active = Advertiser::whereDate('last_login', '>=', Carbon::now()->subDays(60))->get();
        $not_active = Advertiser::whereDate('last_login', '<', Carbon::now()->subDays(60))->get();
        $total = Advertiser::count();
        $wl = Advertiser::whereDate('last_login', '>=', Carbon::now()->subDays(60))->count();
        $nwl = Advertiser::whereDate('last_login', '<', Carbon::now()->subDays(60))->count();
        $percent_active = 0;
        $percent_not_active = 0;
        if ($total != 0 AND $wl != 0) {
            $percent_active1 = $wl / $total * 100;
            $percent_active = number_format((float)$percent_active1, 2, '.', '');
        }

        if ($total != 0 AND $nwl != 0) {
            $percent_not_active1 = $nwl / $total * 100;
            $percent_not_active = number_format((float)$percent_not_active1, 2, '.', '');

        }

        $pdf = PDF::loadView('back-end.reports.advertiserActive', compact('percent_active', 'percent_not_active', 'active', 'not_active'));
        return $pdf->download('AdvertiserActive.pdf');
    }


    function AdvertiserActiveReportExcel()
    {
        $active = Advertiser::select(['id', 'name', 'email', 'phone'])->whereDate('last_login', '>=', Carbon::now()->subDays(60))->get();
        $not_active = Advertiser::select(['id', 'name', 'email', 'phone'])->whereDate('last_login', '<', Carbon::now()->subDays(60))->get();
        $total = Advertiser::count();
        $wl = Advertiser::whereDate('last_login', '>=', Carbon::now()->subDays(60))->count();
        $nwl = Advertiser::whereDate('last_login', '<', Carbon::now()->subDays(60))->count();
        $percent_active = 0;
        $percent_not_active = 0;
        if ($total != 0 AND $wl != 0) {
            $percent_active1 = $wl / $total * 100;
            $percent_active = number_format((float)$percent_active1, 2, '.', '');
        }

        if ($total != 0 AND $nwl != 0) {
            $percent_not_active1 = $nwl / $total * 100;
            $percent_not_active = number_format((float)$percent_not_active1, 2, '.', '');

        }

        $dds = array();
        $dds1 = array();

        $dds1['#'] = '';
        $dds1['name'] = '';
        $dds1['email'] = '';
        $dds1['phone'] = '';
        $dds1['type'] = '';
        $dds1['percent active'] = $percent_active . "%";
        $dds1['percent not active'] = $percent_not_active . "%";

        array_push($dds, $dds1);


        foreach ($active as $actives) {
            $dds1 = $actives->toArray();
            $dds1['type'] = 'active';
            $dds1['percent active'] = '';
            $dds1['percent not active'] = '';
            array_push($dds, $dds1);
        }

        foreach ($not_active as $not_actives) {

            $dds1 = $not_actives->toArray();
            $dds1['type'] = 'not_active';
            $dds1['percent active'] = '';
            $dds1['percent not active'] = '';
            array_push($dds, $dds1);
        }


        return Excel::download(new ActiveExport($dds), 'advertisers.xlsx');


    }


    public function MoneyReport(Request $request)
    {

        $from = $request->from;
        $to = $request->to;


        $data1 = Money_Transfer::where('status', 1)
            ->whereBetween('updated_at', [$from, $to])
            ->count();


        $rows = Money_Transfer::with('advertising')->where('status', 1)
            ->whereBetween('updated_at', [$from, $to])
            ->get();

        $total = 0;
        if ($rows != null) {
            foreach ($rows as $row) {
                $value = $row->money;
                $total = $total + $value;
            }
        }


        $pdf = PDF::loadView('back-end.reports.money',
            compact('data1', 'rows', 'total'));
        return $pdf->download('money.pdf');
    }


    function MoneyReportExcel(Request $request)
    {
        $from = $request->from;
        $to = $request->to;

        $data1 = Money_Transfer::where('status', 1)
            ->whereBetween('updated_at', [$from, $to])
            ->count();


        $rows = Money_Transfer::with('advertising')->where('status', 1)
            ->whereBetween('updated_at', [$from, $to])
            ->get();

        $total = 0;
        if ($rows != null) {
            foreach ($rows as $row) {
                $value = $row->money;
                $total = $total + $value;
            }
        }

        $rowData = array();

        $new1 = array();
        $new1['Commissions accept'] = $data1;
        $new1['Commissions Value'] = $total;
        $new1['Bank name'] = '';
        $new1['Name'] = '';
        $new1['Phone'] = '';
        $new1['Email'] = '';
        $new1['Value'] = '';
        $new1['Advertising'] = '';
        array_push($rowData, $new1);

        foreach ($rows as $row) {
            $new1 = array();
            $new1['Commissions accept'] = '';
            $new1['Commissions Value'] = '';
            $new1['Bank name'] = $row->bank_name;
            $new1['Name'] = $row->name;
            $new1['Phone'] = $row->phone;
            $new1['Email'] = $row->email;
            $new1['Value'] = $row->money;
            $new1['Advertising'] = $row->advertising->title;
            array_push($rowData, $new1);
        }

        return Excel::download(new CommissionsExport($rowData), 'Commissions.xlsx');
    }

    public function CategoryReport(Request $request)
    {

        $from = $request->from;
        $to = $request->to;


        $rows = Category::where('parent_id', 0)
            ->whereBetween('updated_at', [$from, $to])
            ->orderBy('counter', 'DESC')
            ->get();


        $pdf = PDF::loadView('back-end.reports.Category',
            compact('rows'));
        return $pdf->download('Category.pdf');
    }


    function CategoryReportExcel(Request $request)
    {
        $from = $request->from;
        $to = $request->to;

        $rows = Category::where('parent_id', 0)
            ->whereBetween('updated_at', [$from, $to])
            ->orderBy('counter', 'DESC')
            ->get();


        $rowData = array();


        foreach ($rows as $row) {
            $new1 = array();
            $new1['Nmae'] = $row -> name;
            $new1['Counter'] = $row -> counter;
            array_push($rowData, $new1);
        }

        return Excel::download(new CategoryExport($rowData), 'Category.xlsx');
    }


}
