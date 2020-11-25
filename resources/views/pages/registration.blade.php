@extends('master')



@section('container')

           <h1>REGISTRATION</h1>

@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

@if(session()->has('message'))
  <div class="alert alert-{{ session('type') }}">
      {{ session('message') }}
  </div>
@endif  

<main role="main" class="container">
  <div class="row">

  <form action="{{ route( 'User.registration' ) }}" method="post" enctype="multipart/form-data">
  @csrf

  <div class="form-group">
    <label for="first_name"> First Name </label>
    <input type="text" class="form-control" name="first_name" value="{{ old('first_name') }}" placeholder="Enter your First name">
  </div>

  <div class="form-group">
    <label for="last_name"> Last Name </label>
    <input type="text" class="form-control" name="last_name" value="{{ old('last_name') }}" placeholder="Enter your last name">
  </div>
  
  <div class="form-group">
    <label for="image">Image</label>
    <input type="file" class="form-control" name="image"  placeholder="upload Image">
  </div>

  <div class="form-group">
    <label for="exampleInputEmail1">Email address</label>
    <input type="email" class="form-control" name="email" value="{{ old('email') }}" placeholder="Enter email">
    <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
  </div>

  <div class="form-group">
    <label for="phone"> Phone </label>
    <input type="text" class="form-control" name="phone" value="{{ old('phone') }}" placeholder="Enter your phone number">
    <small id="phone" class="form-text text-muted">We'll never share your phone number with anyone else.</small>
  </div>

  <div class="form-group">
    <label for="password">Password</label>
    <input type="password" class="form-control" name="password"  placeholder="Password">
  </div>

  <div class="form-group">
    <label for="Confirm_Password">Confirm Password</label>
    <input type="password" class="form-control" name="password_confirmation"  placeholder="Confirm Password">
  </div>
 
  <button type="submit" class="btn btn-primary">Submit</button>
</form>


</div><!-- div row -->

</main>  


@endsection
