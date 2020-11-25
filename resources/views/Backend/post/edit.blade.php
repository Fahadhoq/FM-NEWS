@extends('Backend.layout.master')



@section('container')

    <script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
    <script>tinymce.init({selector:'textarea'});</script>

<h1 >EDIT POST</h1>

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

  <form action="{{ route( 'post.edit' , $post->id ) }}" method="post" enctype="multipart/form-data">
  @csrf

  <div class="form-group">
    <label for="tittle"> Tittle </label>
    <input type="text" class="form-control" name="tittle" value="{{ $post->tittle }}" placeholder="Enter post tittle">
  </div>

  <div class="form-group">
    <label for="categories"> Category </label>
    <select class="form-control select2" id="select2" name="category_id">
            @foreach ($categories as $catagory)

            <option value="{{$catagory->id}}" @if ( $catagory->id == $post->category_id ) selected @endif> {{$catagory->name}} </option>

            @endforeach
            </select>
  </div>

  <div class="form-group">
    <label for="thumbnail_path"> Image </label>
           <img src="{{ url('uploads/post').'/'.$post->thumbnail_path }}" id="view_uploading_img_src"   width="300px" height="100px">
         <input type="hidden" name="old_pic" value="{{ url('uploads/post').'/'.$post->thumbnail_path }}">
       <input type="file" name="thumbnail_path" class="form-control" id="thumbnail_path"  placeholder="upload Image">
  </div>

  <div class="form-group">
   <label for="content" > post content </label>
   <textarea type="text" name="content" id="content" class="form-control"   placeholder="Enter post content">{{$post->content}}</textarea>
  </div>

  <div class="form-group">
  <label for="status"> status </label>
  <select name="status" class="form-control" >
  <option value="0" @if ($post->status == 0) selected @endif >Inactive</option>
  <option value="1" @if ($post->status == 1) selected @endif >Active</option>
</select>
  </div>

   <button type="submit" class="btn btn-primary">Submit</button>

</form>


</div><!-- div row -->

</main>

@endsection


@section('script')

<script>

// image edit show start

            $("#thumbnail_path").change(function () {
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
