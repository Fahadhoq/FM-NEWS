<?php

namespace App\Http\Controllers\User;

use App\Category;
use App\User;
use Validator;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    public function index(){

        $data = [];
        $data['current_date'] = date('y m d');
        $data['categories_link'] = Category::select('name','slug')
            ->where('status', 1)
            ->get();

        $data['users'] = User::select('id','first_name', 'last_name', 'full_name' , 'user_name', 'image','email', 'phone', 'role_id', 'active')
                              ->paginate(5);

        return view('Backend.user.AllUser' , $data);
    }

    public function delete(Request $request, $user_name){
        $data = [];
        $data['current_date'] = date('y m d');
        $data['categories_link'] = Category::select('name','slug')
            ->where('status', 1)
            ->get();


        $user = User::where('user_name' , $user_name)->first();

        //remove image from folder
        unlink('uploads/image'.'/'. $user->image);

        $user->delete();

        $data['users'] = User::select('id','first_name', 'last_name', 'full_name' , 'user_name', 'image','email', 'phone', 'role_id', 'active')
                               ->paginate(5);

        return redirect('/User')->with($data);

    }


    public function UserProfile(Request $request, $user_name){
        $data = [];
        $data['current_date'] = date('y m d');
        $data['categories_link'] = Category::select('name','slug')
            ->where('status', 1)
            ->get();

        $data['users'] = User::select('id','first_name', 'last_name', 'full_name' , 'user_name', 'image','email', 'phone', 'role_id', 'active')
                               ->where('user_name' , $user_name )
                               ->paginate(5);

        return view('Backend.user.UserProfile', $data);

    }

    public function ProfileEdit($user_name){

        $data = [];
        $data['current_date'] = date('y m d');
        $data['categories_link'] = Category::select('name','slug')
            ->where('status', 1)
            ->get();


        $data['user'] = User::select('id','first_name', 'last_name', 'full_name' , 'user_name', 'image','email', 'phone', 'role_id', 'active')
            ->where('user_name' , $user_name )
            ->first();

        return view('Backend.user.ProfileEdit' , $data);
    }

    public function ProfileEditProcess(Request $request , $id){

        $data = [];
        $data['current_date'] = date('y m d');
        $data['categories_link'] = Category::select('name','slug')
            ->where('status', 1)
            ->get();
//dd($request->old_pic);

        // validation and get old value

        $validator = Validator::make($request->all(), [
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|email|unique:users,email,'.$id,
            'phone' => 'required|min:11|max:11|unique:users,phone,'.$id,

        ]);

        $full_name = $request->first_name." ".$request->last_name;
        $user_name = str_slug($full_name);

        if($request->file('image')){
            $validator_img = Validator::make($request->all(), [
                'image' => 'required|image|max:10240',
            ]);
        }elseif($request->old_pic){
            $validator_img = Validator::make($request->all(), [
                'old_pic' => 'required|unique:users,image,'.$id,
            ]);

        }


        if($validator->fails() || $validator_img->fails() ){
            return redirect()->back()->WithErrors($validator )->WithInput();
        }

        if($request->file('image')){

            $imageFile = $request->file('image');

            $file_name = uniqid('user_' , true ).str_random(10).'.'.$imageFile->getClientOriginalExtension();

            if($imageFile->isvalid()){
                $imageFile->storeAs('image', $file_name);

            }
        }


        try{

            $data['user'] = User::find($id);

            $data['user']->update([
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'full_name' => $full_name,
                'user_name' => $user_name,
                'email' => strtolower($request->email),
                'phone' => $request->phone,
            ]);

            if($request->file('image')){
                $data['user']->update([
                    'image' => $file_name,
                ]);
            }

            $this->SetSuccessMessage('Profile Edit Successfull');

            $data['users'] = User::select('id','first_name', 'last_name', 'full_name' , 'user_name', 'image','email', 'phone', 'role_id', 'active')
                ->where('id' , $id )
                ->paginate(5);

            return view('Backend.user.UserProfile', $data);

        } catch (Exception $e){

            $this->SetErrorMessage($e->getMessage());

            return redirect()->back();
        }

    }

    public function RoleChange(Request $request ,$user_name){

        $data = [];
        $data['current_date'] = date('y m d');
        $data['categories_link'] = Category::select('name','slug')
            ->where('status', 1)
            ->get();


        $data['user'] = User::select('id', 'role_id')
            ->where('user_name' , $user_name )
            ->first();


        try{

            if($data['user']->role_id == 1){
                $data['user']->update([
                    'role_id' => "2",
                ]);

            }else{
                $data['user']->update([
                    'role_id' => "1",
                ]);

            }

            $data['users'] = User::select('id','first_name', 'last_name', 'full_name' , 'user_name', 'image','email', 'phone', 'role_id', 'active')
                ->paginate(5);

            $this->SetSuccessMessage('User Role Change Successfull');

            return redirect()->back()->with($data);


        } catch (Exception $e){

            $this->SetErrorMessage($e->getMessage());

            return redirect()->back();
        }

    }

    public function StatusChange(Request $request ,$user_name){

        $data = [];
        $data['current_date'] = date('y m d');
        $data['categories_link'] = Category::select('name','slug')
            ->where('status', 1)
            ->get();


        $data['user'] = User::select('id', 'active')
            ->where('user_name' , $user_name )
            ->first();


        try{

            if($data['user']->active == 1){
                $data['user']->update([
                    'active' => 0,
                ]);

            }else{
                $data['user']->update([
                    'active' => 1,
                ]);

            }

            $data['users'] = User::select('id','first_name', 'last_name', 'full_name' , 'user_name', 'image','email', 'phone', 'role_id', 'active')
                ->paginate(5);

            $this->SetSuccessMessage('User Status Change Successfull');

            return redirect()->back()->with($data);


        } catch (Exception $e){

            $this->SetErrorMessage($e->getMessage());

            return redirect()->back();
        }

    }



}
