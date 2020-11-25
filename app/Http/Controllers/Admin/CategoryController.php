<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Category;
use App\Post;
use Validator;

class CategoryController extends Controller
{
    public function index(){
        $data = [];
        $data['current_date'] = date('y m d');
        $data['categories_link'] = Category::select('name' , 'slug')
            ->where('status', 1)
            ->get();

        $data['categories'] = Category::select('id','name', 'slug', 'status')->paginate(2);

         return view('Backend.category.index' , $data);
    }

    public function create()
    {
        $data = [];
        $data['current_date'] = date('y m d');
        $data['categories_link'] = Category::select('name','slug')
            ->where('status', 1)
            ->get();

        return view('Backend.category.create' , $data);
    }

    public function createProcess(Request $request)
    {
        $data = [];
        $data['current_date'] = date('y m d');
        $data['categories_link'] = Category::select('name','slug')
            ->where('status', 1)
            ->get();

    $validator = Validator::make($request->all(), [
        'name' => 'required|unique:categories,name',
        'status' => 'required',
    ]);


    if($validator->fails()){
        return redirect()->back()->WithErrors($validator)->WithInput();
    }

    try{

        $Category = new Category;

        $Category->name = $request->name;
        $Category->slug = str_slug($request->name);
        $Category->status = $request->status;

        $Category->save();

        $data['categories'] = Category::select('id','name', 'slug', 'status')->paginate(2);

        $this->SetSuccessMessage('Category Create Successfull');

     return view('Backend.category.index' , $data);
    } catch (Exception $e){

       $this->SetErrorMessage($e->getMessage());

        return redirect()->back();
     }

 }

 public function edit(Request $request , $slug){
    $data = [];
    $data['current_date'] = date('y m d');
     $data['categories_link'] = Category::select('name','slug')
         ->where('status', 1)
         ->get();

    $data['category'] = Category::select('id','name', 'slug', 'status')
                                  ->where('slug', $slug)
                                  ->first();

    return view('Backend.category.edit' , $data);

 }

   public function editProcess(Request $request, $id)
   {

    $data = [];
    $data['current_date'] = date('y m d');
       $data['categories_link'] = Category::select('name','slug')
           ->where('status', 1)
           ->get();


    $validator = Validator::make($request->all(), [
        'name' => 'required|unique:categories,name,'.$id,
        'status' => 'required',
    ]);

    if($validator->fails()){
        return redirect()->back()->WithErrors($validator)->WithInput();
    }

    try{

        $data['category'] = Category::find($id);

        $data['category']->update([
            'name' => $request->name,
            'slug' => str_slug($request->name),
            'status' => $request->status,
        ]);
        // $category = Category::find($id);

        // $category->name = $request->name;
        // $category->slug = str_slug($request->name);
        // $category->status = $request->status;

        // $category->save();


        $this->SetSuccessMessage('Category Edit Successfull');

     return view('Backend.category.edit' , $data);
    } catch (Exception $e){

       $this->SetErrorMessage($e->getMessage());

        return redirect()->back();
     }

   }

   public function delete(Request $request, $id){

    $data = [];
    $data['current_date'] = date('y m d');
       $data['categories_link'] = Category::select('name','slug')
           ->where('status', 1)
           ->get();


    $category = Category::find($id);
    $category->delete();

    $data['categories'] = Category::select('id','name', 'slug', 'status')->paginate(2);


    return view('Backend.category.index' , $data);

 }

 public function AllPostShow($slug){

    $data = [];
    $data['current_date'] = date('y m d');
     $data['categories_link'] = Category::select('name','slug')
         ->where('status', 1)
         ->get();

    $data['categories'] = Category::with('posts')->select('id','name', 'slug', 'status')
                                    ->where('slug', $slug)
                                    ->first();


                 return view('Backend.category.category_all_post_show', $data);
      }


    public function StatusChange(Request $request ,$slug){

        $data = [];
        $data['current_date'] = date('y m d');
        $data['categories_link'] = Category::select('name','slug')
            ->where('status', 1)
            ->get();

        $data['category'] = Category::select('id', 'status', 'slug')
                                     ->where('slug', $slug)
                                     ->first();

        try{

            if($data['category']->status == 1){
                $data['category']->update([
                    'status' => 0,
                ]);

            }else{
                $data['category']->update([
                    'status' => 1,
                ]);
            }

            $data['categories'] = Category::select('id','name', 'slug', 'status')->paginate(2);

                 $this->SetSuccessMessage('Category Status Change Successfull');

            return redirect()->back()->with($data);

        } catch (Exception $e){

            $this->SetErrorMessage($e->getMessage());

            return redirect()->back();
        }

    }
}
