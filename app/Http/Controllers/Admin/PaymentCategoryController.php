<?php

namespace App\Http\Controllers\Admin;

use App\Category;
use App\PaymentCategory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Validator;

class PaymentCategoryController extends Controller
{
    //
    public function index(){
        $data = [];
        $data['current_date'] = date('y m d');
        $data['categories_link'] = Category::select('name' , 'slug')
            ->where('status', 1)
            ->get();

        $data['PaymentCategories'] = PaymentCategory::select('id','name', 'amount', 'status', 'slug')->paginate(2);

        return view('Backend.payment.PaymentCategory.index' , $data);
    }

    public function create()
    {
        $data = [];
        $data['current_date'] = date('y m d');
        $data['categories_link'] = Category::select('name','slug')
            ->where('status', 1)
            ->get();

        return view('Backend.payment.PaymentCategory.create' , $data);
    }

    public function createProcess(Request $request)
    {
        $data = [];
        $data['current_date'] = date('y m d');
        $data['categories_link'] = Category::select('name','slug')
            ->where('status', 1)
            ->get();

        $validator = Validator::make($request->all(), [
            'name' => 'required|unique:payment_categories,name',
            'status' => 'required',
            'amount' => 'required',
        ]);


        if($validator->fails()){
            return redirect()->back()->WithErrors($validator)->WithInput();
        }

        try{

            $PaymentCategory = new PaymentCategory;

            $PaymentCategory->name = $request->name;
            $PaymentCategory->amount = $request->amount;
            $PaymentCategory->slug = str_slug($request->name);
            $PaymentCategory->status = $request->status;

            $PaymentCategory->save();

            $data['PaymentCategories'] = PaymentCategory::select('id','name', 'amount', 'status', 'slug')->paginate(2);

            $this->SetSuccessMessage('Category Create Successfull');

            return view('Backend.payment.PaymentCategory.index' , $data);

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

        $data['PaymentCategories'] = PaymentCategory::select('id','name', 'slug', 'status', 'amount')
            ->where('slug', $slug)
            ->first();

        return view('Backend.payment.PaymentCategory.edit' , $data);

    }

    public function editProcess(Request $request, $id)
    {

        $data = [];
        $data['current_date'] = date('y m d');
        $data['categories_link'] = Category::select('name','slug')
            ->where('status', 1)
            ->get();


        $validator = Validator::make($request->all(), [
            'name' => 'required|unique:payment_categories,name,'.$id,
            'status' => 'required',
            'amount' => 'required',
        ]);

        if($validator->fails()){
            return redirect()->back()->WithErrors($validator)->WithInput();
        }

        try{

            $data['PaymentCategories'] = PaymentCategory::find($id);

            $data['PaymentCategories']->update([
                'name' => $request->name,
                'slug' => str_slug($request->name),
                'status' => $request->status,
                'amount' => $request->amount,
            ]);
            // $category = Category::find($id);

            // $category->name = $request->name;
            // $category->slug = str_slug($request->name);
            // $category->status = $request->status;

            // $category->save();

            $data['PaymentCategories'] = PaymentCategory::select('id','name', 'amount', 'status', 'slug')->paginate(2);

            $this->SetSuccessMessage('Payment Category Edit Successfull');

            return view('Backend.payment.PaymentCategory.index' , $data);

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


        $PaymentCategory = PaymentCategory::find($id);
        $PaymentCategory->delete();

        $data['PaymentCategories'] = PaymentCategory::select('id','name', 'amount', 'status', 'slug')->paginate(2);

        $this->SetSuccessMessage('Payment Category Deleted Successfull');

        return view('Backend.payment.PaymentCategory.index' , $data);

    }

    public function StatusChange(Request $request ,$slug){

        $data = [];
        $data['current_date'] = date('y m d');
        $data['categories_link'] = Category::select('name','slug')
            ->where('status', 1)
            ->get();

        $data['PaymentCategories'] = PaymentCategory::select('id', 'status', 'slug')
            ->where('slug', $slug)
            ->first();

        try{

            if($data['PaymentCategories']->status == 1){
                $data['PaymentCategories']->update([
                    'status' => 0,
                ]);

            }else{
                $data['PaymentCategories']->update([
                    'status' => 1,
                ]);
            }

            $data['PaymentCategories'] = PaymentCategory::select('id','name', 'slug', 'status', 'amount')->paginate(2);

            $this->SetSuccessMessage('Category Status Change Successfull');

            return redirect()->back()->with($data);

        } catch (Exception $e){

            $this->SetErrorMessage($e->getMessage());

            return redirect()->back();
        }

    }

}
