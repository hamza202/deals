<?php

namespace App\Http\Controllers\FrontEnd;

use App\Http\Controllers\Controller;
use App\Models\Membership;
use App\Models\Page;
use Illuminate\Http\Request;

class PagesController extends Controller
{
    public function index(){
        $about_us = Page::where('page_name', 'about-us') ->selection()->get();
        return view('front-end.app.about-us' , compact('about_us'));
    }

    public function siteTreaty(){
        $site_treaty = Page::where('page_name', 'site-treaty') ->selection()->get();
        return view('front-end.app.site-treaty' , compact('site_treaty'));
    }

    public function typeMember(){
        $type_member = Membership::selection()->get();
        return view('front-end.app.type-member' , compact('type_member'));
    }

    public function termsConditions(){
        $terms_conditions =  Page::where('page_name', 'terms-conditions') ->selection()->get();
        return view('front-end.app.terms-and-conditions' , compact('terms_conditions'));
    }
}
