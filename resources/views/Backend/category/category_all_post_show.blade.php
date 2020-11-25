@extends('Backend.layout.master')



@section('container')

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

  <div class="my-3 p-3 bg-white rounded shadow-sm">
    <h6 class="border-bottom border-gray pb-2 mb-0">Category Name: {{$categories->name}}</h6>

    <div class="media text-muted pt-3">
      <p class="media-body pb-3 mb-0 small lh-125 border-bottom border-gray">
      @php  $i=0; @endphp
       @foreach($categories->posts as $post)
       @php $i++; @endphp

       {{$i}}. <img src="{{ url('uploads/image').'/'.@$post->user->image }}" width="30px" height="30px">


              Post by
              @if(@$post->user->user_name != null)
                  <mark>
                      <a href="{{ route('UserAllPostShow', @$post->user->user_name) }}">{{@$post->user->user_name}}</a>
                  </mark>
              @else
                  <mark>
                      <a href="">{{@$post->user->user_name}}</a>
                  </mark>
              @endif

        Post Category
        <mark>
            <a href="{{ route('CategoryAllPostShow', $post->category->slug) }}">{{$categories->name}}</a>
        </mark>
       </br>

        <img src="{{ url('uploads/post').'/'.$post->thumbnail_path }}" width="500px" height="100px"> </br>
        <strong class="d-block text-gray-dark"> {{$post->tittle}}</strong>
        <small>{{$post->content}}</small> </br>

       @endforeach
      </p>
    </div>


    <small class="d-block text-right mt-3">
      <a href="#">All updates</a>
    </small>
  </div>

</main>


@endsection

