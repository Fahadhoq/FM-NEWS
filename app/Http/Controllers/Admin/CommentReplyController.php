<?php

namespace App\Http\Controllers\Admin;

use App\Comment;
use App\CommentReply;
use App\Post;
use Validator;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CommentReplyController extends Controller
{
    //
    public function ReplyCreateProcess(Request $request, $id){

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

            $CommentReply = new CommentReply;

            $CommentReply->comment_id = $id;
            $CommentReply->post_id = $request->P_id;
            $CommentReply->user_id = $user_id;
            $CommentReply->email = $user_email;
            $CommentReply->body = $request->body;

            $CommentReply->save();


            $data['post'] = Post::with('user')->select('id', 'tittle', 'content', 'status' , 'thumbnail_path', 'created_at','category_id', 'user_id', 'slug')
                                  ->where('id', $request->P_id)
                                   ->first();

            $post_id = $data['post']->id;

            $data['comments'] = Comment::with('user' , 'post')
                ->where('post_id' , $post_id)
                ->where('is_active', 1)->paginate(3);

            $data['CommentReplies'] = CommentReply::with('user')->where('is_active', 1)->paginate(3);

            $this->SetSuccessMessage('your Comment Reply is submitted Successfull');

            // return redirect('/Post')->with($data);

            return redirect()->back()->with($data);;

        } catch (Exception $e){

            $this->SetErrorMessage($e->getMessage());

            return redirect()->back();
        }

    }
}
