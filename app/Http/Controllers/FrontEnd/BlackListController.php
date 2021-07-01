<?php

namespace App\Http\Controllers\FrontEnd;
use App\Http\Controllers\Controller;
use App\Models\Advertiser;
use App\Models\Black_List;
use Illuminate\Http\Request;

class BlackListController extends Controller
{
    public function index(Request $request){

        $black_list = Black_List::with('advertiser') -> selection()
            ->get();

        $rows = null ;
        $result = [];
        if (request()->has('filter')) {
            $filter = request('filter');
            if (!empty($black_list)){
           foreach ($black_list as $list){


               
               if ($list->advertiser->email == $filter || $list->advertiser->name == $filter
                   ||$list->advertiser->phone == $filter){
                   array_push($result ,$list->id);
               }else{
                   $black_list = null;
               }
           }}}
        if ($result !=[]){
            $black_list = Black_List::with('advertiser') -> selection()
                ->whereIn('id',$result)
                ->get();
        }
        return view('front-end.app.black-list' ,compact('black_list' , 'rows'));

    }




}
