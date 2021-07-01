<?php

namespace App\Http\Controllers\BackEnd\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;
use App\Models\Category;
use App\Models\Questionnaier;
use Illuminate\Http\Request;

class QuestionnaireController extends Controller
{
    /**
     * 27/1/2021 11:46pm by:Mai Ghazal
     *
     * @param $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $data = Questionnaier::first();
        return view('back-end.control-panel.questionnaier', compact('data'));
    }

    public function store(Request $request)
    {
        try {
            $vaildator = $this->validate($request, [
                'url' => 'required'
            ]);

            $data = Questionnaier::first();
            if ($data != null) {
                $data->update([
                    'url' => $request->url
                ]);
                return redirect()->route('admin.questionnaire')->with(['success' => 'تم حفظ الرابط بنجاح']);
            } else {
                $new = new Questionnaier();
                $new->url = $request->url;
                $new->save();
                return redirect()->route('admin.questionnaire')->with(['success' => 'تم حفظ الرابط بنجاح']);
            }
        } catch (\Exception $ex) {
            return redirect()->route('admin.questionnaire')->with(['error' => 'هناك خطا ما يرجي المحاوله فيما بعد']);
        }

    }
}
