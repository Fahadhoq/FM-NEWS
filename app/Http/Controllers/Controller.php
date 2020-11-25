<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function SetSuccessMessage($message){
         session()->flash('message' , $message);
         session()->flash('type' , 'success');
    }
    public function SetErrorMessage($message){
         session()->flash('message' , $message);
         session()->flash('type' , 'danger');
    }

    //for api
    protected function respondWithSuccess($message ='', $data = [], $cade = 200){
         return response()->json([
               'success' => true,
               'message' => $message,
               'data' => $data,
         ], $cade);
    }
    protected function responseWithError($message ='', $data = [], $cade = 400){
         return response()->json([
               'error' => true,
               'message' => $message,
               'data' => $data, 
         ], $cade);
    }
}
