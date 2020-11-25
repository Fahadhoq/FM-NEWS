<?php

namespace App\Http\Controllers\Admin;

use App\Category;
use App\Comment;
use App\CommentReply;
use App\Post;
use App\User;
use Validator;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CommentController extends Controller
{
    //

    public function index($slug){

        $data = [];
        $data['current_date'] = date('y m d');
        $data['categories_link'] = Category::select('name','slug')
            ->where('status', 1)
            ->get();

        $data['post'] = Post::with('user')->select('id', 'tittle', 'content', 'status' , 'thumbnail_path', 'created_at','category_id', 'user_id', 'slug')
                              ->where('slug', $slug)
                              ->first();

        $post_id = $data['post']->id;

        $data['comments'] = Comment::with('user' , 'post')
                                    ->where('post_id' , $post_id)
                                    ->where('is_active', 1)->paginate(3);

        return view('Backend.comments.index', $data);
    }

    public function CommentCreateProcess(Request $request, $slug){
        $data = [];
        $data['current_date'] = date('y m d');
        $data['categories_link'] = Category::select('name','slug')
            ->where('status', 1)
            ->get();

        $validator = Validator::make($request->all(), [
            'body' => 'required',
        ]);

        if($validator->fails()){
            return redirect()->back()->WithErrors($validator)->WithInput();
        }

        $user_email = auth()->user()->email;
        $user_id = auth()->user()->id;


        try{

            $Comment = new Comment;

            $Comment->post_id = $request->id;
            $Comment->user_id = $user_id;
            $Comment->email = $user_email;
            $Comment->body = $request->body;

            $Comment->save();



            $data['post'] = Post::with('user')->select('id', 'tittle', 'content', 'status' , 'thumbnail_path', 'created_at','category_id', 'user_id', 'slug')
                ->where('slug', $slug)
                ->first();

            $post_id = $data['post']->id;

            $data['comments'] = Comment::with('user' , 'post')
                ->where('post_id' , $post_id)
                ->where('is_active', 1)->paginate(3);

            $data['CommentReplies'] = CommentReply::with('user')->where('is_active', 1)->paginate(3);


            $this->SetSuccessMessage('your Comment is submitted Successfull');

            // return redirect('/Post')->with($data);

                 return redirect()->back()->with($data);

        } catch (Exception $e){

            $this->SetErrorMessage($e->getMessage());

            return redirect()->back();
        }

    }

    public function CommentEdit($id){

        $data = [];
        $data['current_date'] = date('y m d');
        $data['categories_link'] = Category::select('name','slug')
            ->where('status', 1)
            ->get();

        $data['comment'] = Comment::with('user' , 'post')
            ->where('id' , $id)
            ->where('is_active', 1)->get();


        return view('Backend.comments.edit' , $data);
    }

    public function CommentEditProcess(Request $request, $id){

        $data = [];
        $data['current_date'] = date('y m d');
        $data['categories_link'] = Category::select('name','slug')
            ->where('status', 1)
            ->get();

        $validator = Validator::make($request->all(), [
            'body' => 'required',
        ]);

        if($validator->fails()){
            return redirect()->back()->WithErrors($validator)->WithInput();
        }

        try{

            $data['comment'] = Comment::find($id);

            $data['comment']->update([
                'body' => $request->body,

            ]);

            $slug = $request->post_slug;

            $data['post'] = Post::with('user')->select('id', 'tittle', 'content', 'status' , 'thumbnail_path', 'created_at','category_id', 'user_id', 'slug')
                ->where('slug', $slug)
                ->first();

            $post_id = $data['post']->id;

            $data['comments'] = Comment::with('user' , 'post')
                ->where('post_id' , $post_id)
                ->where('is_active', 1)->paginate(3);

            $data['CommentReplies'] = CommentReply::with('user')->where('is_active', 1)->paginate(3);


            $this->SetSuccessMessage('your Comment is edited Successfull');

            // return redirect('/Post')->with($data);

            return redirect('/Comment/'.$slug)->with($data);

        } catch (Exception $e){

            $this->SetErrorMessage($e->getMessage());

            return redirect()->back();
        }

    }

    public function CommentDelete(Request $request, $id){
        $data = [];
        $data['current_date'] = date('y m d');
        $data['categories_link'] = Category::select('name','slug')
            ->where('status', 1)
            ->get();

        $comment = Comment::find($id);
        $comment->delete();


        $slug = $comment->post->slug;

        $data['post'] = Post::with('user')->select('id', 'tittle', 'content', 'status' , 'thumbnail_path', 'created_at','category_id', 'user_id', 'slug')
            ->where('slug', $slug)
            ->first();

        $post_id = $data['post']->id;

        $data['comments'] = Comment::with('user' , 'post')
            ->where('post_id' , $post_id)
            ->where('is_active', 1)->paginate(3);

        $data['CommentReplies'] = CommentReply::with('user')->where('is_active', 1)->paginate(3);


        $this->SetSuccessMessage('your Comment is deleted Successfull');

        // return redirect('/Post')->with($data);

        return redirect('/Comment/'.$slug)->with($data);

    }
}
