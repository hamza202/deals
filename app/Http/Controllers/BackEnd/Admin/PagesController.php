<?php

namespace App\Http\Controllers\BackEnd\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\PageRequest;
use App\Http\Requests\RightesRequest;
use App\Http\Requests\SliderRequest;
use App\Models\Advertiser;
use App\Models\Advertising;
use App\Models\City;
use App\Models\Know_Rights;
use App\Models\KnowUs;
use App\Models\Page;
use App\Models\Slider;
use App\Models\Social;
use Illuminate\Http\Request;

class PagesController extends Controller
{
    public function slider()
    {
        $rows = Slider::all();
        return view('back-end.control-panel.slider', compact('rows'));
    }

    public function storeSliders(SliderRequest $request)
    {
        try {
            $filePath = null;

            if (request()->has('photo')) {
                $filePath = uploadImage('pages', $request->photo);
            }

            $slider = new Slider();
            $slider->description = $request->description;
            $slider->photo = $filePath;

            $slider->save();

            if (request()->has('link')) {
                if ($request->link != null)
                    $slider->update([
                        'link' => $request->link
                    ]);
            }


            return redirect()->route('admin.sliders')->with(['success' => 'تم حفظ السلايدر بنجاح']);

        } catch (\Exception $ex) {
            return redirect()->route('admin.sliders')->with(['error' => 'هناك خطا ما يرجي المحاوله فيما بعد']);
        }

    }

    public function updateSliders(Request $request)
    {

        try {

            $slider = Slider::find($request->id);

            if (empty($slider)) {
                return redirect()->route('admin.sliders')->with(['error' => 'هناك خطا ما يرجي المحاوله لاحقا ']);
            }

            if (request()->has('photo')) {
                $filePath = uploadImage('pages', $request->photo);
                $slider->update([
                    'photo' => $filePath
                ]);
            }

            if (request()->has('description')) {
                if ($request->description != null)
                    $slider->update([
                        'description' => $request->description
                    ]);
            }

            if (request()->has('link')) {
                if ($request->link != null)
                    $slider->update([
                        'link' => $request->link
                    ]);
            }


            return redirect()->route('admin.sliders')->with(['success' => 'تم تحديث السلايدر بنجاح']);

        } catch (\Exception $ex) {
            return redirect()->route('admin.sliders')->with(['error' => 'هناك خطا ما يرجي المحاوله فيما بعد']);
        }

    }


    public function destroySlider($id)
    {

        try {
            $delete = Slider::where('id', $id)->delete();
            if ($delete) {
                $message = 'success';
            } else {
                $message = 'fail';
            }
            return json_encode($message);

        } catch (\Exception $ex) {
            return redirect()->route('admin.sliders')->with(['error' => 'هناك خطا ما يرجي المحاوله فيما بعد']);
        }

    }


    public function pages()
    {
        return view('back-end.control-panel.pages');
    }

    public function aboutUs()
    {
        $title = "من نحن";
        $page_name = "about-us";
        $type = 'admin.pages.about_us';
        $rows = Page::where('page_name', 'about-us')->selection()->get();
        return view('back-end.control-panel.about-us', compact('rows', 'title', 'page_name', 'type'));
    }

    public function knowUs()
    {
        $rows = KnowUs::all();
        return view('back-end.control-panel.Know-us', compact('rows'));
    }

    public function storeKnowUs(Request $request)
    {
        try {
            KnowUs::create($request->except(['_token']));
            return redirect()->route('admin.pages.knowUs')->with(['success' => 'تم الحفظ  بنجاح']);
        } catch (\Exception $ex) {
            return redirect()->route('admin.pages.knowUs')->with(['error' => 'هناك خطا ما يرجي المحاوله فيما بعد']);
        }
    }

    public function updateKnowUs(Request $request)
    {
        try {
            $KnowUs = KnowUs::find($request->id);
            if (!$KnowUs) {
                return redirect()->route('admin.pages.knowUs')->with(['error' => 'هذا الخيار  غير موجود']);
            }

            KnowUs::where('id', $request->id)
                ->update([
                    'name' => $request->name,
                ]);
            return redirect()->route('admin.pages.knowUs')->with(['success' => 'تم تحديث الخيار بنجاح']);

        } catch (\Exception $ex) {
            return redirect()->route('admin.pages.knowUs')->with(['error' => 'هناك خطا ما يرجي المحاوله فيما بعد']);
        }
    }

    public function destroyKnowUs($id)
    {
        try {

            $KnowUs = KnowUs::where('id', $id)->first();


            $advertiser = $KnowUs->advertiser;

            if (count($advertiser) > 0) {
                $message = 'fail';
                return json_encode($message);
            }

            //delete
            $delete = KnowUs::where('id', $id)->delete();
            if ($delete) {
                $message = 'success';
            } else {
                $message = 'fail';
            }
            return json_encode($message);

        } catch (\Exception $ex) {
            return redirect()->route('admin.pages.knowUs')->with(['error' => 'هناك خطا ما يرجي المحاوله فيما بعد']);
        }


    }


