@extends('Backend.layout.master')



@section('container')

<h1 >EDIT PROFILE</h1>

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
    <button type="submit" class="btn btn-primary">Change Password</button>
  <div class="row">

      <form action="{{ route( 'User.ProfileEdit' , $user->id ) }}" method="post" enctype="multipart/form-data">
          @csrf

          <div class="form-group">
              <label for="first_name"> First Name </label>
              <input type="text" class="form-control" name="first_name" value="{{ $user->first_name }}" placeholder="Enter your First name">
          </div>

          <div class="form-group">
              <label for="last_name"> Last Name </label>
              <input type="text" class="form-control" name="last_name" value="{{ $user->last_name }}" placeholder="Enter your last name">
          </div>

          <div class="form-group">
              <label for="image"> Image </label>
              <img src="{{ url('uploads/image').'/'.$user->image }}" id="view_uploading_img_src"   width="300px" height="100px">
              <input type="hidden" name="old_pic" value="{{ url('uploads/image').'/'.$user->image }}">
              <input type="file" name="image" class="form-control" id="image"  placeholder="upload Image">
          </div>

          <div class="form-group">
              <label for="exampleInputEmail1">Email address</label>
              <input type="email" class="form-control" name="email" value="{{ $user->email }}" placeholder="Enter email">
              <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
          </div>

          <div class="form-group">
              <label for="phone"> Phone </label>
              <input type="text" class="form-control" name="phone" value="{{ $user->phone }}" placeholder="Enter your phone number">
              <small id="phone" class="form-text text-muted">We'll never share your phone number with anyone else.</small>
          </div>

          <button type="submit" class="btn btn-primary">Submit</button>

      </form>

</div><!-- div row -->

</main>

@endsection


@section('script')

<script>

// image edit show start

            $("#image").change(function () {
                  readImageURL(this);
               });

          function readImageURL(input) {
                if (input.files && input.files[0]) {
                    var reader = new FileReader();
                    reader.onload = function (e) {
                        $('#view_uploading_img_src').attr('src', e.target.result);
                    }

                    reader.readAsDataURL(input.files[0]);
                }
            }

// image edit show start

</script>

@endsection
