<?php

namespace App\Http\Controllers\FrontEnd;

use App\Http\Controllers\Controller;
use App\Models\Page;
use App\Models\Point;
use Illuminate\Http\Request;

class AmrTidallController extends Controller
{
    public function index(){
        $amrtidall = Page::where('page_name', 'amrtidall') ->selection()->get();
        $points = Point::all();
        return view('front-end.app.amrtidall' , compact('amrtidall','points'));
    }
}
