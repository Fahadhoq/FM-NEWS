<?php

namespace App\Http\Controllers\api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;

class UserController extends Controller
{
    public function index(){
        return response()->json([
            'sussess' => true,
            'message' => 'show all users',
            'data' => [
                User::all()
            ]
        ]);
    }
}
