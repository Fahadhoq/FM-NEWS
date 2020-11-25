<?php

namespace App\Http\Controllers\api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Post;
use Validator;

class LoginController extends Controller
{
    public function index(Request $request){

        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required|min:5',
        ]);

        $credentials = $request->except(['_token']);

        if (auth()->attempt($credentials)){

            $user = auth()->user();

            if($user->email_verified == 0){
                return response()->json([
                    'sussess' => true,
                    'message' => 'User not verified yet. Please complet your mail verification',
                ]);
            }

            //calling respondWithSuccess property from controller
            $data = Post::select('tittle', 'content', 'status' , 'thumbnail_path', 'category_id', 'user_id', 'created_at')
                              ->where('status', 1)->get();

            return $this->respondWithSuccess('User Logged in', $data); // code in controller

            //normal send data
            // return response()->json([
            //     'sussess' => true,
            //     'message' => 'User Logged in',
            //     'data' => [
            //         $posts = Post::select('tittle', 'content', 'status' , 'thumbnail_path', 'category_id', 'user_id', 'created_at')
            //          ->where('status', 1)->get(),
            //     ]
            // ]);
        }

        return response()->json([
            'Error' => true,
            'message' => 'invalid crddentials',
        ]);
    }

}
