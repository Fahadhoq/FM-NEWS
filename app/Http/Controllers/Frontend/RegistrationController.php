<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;

use Validator;
use App\User;
use App\Mail\VerificationMail;
use App\Notifications\VerifyMail;


class RegistrationController extends Controller
{
    public function create(Request $request){

        $data = [];
        $data['current_date'] = date('y m d');
        $data['link'] = [
            'fackebook' => 'http://facebook.com',
            'instragram' => 'http://instragram.com',
            'youtube' => 'http://youtube.com',
            'LinkedIn' => 'http://LinkedIn.com'
        ];

        return view('pages.registration' , $data);
    }

    public function createProcess(Request $request){

        $data = [];
        $data['current_date'] = date('y m d');
        $data['link'] = [
            'fackebook' => 'http://facebook.com',
            'instragram' => 'http://instragram.com',
            'youtube' => 'http://youtube.com',
            'LinkedIn' => 'http://LinkedIn.com'
        ];

    //   noarmal validation
    //   $this->validate($request , [
    //      'email' => 'required|email',
    //      'password' => 'required|min:6'
    //   ]);

    // validation and get old value

    $full_name = $request->first_name." ".$request->last_name;
    $user_name = str_slug($full_name);

    $validator = Validator::make($request->all(), [
        'first_name' => 'required',
        'last_name' => 'required',
        'image' => 'required|image|max:10240',
        'email' => 'required|email|unique:users,email',
        'phone' => 'required|min:11|max:11|unique:users,phone',
        'password' => 'required|confirmed|min:5',
    ]);

    if($validator->fails()){
        return redirect()->back()->WithErrors($validator)->WithInput();
    }

    $imageFile = $request->file('image');

    $file_name = uniqid('user_' , true ).str_random(10).'.'.$imageFile->getClientOriginalExtension();
     if($imageFile->isvalid()){
         $imageFile->storeAs('image', $file_name);
     }

    // $user = new User;

    // $user->first_name = $request->first_name;
    // $user->last_name = $request->last_name;
    // $user->full_name = $full_name;
    // $user->user_name = $user_name;
    // $user->image = $request->image;
    // $user->email = strtolower($request->email);
    // $user->phone = $request->phone;
    // $user->password = bcrypt($request->password);

    // $user->save();


    //  $data = [
    //       'first_name' => $request->input('first_name'),
    //       'last_name' => $request->input('last_name'),
    //       'full_name' => $full_name,
    //       'user_name' => $user_name,
    //       'image' => $request->input('image'),
    //       'email' => strtolower($request->input('email')),
    //       'phone' => $request->input('phone'),
    //       'password' => bcrypt($request->input('password')),

    //  ];

     try{
            //  User::create($data);

            $user = new User;

            $user->first_name = $request->first_name;
            $user->last_name = $request->last_name;
            $user->full_name = $full_name;
            $user->user_name = $user_name;
            $user->image = $file_name;
            $user->email = strtolower($request->email);
            $user->phone = $request->phone;
            $user->password = bcrypt($request->password);
            $user->email_verification_token = str_random(32);

            $user->save();

        //use mail verification
        //    Mail::to($user->email)->send(new VerificationMail($user));

        //use mail verification by Queue
        //    Mail::to($user->email)->queue(new VerificationMail($user));
        // run php artisan queue:work
        //to activited queue

        //use mail verification by notification
//            $user->notify(new VerifyMail($user));

            $this->SetSuccessMessage('Registration Successfull');

         return view('pages.login' , $data);

     } catch (Exception $e){

           $this->SetErrorMessage($e->getMessage());

            return redirect()->back();
     }



    // session()->flash('message' , 'Registration Successfull');
    //      session()->flash('type' , 'success');
    //      return redirect()->back();

    }

    public function RegistrationVerify(Request $request, $id){

        if($id == null){
            session()->flash('message' , 'Invalid Token');
            session()->flash('type' , 'danger');
            return redirect('/login');
        }

        $user = User::where('email_verification_token', $id)->first();

        if($user == null){
            session()->flash('message' , 'Invalid User');
            session()->flash('type' , 'danger');
            return redirect('/login');
        }

        $user->update([
           'email_verified' => 1,
           'email_verification_token' => null,
           'email_verified_at' => now(),
        ]);

            session()->flash('message' , 'User Verification Successful');
            session()->flash('type' , 'success');
            return redirect('/login');


    }
}
