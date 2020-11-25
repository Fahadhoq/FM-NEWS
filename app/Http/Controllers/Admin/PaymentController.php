<?php

namespace App\Http\Controllers\Admin;

use App\Category;
use App\Payment;
use App\PaymentCategory;
use App\User;
use App\Post;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Validator;

class PaymentController extends Controller
{
    //
    public function create(Request $request){

        $data = [];
        $data['current_date'] = date('y m d');
        $data['categories_link'] = Category::select('name','slug')
            ->where('status', 1)
            ->get();


        $data['paymentcategories'] = PaymentCategory::select('id','name' , 'amount' ,'slug')
            ->where('status', 1)
            ->get();

        $data['PaymentUsers'] = User::select('id','full_name')
            ->where('active', 1)
            ->get();

        return view('Backend.payment.create' , $data);
    }

    public function createProcess(Request $request){

        $data = [];
        $data['current_date'] = date('y m d');
        $data['categories_link'] = Category::select('name','slug')
            ->where('status', 1)
            ->get();

        $validator = Validator::make($request->all(), [
            'user_id' => 'required',
            'payment_category_id' => 'required',
        ]);

        if($validator->fails()){
            return redirect()->back()->WithErrors($validator)->WithInput();
        }

        try{

            $Payment = new Payment;

            $Payment->user_id = $request->user_id;
            $Payment->payment_category_id = $request->payment_category_id;

            $Payment->save();


            $data['user'] = User::select('is_pay')->where('id', $request->user_id)->first();

            $data['user']->update([
                'is_pay' => 1,
            ]);


//            $data['paymentcategories'] = PaymentCategory::select('id','name' , 'amount' ,'slug')
//                ->where('status', 1)
//                ->get();
//
//            $data['PaymentUsers'] = User::select('id','full_name')
//                ->where('active', 1)
//                ->get();

            $data['posts'] = cache('articles', function(){
                return Post::select('id', 'tittle', 'content', 'status' , 'thumbnail_path', 'category_id', 'user_id', 'created_at', 'slug')
                    ->where('status' , 1)
                    ->paginate(5);
            });


            $this->SetSuccessMessage('Payment Pay Successfull');

            return view('Backend.dashboard.dashboard' , $data);

            // return redirect('/Post')->with($data);

        } catch (Exception $e){

            $this->SetErrorMessage($e->getMessage());

            return redirect()->back();
        }

    }

}
