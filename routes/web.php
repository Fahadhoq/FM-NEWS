<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//group routting
// route::group(['prefix' => 'admin'] , function(){
//     route::get('/' , 'NormalController@index');
//     route::get('/show' , 'NormalController@show');
//     route::get('/registration' , 'NormalController@create')->name('registration');
//     route::post('/registration' , 'NormalController@createProcess');

// });


// // route::get('/front' , 'Frontend\FrontController@index'); or
// route::group(['namespace' => 'Frontend'] , function(){
//     route::get('/front' , 'FrontController@index')->name('frontend.index');
// });
// // route::get('/back' , 'Backend\BackController@index'); or
// route::group(['namespace' => 'Backend'] , function(){
//     route::get('/back' , 'BackController@index')->name('backend.index');
// });

// group name routting and namespace
// route::name('frontend.')->namespace('Frontend')->group(function(){
//     route::get('/front' , 'FrontController@index')->name('index');
// });
// route::name('backend.')->namespace('Backend')->group(function(){
//     route::get('/back' , 'BackController@index')->name('index');
// });

//normal route
// route::get('/' , 'NormalController@index');
// route::get('/show' , 'NormalController@show')->name('show');
// route::get('/registration' , 'NormalController@create')->name('registration');
// route::post('/registration' , 'NormalController@createProcess');
// route::get('/login' , 'NormalController@login')->name('login');
// route::post('/login' , 'NormalController@loginProcess');

//fm news route
route::group(['namespace' => 'Frontend'] , function(){
        route::get('/' , 'FrontController@index')->name('index');
        route::get('/registration' , 'RegistrationController@create')->name('User.registration');
        route::post('/registration' , 'RegistrationController@createProcess');
        route::get('/registration/verify/{token}' , 'RegistrationController@RegistrationVerify')->name('RegistrationVerify');
        route::get('/login' , 'LoginController@login')->name('User.login');
        route::post('/login' , 'LoginController@loginProcess');
        route::get('/logout' , 'LoginController@logout')->name('User.logout');
    });



    Route::group(['middleware' => 'UserAuth'], function () {
        route::get('/dashboard' , 'Frontend\FrontController@dashboard')->name('dashboard');
    });

    route::middleware('UserAuth')->namespace('user')->group(function(){
        route::get('/User' , 'UserController@index')->name('User.AllUSer');
        route::get('/User/delete/{user_name}' , 'UserController@delete')->name('User.delete');
        route::get('/User/Profile/{user_name}' , 'UserController@UserProfile')->name('User.Profile');
        route::get('/User/ProfileEdit/{user_name}' , 'UserController@ProfileEdit')->name('User.ProfileEdit');
        route::post('/User/ProfileEdit/{user_name}' , 'UserController@ProfileEditProcess');
        route::get('/User/StatusChange/{user_name}' , 'UserController@StatusChange')->name('user.status.change');
        route::get('/User/RoleChange/{user_name}' , 'UserController@RoleChange')->name('user.role.change');

    });

    route::middleware('UserAuth')->namespace('admin')->group(function(){
        route::get('/Category' , 'CategoryController@index')->name('Category.index');
        route::get('/Category/create' , 'CategoryController@create')->name('category.create');
        route::post('/Category/create' , 'CategoryController@createProcess');
        route::get('/Category/edit/{slug}' , 'CategoryController@edit')->name('category.edit');
        route::post('/Category/edit/{id}' , 'CategoryController@editProcess');
        route::get('/Category/delete/{id}' , 'CategoryController@delete')->name('category.delete');
        route::get('/Category/StatusChange/{slug}' , 'CategoryController@StatusChange')->name('category.status.change');

        route::get('/Category/All_Post_Show/{slug}' , 'CategoryController@AllPostShow')->name('CategoryAllPostShow');
    });

    route::middleware('UserAuth')->namespace('admin')->group(function(){
        route::get('/Post' , 'PostController@index')->name('post.index');
        route::get('/Post/create' , 'PostController@create')->name('post.create');
        route::post('/Post/create' , 'PostController@createProcess');
        route::get('/Post/edit/{slug}' , 'PostController@edit')->name('post.edit');
        route::post('/Post/edit/{id}' , 'PostController@editProcess');
        route::get('/Post/delete/{id}' , 'PostController@delete')->name('post.delete');
        route::post('/Post/delete' , 'PostController@CheckBoxDelete')->name('post.CheckBoxDelete');
        route::get('/Post/StatusChange/{slug}' , 'PostController@StatusChange')->name('post.status.change');

        route::get('/Post/All_Post_Show/{user_name}' , 'PostController@AllPostShow')->name('UserAllPostShow');
        route::get('/Post/My_All_Post_Show/{user_name}' , 'PostController@MyAllPostShow')->name('post.MyAllPostShow');



        route::get('/Comment/{slug}' , 'CommentController@index')->name('comment.index');
        route::post('/Comment/create/{slug}' , 'CommentController@CommentCreateProcess')->name('comment.create');
        route::post('/CommentReply/create/{id}' , 'CommentReplyController@ReplyCreateProcess')->name('commentReply.create');

        route::get('/comment/edit/{id}' , 'CommentController@CommentEdit')->name('comment.edit');
        route::post('/comment/edit/{id}' , 'CommentController@CommentEditProcess');
        route::get('/comment/delete/{id}' , 'CommentController@CommentDelete')->name('comment.delete');

        //not implememt yet
        route::get('/CommentReply/edit/{id}' , 'CommentReplyController@edit')->name('commentReply.edit');
        route::post('/CommentReply/edit/{id}' , 'CommentReplyController@editProcess');
        route::get('/CommentReply/delete/{id}' , 'CommentReplyController@delete')->name('commentReply.delete');


    });

    route::middleware('UserAuth')->namespace('admin')->group(function(){

        route::get('/Payment/Category' , 'PaymentCategoryController@index')->name('Payment.Category.index');
        route::get('/Payment/Category/create' , 'PaymentCategoryController@create')->name('payment.category.create');
        route::post('/Payment/Category/create' , 'PaymentCategoryController@createProcess');
        route::get('/Payment/Category/edit/{slug}' , 'PaymentCategoryController@edit')->name('payment.category.edit');
        route::post('/Payment/Category/edit/{id}' , 'PaymentCategoryController@editProcess');
        route::get('/Payment/Category/delete/{id}' , 'PaymentCategoryController@delete')->name('payment.category.delete');
        route::get('/Payment/Category/StatusChange/{slug}' , 'PaymentCategoryController@StatusChange')->name('payment.category.status.change');

    });

    route::middleware('UserAuth')->namespace('admin')->group(function(){

        route::get('/Payment/Pay' , 'PaymentController@create')->name('pay.create');
        route::post('/Payment/Pay' , 'PaymentController@createProcess');

    });
