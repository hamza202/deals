<?php

namespace App\Http\Controllers\BackEnd\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;
use App\Models\Advertising;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index(){
        $categories = Category::with('advertising')
            ->where('parent_id' , 0)->paginate(10);
        return view('back-end.control-panel.departments' , compact('categories'));
    }


    public function store(CategoryRequest $request){
        try {
            $category = new Category();
            $category->name = $request -> name;
            $category->parent_id = 0;
            $category->save();
            return redirect()->route('admin.category')->with(['success' => 'تم حفظ القسم بنجاح']);
        } catch (\Exception $ex) {
            return redirect()->route('admin.category')->with(['error' => 'هناك خطا ما يرجي المحاوله فيما بعد']);
        }
    }

    public function update(CategoryRequest $request){
        try {
            $category = Category::find($request -> id);
            if (!$category)
                return redirect()->route('admin.category')->with(['error' => 'هناك خطأ حاول فى وقت اخر ']);

            // update date

            Category::where('id', $request -> id)
                ->update([
                    'name' => $request->name,
                ]);

            return redirect()->route('admin.category')->with(['success' => 'تم تحديث القسم بنجاح']);
        } catch (\Exception $ex) {
            return redirect()->route('admin.category')->with(['error' => 'هناك خطا ما يرجي المحاوله فيما بعد']);
        }
    }

    public function destroy($id)
    {

        try {

            $row=  Category::where('id', $id) -> first();



            //delete advertising && use observer
            $advertising = $row ->advertising ;
            foreach ($advertising as $advertise){
                Advertising::find($advertise -> id)-> delete();
            }

            //delete sub category && use observer
            $subMainCategories=  Category::where('parent_id', $id) -> get();
            foreach ($subMainCategories as $subMainCategory){
                Category::find($subMainCategory -> id)-> delete();
            }

            //delete category
            $delete =  Category::where('id',$id)->delete();
            if($delete) {
                $message = 'success';
            }else {
                $message = 'fail';
            }
            return json_encode($message);

        } catch (\Exception $ex) {
            return redirect()->route('admin.category')->with(['error' => 'هناك خطا ما يرجي المحاوله فيما بعد']);
        }


    }

    public function destroySubCategory($id)
    {

        try {

            $row=  Category::where('id', $id) -> first();

            //delete advertising && use observer
            $advertising = $row ->advertisingSubCategory ;

            foreach ($advertising as $advertise){
                Advertising::find($advertise -> id)-> delete();
            }


            //delete category
            $delete =  Category::where('id',$id)->delete();
            if($delete) {
                $message = 'success';
            }else {
                $message = 'fail';
            }
            return json_encode($message);

        } catch (\Exception $ex) {
            return redirect()->route('admin.category')->with(['error' => 'هناك خطا ما يرجي المحاوله فيما بعد']);
        }


    }

}
