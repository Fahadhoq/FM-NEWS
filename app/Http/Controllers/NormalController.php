<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use App\User;

class NormalController extends Controller
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
         return view('pages.index' , $data);
        
    }

    public function show(){

        $data = [];
        $data['current_date'] = date('y m d');
        $data['link'] = [
            'fackebook' => 'http://facebook.com',
            'instragram' => 'http://instragram.com',
            'youtube' => 'http://youtube.com',
            'LinkedIn' => 'http://LinkedIn.com'
        ];
        $data['post'] =[
           
            'tittle' => 'Sample blog post',

            'created_at' => 'January 1, 2014 by',
           
           'discription' => ' <p>This blog post shows a few different types of content that’s supported and styled with Bootstrap. Basic typography, images, and code are all supported.</p>
           <hr>
           <p>Cum sociis natoque penatibus et magnis <a href="#">dis parturient montes</a>, nascetur ridiculus mus. Aenean eu leo quam. Pellentesque ornare sem lacinia quam venenatis vestibulum. Sed posuere consectetur est at lobortis. Cras mattis consectetur purus sit amet fermentum.</p>
           <blockquote>
             <p>Curabitur blandit tempus porttitor. <strong>Nullam quis risus eget urna mollis</strong> ornare vel eu leo. Nullam id dolor id nibh ultricies vehicula ut id elit.</p>
           </blockquote>
           <p>Etiam porta <em>sem malesuada magna</em> mollis euismod. Cras mattis consectetur purus sit amet fermentum. Aenean lacinia bibendum nulla sed consectetur.</p>
           <h2>Heading</h2>
           <p>Vivamus sagittis lacus vel augue laoreet rutrum faucibus dolor auctor. Duis mollis, est non commodo luctus, nisi erat porttitor ligula, eget lacinia odio sem nec elit. Morbi leo risus, porta ac consectetur ac, vestibulum at eros.</p>
           <h3>Sub-heading</h3>
           <p>Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus.</p>
           <pre><code>Example code block</code></pre>
           <p>Aenean lacinia bibendum nulla sed consectetur. Etiam porta sem malesuada magna mollis euismod. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa.</p>
           <h3>Sub-heading</h3>
           <p>Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Aenean lacinia bibendum nulla sed consectetur. Etiam porta sem malesuada magna mollis euismod. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus.</p>
           <ul>
             <li>Praesent commodo cursus magna, vel scelerisque nisl consectetur et.</li>
             <li>Donec id elit non mi porta gravida at eget metus.</li>
             <li>Nulla vitae elit libero, a pharetra augue.</li>
           </ul>
           <p>Donec ullamcorper nulla non metus auctor fringilla. Nulla vitae elit libero, a pharetra augue.</p>
           <ol>
             <li>Vestibulum id ligula porta felis euismod semper.</li>
             <li>Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus.</li>
             <li>Maecenas sed diam eget risus varius blandit sit amet non magna.</li>
           </ol>
           <p>Cras mattis consectetur purus sit amet fermentum. Sed posuere consectetur est at lobortis.</p>'
        ];
        
        
        return view('pages.ShowPost' , $data);
    }

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

    $image = $request->file('image');
     $file_name = uniqid('image_' , true ).str_random(10).'.'.$image->getClientOriginalExtension();

     if($image->isvalid()){
         $image->storeAs('image', $file_name);
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
            $user->image = $request->image;
            $user->email = strtolower($request->email);
            $user->phone = $request->phone;
            $user->password = bcrypt($request->password);

            $user->save();

         session()->flash('message' , 'Registration Successfull');
         session()->flash('type' , 'success');
         return view('pages.login' , $data);
     } catch (Exception $e){
        session()->flash('message' , $e->getMessage());
        session()->flash('type' , 'danger');
        return redirect()->back();
     }
    
    // session()->flash('message' , 'Registration Successfull');
    //      session()->flash('type' , 'success');
    //      return redirect()->back();
    
    }

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
        $data['link'] = [
            'fackebook' => 'http://facebook.com',
            'instragram' => 'http://instragram.com',
            'youtube' => 'http://youtube.com',
            'LinkedIn' => 'http://LinkedIn.com'
        ];

        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required|min:5',
        ]);
        
        $credentials = $request->except(['_token']);

        if (auth()->attempt($credentials)){
            $data['post'] =[
           
                'tittle' => 'Sample blog post',
    
                'created_at' => 'January 1, 2014 by',
               
               'discription' => ' <p>This blog post shows a few different types of content that’s supported and styled with Bootstrap. Basic typography, images, and code are all supported.</p>
               <hr>
               <p>Cum sociis natoque penatibus et magnis <a href="#">dis parturient montes</a>, nascetur ridiculus mus. Aenean eu leo quam. Pellentesque ornare sem lacinia quam venenatis vestibulum. Sed posuere consectetur est at lobortis. Cras mattis consectetur purus sit amet fermentum.</p>
               <blockquote>
                 <p>Curabitur blandit tempus porttitor. <strong>Nullam quis risus eget urna mollis</strong> ornare vel eu leo. Nullam id dolor id nibh ultricies vehicula ut id elit.</p>
               </blockquote>
               <p>Etiam porta <em>sem malesuada magna</em> mollis euismod. Cras mattis consectetur purus sit amet fermentum. Aenean lacinia bibendum nulla sed consectetur.</p>
               <h2>Heading</h2>
               <p>Vivamus sagittis lacus vel augue laoreet rutrum faucibus dolor auctor. Duis mollis, est non commodo luctus, nisi erat porttitor ligula, eget lacinia odio sem nec elit. Morbi leo risus, porta ac consectetur ac, vestibulum at eros.</p>
               <h3>Sub-heading</h3>
               <p>Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus.</p>
               <pre><code>Example code block</code></pre>
               <p>Aenean lacinia bibendum nulla sed consectetur. Etiam porta sem malesuada magna mollis euismod. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa.</p>
               <h3>Sub-heading</h3>
               <p>Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Aenean lacinia bibendum nulla sed consectetur. Etiam porta sem malesuada magna mollis euismod. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus.</p>
               <ul>
                 <li>Praesent commodo cursus magna, vel scelerisque nisl consectetur et.</li>
                 <li>Donec id elit non mi porta gravida at eget metus.</li>
                 <li>Nulla vitae elit libero, a pharetra augue.</li>
               </ul>
               <p>Donec ullamcorper nulla non metus auctor fringilla. Nulla vitae elit libero, a pharetra augue.</p>
               <ol>
                 <li>Vestibulum id ligula porta felis euismod semper.</li>
                 <li>Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus.</li>
                 <li>Maecenas sed diam eget risus varius blandit sit amet non magna.</li>
               </ol>
               <p>Cras mattis consectetur purus sit amet fermentum. Sed posuere consectetur est at lobortis.</p>'
            ];
            return view('pages.ShowPost' , $data);
        }

        session()->flash('message' , 'invalid crddentials');
        session()->flash('type' , 'danger');
        
        return redirect()->back();
    }
}
