<?php

namespace App\Http\Controllers\BackEnd\Moderator;

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

    public function knowUs()
    {
        $rows = KnowUs::all();
        return view('back-end.moderator-panel.Know-us', compact('rows'));
    }

    public function storeKnowUs(Request $request)
    {
        try {
            KnowUs::create($request->except(['_token']));
            return redirect()->route('moderator.pages.knowUs')->with(['success' => 'تم الحفظ  بنجاح']);
        } catch (\Exception $ex) {
            return redirect()->route('moderator.pages.knowUs')->with(['error' => 'هناك خطا ما يرجي المحاوله فيما بعد']);
        }
    }

    public function updateKnowUs(Request $request)
    {
        try {
            $KnowUs = KnowUs::find($request->id);
            if (!$KnowUs) {
                return redirect()->route('moderator.pages.knowUs')->with(['error' => 'هذا الخيار  غير موجود']);
            }

            KnowUs::where('id', $request->id)
                ->update([
                    'name' => $request->name,
                ]);
            return redirect()->route('moderator.pages.knowUs')->with(['success' => 'تم تحديث الخيار بنجاح']);

        } catch (\Exception $ex) {
            return redirect()->route('moderator.pages.knowUs')->with(['error' => 'هناك خطا ما يرجي المحاوله فيما بعد']);
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
            return redirect()->route('moderator.pages.knowUs')->with(['error' => 'هناك خطا ما يرجي المحاوله فيما بعد']);
        }


    }

    public function slider()
    {
        $check = $this->checkRole(50);
        if ($check == false) {
            return view('back-end.moderator-panel.notRole');
        }
        $rows = Slider::all();
        return view('back-end.moderator-panel.slider', compact('rows'));
    }

    public function storeSliders(SliderRequest $request)
    {
        $check = $this->checkRole(51);
        if ($check == false) {
            return view('back-end.moderator-panel.notRole');
        }
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

            return redirect()->route('moderator.sliders')->with(['success' => 'تم حفظ السلايدر بنجاح']);

        } catch (\Exception $ex) {
            return redirect()->route('moderator.sliders')->with(['error' => 'هناك خطا ما يرجي المحاوله فيما بعد']);
        }

    }

    public function updateSliders(Request $request)
    {
        $check = $this->checkRole(52);
        if ($check == false) {
            return view('back-end.moderator-panel.notRole');
        }
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


            return redirect()->route('moderator.sliders')->with(['success' => 'تم تحديث السلايدر بنجاح']);

        } catch (\Exception $ex) {
            return redirect()->route('moderator.sliders')->with(['error' => 'هناك خطا ما يرجي المحاوله فيما بعد']);
        }

    }


    public function destroySlider($id)
    {
        $check = $this->checkRole(53);
        if ($check == false) {
            return view('back-end.moderator-panel.notRole');
        }
        try {
            $delete = Slider::where('id', $id)->delete();
            if ($delete) {
                $message = 'success';
            } else {
                $message = 'fail';
            }
            return json_encode($message);

        } catch (\Exception $ex) {
            return redirect()->route('moderator.sliders')->with(['error' => 'هناك خطا ما يرجي المحاوله فيما بعد']);
        }

    }

    public function pages()
    {
        $check = $this->checkRole(54);
        if ($check == false) {
            return view('back-end.moderator-panel.notRole');
        }
        return view('back-end.moderator-panel.pages');
    }

    public function aboutUs()
    {
        $check = $this->checkRole(55);
        if ($check == false) {
            return view('back-end.moderator-panel.notRole');
        }
        $title = "من نحن";
        $page_name = "about-us";
        $type = 'moderator.pages.about_us';
        $rows = Page::where('page_name', 'about-us')->selection()->get();
        return view('back-end.moderator-panel.about-us', compact('rows', 'title', 'page_name', 'type'));
    }

    public function siteTreaty()
    {
        $check = $this->checkRole(56);
        if ($check == false) {
            return view('back-end.moderator-panel.notRole');
        }
        $title = " معاهدة الموقع";
        $page_name = "site-treaty";
        $type = 'moderator.pages.site_treaty';
        $rows = Page::where('page_name', 'site-treaty')->selection()->get();
        return view('back-end.moderator-panel.about-us', compact('rows', 'title', 'page_name', 'type'));
    }


    public function social()
    {
        $check = $this->checkRole(58);
        if ($check == false) {
            return view('back-end.moderator-panel.notRole');
        }
        $rows = Social::all();
        return view('back-end.moderator-panel.social', compact('rows'));
    }

    public function termsConditions()
    {
        $check = $this->checkRole(57);
        if ($check == false) {
            return view('back-end.moderator-panel.notRole');
        }
        $title = "  الاحكام و الشروط ";
        $page_name = "terms-conditions";
        $type = 'moderator.pages.terms_conditions';
        $rows = Page::where('page_name', 'terms-conditions')->selection()->get();
        return view('back-end.moderator-panel.about-us', compact('rows', 'title', 'page_name', 'type'));
    }

    public function amrtidall()
    {
        $check = $this->checkRole(92);
        if ($check == false) {
            return view('back-end.moderator-panel.notRole');
        }
        $title = "   امر تدلل  ";
        $page_name = "amrtidall";
        $type = 'moderator.pages.amrtidall';
        $rows = Page::where('page_name', 'amrtidall')->selection()->get();
        return view('back-end.moderator-panel.about-us', compact('rows', 'title', 'page_name', 'type'));
    }

    public function store(PageRequest $request)
    {
        $check = $this->checkRole(60);
        if ($check == false) {
            return view('back-end.moderator-panel.notRole');
        }
        try {
            Page::create($request->except(['_token', 'type']));
            return redirect()->route($request->type)->with(['success' => 'تم حفظ النص بنجاح']);
        } catch (\Exception $ex) {
            return redirect()->route($request->type)->with(['error' => 'هناك خطا ما يرجي المحاوله فيما بعد']);
        }
    }

    public function update(PageRequest $request)
    {
        $check = $this->checkRole(61);
        if ($check == false) {
            return view('back-end.moderator-panel.notRole');
        }

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
        $check = $this->checkRole(62);
        if ($check == false) {
            return view('back-end.moderator-panel.notRole');
        }
        $rows = Know_Rights::all();
        return view('back-end.moderator-panel.know-rights', compact('rows'));
    }

    public function knowRightStore(RightesRequest $request)
    {

        $check = $this->checkRole(63);
        if ($check == false) {
            return view('back-end.moderator-panel.notRole');
        }
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
                return redirect()->route('moderator.pages.know-right')->with(['error' => 'هناك خطأ يرجي المحاوله فيما بعد']);
            }


            return redirect()->route('moderator.pages.know-right')->with(['success' => 'تم حفظ الحق بنجاح']);
        } catch (\Exception $ex) {
            return redirect()->route('moderator.pages.know-right')->with(['error' => 'هناك خطا ما يرجي المحاوله فيما بعد']);
        }
    }

    public function knowRightUpdate(RightesRequest $request)
    {
        $check = $this->checkRole(64);
        if ($check == false) {
            return view('back-end.moderator-panel.notRole');
        }

        try {
            $row = Know_Rights::find($request->id);
            if (!$row) {
                return redirect()->route('moderator.pages.know-right')->with(['error' => 'هذا الحق غير موجود']);
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

            return redirect()->route('moderator.pages.know-right')->with(['success' => 'تم تحديث الحق بنجاح']);

        } catch (\Exception $ex) {
            return redirect()->route('moderator.pages.know-right')->with(['error' => 'هناك خطا ما يرجي المحاوله فيما بعد']);
        }
    }

    public function destroy($id)
    {
        $check = $this->checkRole(20);
        if ($check == false) {
            return view('back-end.moderator-panel.notRole');
        }

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
        $check = $this->checkRole(59);
        if ($check == false) {
            return view('back-end.moderator-panel.notRole');
        }
        try {
            $row = Social::find($request->id);
            if (!$row) {
                return redirect()->route('moderator.pages.social')->with(['error' => 'هذا الرابط غير موجود']);
            }

            Social::where('id', $request->id)
                ->update([
                    'link' => $request->linkRow,
                ]);
            return redirect()->route('moderator.pages.social')->with(['success' => 'تم تحديث الرابط بنجاح']);

        } catch (\Exception $ex) {
            return redirect()->route('moderator.pages.social')->with(['error' => 'هناك خطا ما يرجي المحاوله فيما بعد']);
        }
    }


}
