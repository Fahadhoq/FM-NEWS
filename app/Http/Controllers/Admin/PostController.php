<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Post;
use App\Category;
use App\User;
use Auth;
use Validator;
use App\Notifications\NewPostNotification;
use Illuminate\Support\Facades\Notification;

class PostController extends Controller
{
    public function index(){

        $data = [];
        $data['current_date'] = date('y m d');
        $data['categories_link'] = Category::select('name','slug')
            ->where('status', 1)
            ->get();

        $data['posts'] = Post::with('user')->select('id','tittle', 'content', 'status' , 'thumbnail_path', 'created_at','category_id', 'user_id', 'slug')
                              ->paginate(5);
//        dd($data['posts']);

        return view('Backend.post.index' , $data);
    }

    public function create(){
        $data = [];
        $data['current_date'] = date('y m d');
        $data['categories_link'] = Category::select('name','slug')
            ->where('status', 1)
            ->get();

        $data['categories'] = Category::select('id','name')
                                        ->where('status', 1)
                                        ->get();

        return view('Backend.post.create' , $data);

    }

    public function createProcess(Request $request){

        $data = [];
        $data['current_date'] = date('y m d');
        $data['categories_link'] = Category::select('name','slug')
            ->where('status', 1)
            ->get();


    $validator = Validator::make($request->all(), [
        'tittle' => 'required',
        'content' => 'required',
        'thumbnail_path' => 'required|image|max:10240',
        'status' => 'required',
        'category_id' => 'required',

    ]);

    if($validator->fails()){
        return redirect()->back()->WithErrors($validator)->WithInput();
    }

    $imageFile = $request->file('thumbnail_path');

    $file_name = uniqid('post_' , true ).str_random(10).'.'.$imageFile->getClientOriginalExtension();
     if($imageFile->isvalid()){
         $imageFile->storeAs('post', $file_name);

     }

     $user_id = auth()->user()->id;


     try{

            $posts = new Post;

            $posts->tittle = $request->tittle;
            $posts->content = $request->content;
            $posts->status = $request->status;
            $posts->thumbnail_path = $file_name;
            $posts->category_id= $request->category_id;
            $posts->user_id = $user_id;

            $posts->save();


            //specific user notification
            $user = User::all();
            Notification::send($user, new NewPostNotification($posts));

            $data['categories'] = Category::select('id','name')
                                            ->where('status', 1)
                                            ->get();

            $this->SetSuccessMessage('Post Create Successfull');

            // return redirect('/Post')->with($data);

            return view('Backend.post.create' , $data);
     } catch (Exception $e){

           $this->SetErrorMessage($e->getMessage());

            return redirect()->back();
     }

    }

    public function edit($slug){

        $data = [];
        $data['current_date'] = date('y m d');
        $data['categories_link'] = Category::select('name','slug')
            ->where('status', 1)
            ->get();

        $data['post'] = Post::select('id', 'tittle', 'content', 'status' , 'thumbnail_path', 'created_at','category_id', 'user_id', 'slug')
                              ->where('slug', $slug)
                              ->first();


        $data['categories'] = Category::select('id','name')
            ->where('status', 1)
            ->get();

        return view('Backend.post.edit' , $data);
    }

    public function editProcess(Request $request, $id)
    {

     $data = [];
     $data['current_date'] = date('y m d');
        $data['categories_link'] = Category::select('name','slug')
            ->where('status', 1)
            ->get();


     $validator = Validator::make($request->all(), [
         'tittle' => 'required',
         'content' => 'required',
         'category_id' => 'required',
         'status' => 'required',
     ]);


    if($request->file('thumbnail_path')){
        $validator_img = Validator::make($request->all(), [
            'thumbnail_path' => 'required|image|max:10240',
        ]);
    }elseif($request->old_pic){
        $validator_img = Validator::make($request->all(), [
            'old_pic' => 'required',
        ]);
    }


     if($validator->fails() || $validator_img->fails()){
         return redirect()->back()->WithErrors($validator , $validator_img)->WithInput();
     }

     if($request->file('thumbnail_path')){

        $imageFile = $request->file('thumbnail_path');

        $file_name = uniqid('post_' , true ).str_random(10).'.'.$imageFile->getClientOriginalExtension();

        if($imageFile->isvalid()){
             $imageFile->storeAs('post', $file_name);

           }
     }


     try{

         $category_id = $request->category_id;
         $user_id = Auth::user()->id;
         $data['post'] = post::find($id);

         $data['post']->update([
             'tittle' => $request->tittle,
             'content' => $request->content,
             'category_id' => $category_id,
             'user_is' => $user_id,
             'status' => $request->status,
         ]);

         if($request->file('thumbnail_path')){
            $data['post']->update([
                'thumbnail_path' => $file_name,
            ]);
         }

         $data['posts'] =  Post::select('id','tittle', 'content', 'status' , 'thumbnail_path', 'created_at')
                           ->paginate(5);

         $this->SetSuccessMessage('Post Edit Successfull');
         return redirect('/Post')->with($data);

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


        $post = Post::find($id);

        unlink('uploads/post'.'/'. $post->thumbnail_path);

        $post->delete();

        $data['posts'] = Post::select('id','tittle', 'content', 'status' , 'thumbnail_path', 'created_at')->paginate(5);


        return redirect('/Post')->with($data);

     }

    public function AllPostShow($user_name){

        $data = [];
        $data['current_date'] = date('y m d');
        $data['categories_link'] = Category::select('name','slug')
            ->where('status', 1)
            ->get();

        $data['user'] = User::with('posts')->where('user_name', $user_name)->first();

        return view('Backend.post.user_all_post_show', $data);
    }

    public function MyAllPostShow($user_name){

        $data = [];
        $data['current_date'] = date('y m d');
        $data['categories_link'] = Category::select('name','slug')
            ->where('status', 1)
            ->get();

        $data['user'] = User::with('posts')->where('user_name', $user_name)->first();

        return view('Backend.post.my_post', $data);
    }

    public function StatusChange(Request $request ,$slug){

        $data = [];
        $data['current_date'] = date('y m d');
        $data['categories_link'] = Category::select('name','slug')
            ->where('status', 1)
            ->get();

        $data['post'] = Post::select('id', 'status', 'slug')
            ->where('slug', $slug)
            ->first();

        try{

            if($data['post']->status == 1){
                $data['post']->update([
                    'status' => 0,
                ]);

            }else{
                $data['post']->update([
                    'status' => 1,
                ]);
            }

            $data['posts'] = Post::with('user')->select('id','tittle', 'content', 'status' , 'thumbnail_path', 'created_at','category_id', 'user_id', 'slug')
                ->paginate(5);
//        dd($data['posts']);

            $this->SetSuccessMessage('Post Status Change Successfull');

            return redirect()->back()->with($data);


        } catch (Exception $e){

            $this->SetErrorMessage($e->getMessage());

            return redirect()->back();
        }

    }
    public function CheckBoxDelete(Request $request){

       $data = [];
       $data['current_date'] = date('y m d');
       $data['categories_link'] = Category::select('name','slug')
                                  ->where('status', 1)
                                  ->get();

       $posts = Post::find($request->CheckBoxArray);

      if($posts != null){

              foreach ($posts as $post){

              unlink('uploads/post'.'/'. $post->thumbnail_path);

              $post->delete();
             }
      }else{

          $this->SetSuccessMessage('Check box not seleted');

          return redirect()->back();

      }


       $data['posts'] = Post::select('id','tittle', 'content', 'status' , 'thumbnail_path', 'created_at')->paginate(5);

       return redirect('/Post')->with($data);

}
}
