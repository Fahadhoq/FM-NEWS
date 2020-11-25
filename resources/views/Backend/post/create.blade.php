@extends('Backend.layout.master')



@section('container')

    <script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
    <script>tinymce.init({selector:'textarea'});</script>

<h1>ADD POST</h1>

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

  <form action="{{ route( 'post.create' ) }}" method="post" enctype="multipart/form-data">
  @csrf

  <div class="form-group">
    <label for="tittle"> Tittle </label>
    <input type="text" class="form-control" name="tittle" value="{{ old('tittle') }}" placeholder="Enter post tittle">
  </div>

  <div class="form-group">
    <label for="categories"> Category </label>
    <select class="form-control select2" id="select2" name="category_id">
            @foreach ($categories as $catagory)

            <option value="{{$catagory->id}}"> {{$catagory->name}} </option>

            @endforeach
            </select>
  </div>

  <div class="form-group">
    <label for="thumbnail_path"> Image </label>
    <input type="file" class="form-control" name="thumbnail_path"  placeholder="upload Image">
  </div>

  <div class="form-group">
   <label for="content" > post content </label>
   <textarea type="text" name="content" id="content" class="form-control" placeholder="Enter post content"></textarea>
  </div>

  <div class="form-group">
  <label for="status"> status </label>
  <select name="status" class="form-control" >
  <option value="0">Inactive</option>
  <option value="1">Active</option>
</select>
  </div>

   <button type="submit" class="btn btn-primary">Submit</button>

</form>


</div><!-- div row -->

</main>

@endsection
