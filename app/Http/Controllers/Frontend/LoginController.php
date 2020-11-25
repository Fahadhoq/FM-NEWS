<?php

namespace App\Http\Controllers\Frontend;

use App\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Post;
use App\User;
use App\Comment;


use Validator;

class LoginController extends Controller
{
    public function login(){

        $data = [];
        $data['current_date'] = date('y m d');
        $data['link'] = [
            'fackebook' => 'http://facebook.com',
            'instragram' => 'http://instragram.com',
            'youtube' => 'http://youtube.com',
            'LinkedIn' => 'http://LinkedIn.com'
        ];
         return view('pages.login' , $data);

    }

    public function loginProcess(Request $request){
        $data = [];
        $data['current_date'] = date('y m d');

        $data['categories_link'] = Category::select('name','slug')
            ->where('status', 1)
            ->get();

        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required|min:5',
        ]);

        $credentials = $request->except(['_token']);

        if (auth()->attempt($credentials)){

            $user = auth()->user();

            if($user->email_verified == 0){
                session()->flash('message' , 'User not verified yet. Please complet your mail verification');
                session()->flash('type' , 'danger');
                auth()->logout();

                return redirect('/login');
            }

               $data['posts'] = cache('articles', function(){
                     return Post::select('id', 'tittle', 'content', 'status' , 'thumbnail_path', 'category_id', 'user_id', 'created_at', 'slug')
                                  ->where('status' , 1)
                                  ->paginate(5);
               });
 

            return view('Backend.dashboard.dashboard' , $data);
        }

        $this->SetErrorMessage('invalid credentials');

        return redirect()->back();
    }

    public function logout(){

        auth()->logout();

        $data = [];
        $data['current_date'] = date('y m d');
        $data['link'] = [
            'fackebook' => 'http://facebook.com',
            'instragram' => 'http://instragram.com',
            'youtube' => 'http://youtube.com',
            'LinkedIn' => 'http://LinkedIn.com'
        ];

        $data['AllPosts'] = Post::count();
        $data['category'] = Category::count();
        $data['user'] = User::count();
        $data['comment'] = Comment::count();

        return view('pages.index' , $data);
    }
}
