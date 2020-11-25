@extends('Backend.layout.master')



@section('container')

<h1>Update CATEGORY</h1>

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

  <form action="{{ route( 'category.edit' , $category->id) }}" method="post" >
  @csrf

  <div class="form-group">
    <label for="name"> Category Name </label>
    <input type="text" class="form-control" name="name" value="{{ $category->name }}" placeholder="Enter category name">
  </div>

  <div class="form-group">
  <label for="status"> Status </label>
  <select name="status" class="form-control" >
  <option value="0" @if ($category->status == 0) selected @endif > Inactive</option>
  <option value="1" @if ($category->status == 1) selected @endif > Active</option>
</select>
  </div>
 
  <button type="submit" class="btn btn-primary">Submit</button>
</form>


</div><!-- div row -->

</main>  

@endsection
