@extends('Backend.layout.master')

@section('css')

             {{--    public/css/comment/index.css--}}
    <link rel="stylesheet" href="{{ asset('css/comment/index.css') }}">

@endsection


@section('container')

<main role="main" class="container">

        <div class="my-3 p-3 bg-white rounded shadow-sm">
            <h6 class="border-bottom border-gray pb-2 mb-0">View Post</h6>

{{--            //view post start--}}
            <div class="my-3 p-3 bg-white rounded shadow-sm">

                <p class="media-body pb-3 mb-0 small lh-125 border-bottom border-gray">

                    <img src="{{ url('uploads/image').'/'.$post->user->image }}" width="30px" height="30px">

                    Post by
                    <mark>
                        <a href="">{{$post->user->user_name}}</a>
                    </mark>

                    Post Category
                    <mark>
                        <a href="">{{$post->category->name}}</a>
                    </mark>
                    </br>

                    <h6 class="border-bottom border-gray pb-2 mb-0"></h6>

                    <img src="{{ url('uploads/post').'/'.$post->thumbnail_path }}" width="500px" height="100px"> </br>
                    <strong class="d-block text-gray-dark"> {{$post->tittle}}</strong>
                    <small>{{$post->content}}</small> </br>

                </p>

            </div>
{{--            view post end--}}

{{--            like comment start--}}
            <div class="my-2 p-2 bg-white rounded shadow-sm">

                <small class="d-block text-left mt-1">
                    <a href="#">Like</a>
                    <a href="#">Comment ({{count($post->comments)}})</a>
                </small>
            </div>
{{--            like comment end--}}

{{--        view comment start--}}

                @if($comments != null)

                       @php  $i=0; @endphp

                @foreach($comments as $comment)

                        @php $i++; @endphp
                    <div class="my-2 p-2 bg-white rounded shadow-sm">

                        <p class="media-body pb-3 mb-0 small lh-125 border-bottom border-gray">

                    @if($comment->post_id == $post->id)


                 <br/> {{$i}} .  <img src="{{ url('uploads/image').'/'.$comment->user->image }}" width="30px" height="30px">

                    Comment by
                    <mark>
                        <a href="">{{$comment->user->user_name}}</a>
                    </mark>
                            @if(auth()->user() == $comment->user)
                                <small>
                                <a href="{{ route( 'comment.edit', $comment->id ) }}" class="btn btn-success"> Edit </a>
                                <a href="{{ route( 'comment.delete', $comment->id ) }}" class="btn btn-danger"> delete </a>
                                </small>
                            @endif
                     </br>

                    <small>{{$comment->body}}</small>
                     </br>

                    {{--        view comment reply start--}}
                    <div class="my-1 p-1 bg-white rounded shadow-sm">

                        <small class="d-block text-left mt-1">
                            <a href="#">Like</a>
                            <button id="CommentReply{{$comment->id}}" onclick="chk_comment_reply({{$comment->id}})"  class="btn btn-primary">Comment Reply ({{count($comment->replies)}})</button>
                        </small>

                        <h6 class="border-bottom border-gray pb-2 mb-0"></h6>

{{--                         view reply start--}}
                        <div id="CommentReplyView{{$comment->id}}"  class="CommentReplyView my-1 p-1 bg-white rounded shadow-sm">

                        @if($comment->replies != null)

                            @php  $i=0; @endphp

                            @foreach($comment->replies as $CommentReply)

                                @php $i++; @endphp

                                <br/> {{$i}} .  <img src="{{ url('uploads/image').'/'.$CommentReply->user->image }}" width="30px" height="30px">

                                Comment by
                                <mark>
                                    <a href="">{{$CommentReply->user->user_name}}</a>
                                </mark>

                                    @if(auth()->user() == $comment->user)
                                    <small>
                                        <a href="{{ route( 'commentReply.edit', $CommentReply->id ) }}" class="btn btn-success"> Edit </a>
                                        <a href="{{ route( 'commentReply.delete', $CommentReply->id ) }}" class="btn btn-danger"> delete </a>
                                    </small>
                                    @endif

                                </br>

                                <small>{{$CommentReply->body}}</small> </br>

                                <h6 class="border-bottom border-gray pb-2 mb-0"></h6>


                            @endforeach

                        @endif

                        </div>
{{--                        view reply end--}}


                     </div>
{{--           view comment reply end--}}


            {{--         comment reply create start--}}
            <div id="ReplyCreate{{$comment->id}}" class="ReplyCreate my-1 p-1 bg-white rounded shadow-sm">

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


                <form action="{{ route( 'commentReply.create' , $comment->id ) }}" method="post" >
                    @csrf

                    <div class="form-group">
                        <label for="body" >
                            <small class="d-block text-left mt-1">
                                <a href="">Enter your comment if any</a>
                            </small>
                        </label>
                        <textarea type="text" name="body" id="body" class="form-control" placeholder="Enter your comment if any"></textarea>
                    </div>

                    <input type="hidden" name="P_id" value="{{ $post->id }}">

                    <button type="submit" class="btn btn-primary">Comment Reply</button>

                </form>

            </div>
            {{--         comment reply create end--}}

            </p>

        </div>
            {{--           view comment end--}}

                  @endif
                @endforeach
            @endif

{{--         comment pagination--}}
            {{ $comments->links() }}


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


                <form action="{{ route( 'comment.create' , $post->slug ) }}" method="post" >
                    @csrf

                    <div class="form-group">
                        <label for="body" >
                            <small class="d-block text-left mt-3">
                                <a href="">Enter your comment if any</a>
                            </small>
                        </label>
                        <textarea type="text" name="body" id="body" class="form-control" placeholder="Enter your comment if any"></textarea>
                    </div>

                    <input type="hidden" name="id" value="{{ $post->id }}">

                    <button type="submit" class="btn btn-primary">Comment</button>

                </form>

            </div>
            {{--         comment create end--}}


        </div>
    </main>


@endsection

@section('script')

    <script src="//ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <script>
        function chk_comment_reply(id) {

                $("#CommentReplyView"+id).toggle();
                $("#ReplyCreate"+id).toggle();

        }

    </script>
@endsection
