@extends('Backend.layout.master')


@section('container')

    <main role="main" class="container">

        <div class="my-3 p-3 bg-white rounded shadow-sm">
            <h6 class="border-bottom border-gray pb-2 mb-0">View Post</h6>

            {{--            //view post start--}}
            <div class="my-3 p-3 bg-white rounded shadow-sm">

                <p class="media-body pb-3 mb-0 small lh-125 border-bottom border-gray">

                    @foreach($comment as $comment)

                    <img src="{{ url('uploads/image').'/'.$comment->user->image }}" width="30px" height="30px">

                    @endforeach

                    Post by
                    <mark>
                        <a href="">{{$comment->user->user_name}}</a>
                    </mark>

                    Post Category
                    <mark>
                        <a href=""></a>
                    </mark>
                    </br>

                <h6 class="border-bottom border-gray pb-2 mb-0"></h6>

                <img src="{{ url('uploads/post').'/'.$comment->post->thumbnail_path }}" width="500px" height="100px"> </br>
                <strong class="d-block text-gray-dark"> {{$comment->post->tittle}}</strong>
                <small>{{$comment->post->content}}</small> </br>

                </p>

            </div>
            {{--            view post end--}}


            {{--            like comment start--}}
            <div class="my-2 p-2 bg-white rounded shadow-sm">

                <small class="d-block text-left mt-1">
                    <a href="#">Like</a>
                    <a href="#">Comment ({{count($comment->post->comments)}})</a>
                </small>
            </div>
            {{--            like comment end--}}




            {{--         comment create start--}}
            <div class="my-3 p-3 bg-white rounded shadow-sm">

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


                <form action="{{ route( 'comment.edit' , $comment->id ) }}" method="post" >
                    @csrf

                    <div class="form-group">
                        <label for="body" >
                            <small class="d-block text-left mt-3">
                                <a href="">Edit your comment </a>
                            </small>
                        </label>
                        <textarea type="text" name="body" id="body" class="form-control" placeholder="Edit your comment">{{$comment->body}}</textarea>
                    </div>

                    <input type="hidden" name="id" value="{{ $comment->post->id }}">
                    <input type="hidden" name="post_slug" value="{{ $comment->post->slug }}">

                    <button type="submit" class="btn btn-primary">Comment</button>

                </form>

            </div>
            {{--         comment create end--}}


        </div>
    </main>


@endsection

