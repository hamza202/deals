<?php

namespace App\Http\Controllers\BackEnd\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;
use App\Models\Category;
use Illuminate\Http\Request;

class SubCategoryController extends Controller
{
    public function index($id){
        $sub_categories = Category::with('advertisingSubCategory')
            ->where('parent_id' , $id) -> get();

         $main_category = Category::where('id' ,$id )->first();
        return view('back-end.control-panel.department-details' , compact('sub_categories' ,'main_category'));
    }

    public function store(CategoryRequest $request){
        $page = $request -> page;
        $type= null;
        if ($page == 1 ){
            $type = route('admin.category');;
        }
        try {
            $category = new Category();
            $category->name = $request -> name;
            $category->parent_id = $request -> id;
            $category->save();
            if ($type != null){
                return redirect()->route('admin.category')->with(['success' => 'تم حفظ القسم بنجاح']);
            }
            return redirect()->route('admin.sub_category' ,$request -> id)->with(['success' => 'تم حفظ القسم بنجاح']);
        } catch (\Exception $ex) {
            if ($type != null){
                return redirect()->route('admin.category')->with(['error' => 'هناك خطا ما يرجي المحاوله فيما بعد']);
            }
            return redirect()->route('admin.sub_category' ,$request -> id)->with(['error' => 'هناك خطا ما يرجي المحاوله فيما بعد']);
        }
    }


    public function update(CategoryRequest $request){

        try {
            $category = Category::find($request -> id);
            if (!$category)
                return redirect()->route('admin.sub_category' ,$request -> parent_id)->with(['error' => 'هناك خطأ حاول فى وقت اخر ']);

            // update date

            Category::where('id', $request -> id)
                ->update([
                    'name' => $request->name,
                ]);

            return redirect()->route('admin.sub_category' ,$request -> parent_id)->with(['success' => 'تم تحديث القسم بنجاح']);
        } catch (\Exception $ex) {
            return redirect()->route('admin.sub_category' ,$request -> parent_id)->with(['error' => 'هناك خطا ما يرجي المحاوله فيما بعد']);
        }
    }

}
