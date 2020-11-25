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

    @if(auth()->user()->role_id == 2 || auth()->user()->is_pay != 0)

  <div class="my-3 p-3 bg-white rounded shadow-sm">
    <h6 class="border-bottom border-gray pb-2 mb-0">Recent updates</h6>

    <div class="media text-muted pt-3">
      <p class="media-body pb-3 mb-0 small lh-125 border-bottom border-gray">
      @php  $i=0; @endphp

          @foreach($posts as $post)

              @php $i++; @endphp

              @if($post->user != null && $post->category->status == 1)

       {{$i}}. <img src="{{ url('uploads/image').'/'.@$post->user->image }}" width="30px" height="30px">

       at <small style="color:blue" >{{$post->created_at->diffForHumans()}}</small>

       Post by

        <mark>
            <a href="{{ route('UserAllPostShow', @$post->user->user_name) }}">{{@$post->user->user_name}}</a>
        </mark>

        Post Category
        <mark>
            <a href="{{ route('CategoryAllPostShow', $post->category->slug) }}">{{$post->category->name}}</a>
        </mark>

        @foreach(Auth::user()->unreadnotifications as $notify)
                 @if($notify->data['PostTittle'] == $post->tittle)
                     <small style="color:red" > New Post </small>
                 @endif

                 @php $notify->markAsRead(); @endphp

         @endforeach

       </br>

        <img src="{{ url('uploads/post').'/'.$post->thumbnail_path }}" width="500px" height="100px"> </br>
        <strong class="d-block text-gray-dark"> {{$post->tittle}}</strong>
        <small>{{$post->content}}</small> </br>

        <simple class="d-block text-left mt-3">
            <a href="">LIKE</a>
            <a href="{{ route('comment.index', $post->slug) }}">Comment ({{count($post->comments)}})</a>
        </simple></br> </br>

                      @endif
            @endforeach


      </p>
    </div>
    {{ $posts->links() }}

    <small class="d-block text-right mt-3">
      <a href="#">All updates</a>
    </small>
  </div>

  <div class="my-3 p-3 bg-white rounded shadow-sm">
    <h6 class="border-bottom border-gray pb-2 mb-0">Suggestions</h6>
    
      

    <small class="d-block text-right mt-3">
      <a href="#">All suggestions</a>
    </small>
  </div>
</main>

    @else
        <div class="my-3 p-3 bg-white rounded shadow-sm">
            <h6 class="border-bottom border-gray pb-2 mb-0">Please Pay</h6>

            <div class="media text-muted pt-3">
                <p class="media-body pb-3 mb-0 small lh-125 border-bottom border-gray">

                    <a href="{{ route( 'pay.create' ) }}">Click Here For Paymant</a>

                </p>
            </div>

        </div>
    @endif

@endsection

