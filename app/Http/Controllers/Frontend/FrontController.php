<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Post;
use App\Category;
use App\User;
use App\Comment;
use Auth;

class FrontController extends Controller
{

    public function index(){


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

    public function dashboard(){

        $data = [];

        $data['current_date'] = date('y m d');

        $data['categories_link'] = Category::select('name','slug')
            ->where('status', 1)
            ->get();

        $data['posts'] = Post::select('id', 'tittle', 'content', 'status' , 'thumbnail_path', 'category_id', 'user_id', 'created_at', 'slug')
                              ->where('status', 1)
                              ->paginate(5);  
                           
        return view('Backend.dashboard.dashboard' , $data);
    }

}
