@extends('master')



@section('container')

           <h1>LOGIN</h1>

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

  <form action="{{ route( 'User.login' ) }}" method="post" >
  @csrf


  <div class="form-group">
    <label for="exampleInputEmail1">Email address</label>
    <input type="email" class="form-control" name="email" value="{{ old('email') }}" placeholder="Enter email">
    <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
  </div>


  <div class="form-group">
    <label for="password">Password</label>
    <input type="password" class="form-control" name="password"  placeholder="Password">
  </div>


  <button type="submit" class="btn btn-primary">Submit</button>
</form>


</div><!-- div row -->

</main>


@endsection