    public function siteTreaty()
    {
        $title = " معاهدة الموقع";
        $page_name = "site-treaty";
        $type = 'admin.pages.site_treaty';
        $rows = Page::where('page_name', 'site-treaty')->selection()->get();
        return view('back-end.control-panel.about-us', compact('rows', 'title', 'page_name', 'type'));
    }


    public function social()
    {
        $rows = Social::all();
        return view('back-end.control-panel.social', compact('rows'));
    }

    public function termsConditions()
    {
        $title = "  الاحكام و الشروط ";
        $page_name = "terms-conditions";
        $type = 'admin.pages.terms_conditions';
        $rows = Page::where('page_name', 'terms-conditions')->selection()->get();
        return view('back-end.control-panel.about-us', compact('rows', 'title', 'page_name', 'type'));
    }

    public function amrtidall()
    {
        $title = "   امر تدلل  ";
        $page_name = "amrtidall";
        $type = 'admin.pages.amrtidall';
        $rows = Page::where('page_name', 'amrtidall')->selection()->get();
        return view('back-end.control-panel.about-us', compact('rows', 'title', 'page_name', 'type'));
    }

    public function store(PageRequest $request)
    {
        try {
            Page::create($request->except(['_token', 'type']));
            return redirect()->route($request->type)->with(['success' => 'تم حفظ النص بنجاح']);
        } catch (\Exception $ex) {
            return redirect()->route($request->type)->with(['error' => 'هناك خطا ما يرجي المحاوله فيما بعد']);
        }
    }

    public function update(PageRequest $request)
    {

        try {
            $row = Page::find($request->id);
            if (!$row) {
                return redirect()->route($request->type)->with(['error' => 'هذا النص غير موجود']);
            }

            Page::where('id', $request->id)
                ->update([
                    'content' => $request->content1,
                ]);
            return redirect()->route($request->type)->with(['success' => 'تم تحديث النص بنجاح']);
        } catch (\Exception $ex) {
            return redirect()->route($request->type)->with(['error' => 'هناك خطا ما يرجي المحاوله فيما بعد']);
        }
    }

    public function knowRight()
    {
        $rows = Know_Rights::all();
        return view('back-end.control-panel.know-rights', compact('rows'));
    }

    public function knowRightStore(RightesRequest $request)
    {
        try {

            if ($request->has('photo')) {
                if ($request->photo != null) {
                    $filePath = uploadImage('pages', $request->photo);
                }
            } else {
                $filePath = null;
            }

            $row = new Know_Rights();
            $row->title = $request->title;
            $row->content = $request->content1;
            $row->photo = $filePath;
            $row->save();

            if (!$row) {
                return redirect()->route('admin.pages.know-right')->with(['error' => 'هناك خطأ يرجي المحاوله فيما بعد']);
            }


            return redirect()->route('admin.pages.know-right')->with(['success' => 'تم حفظ الحق بنجاح']);
        } catch (\Exception $ex) {
            return redirect()->route('admin.pages.know-right')->with(['error' => 'هناك خطا ما يرجي المحاوله فيما بعد']);
        }
    }

    public function knowRightUpdate(RightesRequest $request)
    {

        try {
            $row = Know_Rights::find($request->id);
            if (!$row) {
                return redirect()->route('admin.pages.know-right')->with(['error' => 'هذا الحق غير موجود']);
            }

            Know_Rights::where('id', $request->id)
                ->update([
                    'title' => $request->title,
                ]);

            if ($request->content1 != null) {
                Know_Rights::where('id', $request->id)
                    ->update([
                        'content' => $request->content1,
                    ]);


            }

            if ($request->has('photo')) {
                if ($request->photo != null) {
                    $filePath = uploadImage('pages', $request->photo);
                    $row->update([
                        'photo' => $filePath,
                    ]);
                }
            }

            return redirect()->route('admin.pages.know-right')->with(['success' => 'تم تحديث الحق بنجاح']);

        } catch (\Exception $ex) {
            return redirect()->route('admin.pages.know-right')->with(['error' => 'هناك خطا ما يرجي المحاوله فيما بعد']);
        }
    }

    public function destroy($id)
    {

        try {

            $delete = Page::where('id', $id)->delete();
            if ($delete) {
                $message = 'success';
            } else {
                $message = 'fail';
            }
            return json_encode($message);

        } catch (\Exception $ex) {
            return back()->with(['error' => 'هناك خطا ما يرجي المحاوله فيما بعد']);
        }


    }


    public function socialUpdate(Request $request)
    {
        try {
            $row = Social::find($request->id);
            if (!$row) {
                return redirect()->route('admin.pages.social')->with(['error' => 'هذا الرابط غير موجود']);
            }

            Social::where('id', $request->id)
                ->update([
                    'link' => $request->linkRow,
                ]);
            return redirect()->route('admin.pages.social')->with(['success' => 'تم تحديث الرابط بنجاح']);

        } catch (\Exception $ex) {
            return redirect()->route('admin.pages.social')->with(['error' => 'هناك خطا ما يرجي المحاوله فيما بعد']);
        }
    }


}
