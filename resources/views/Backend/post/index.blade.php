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
    <h6 class="border-bottom border-gray pb-2 mb-0">Recent updates</h6>
    <div class="media text-muted pt-3">
      <p class="media-body pb-3 mb-0 small lh-125 border-bottom border-gray">

        <form action="{{ route( 'post.CheckBoxDelete' ) }}" method="post" class="form-inline">
            @csrf

            <div class="form-group">
                <select name="CheckBoxArray" id="" class="form-control" >
                    <option >Delete</option>
                </select>
            </div>

            <button type="submit" class="btn btn-primary">Submit</button>

    <table class="table">
    <thead class="thead-dark">
    <tr>
        <th><input type="checkbox" id="options">Select All</th>
      <th scope="col">Serial</th>
      <th scope="col">Tittle</th>
      <th scope="col">Post By</th>
      <th scope="col">Post Category</th>
      <th scope="col">Image</th>
      <th scope="col">Created At</th>
      <th scope="col">content</th>
       <th scope="col">Comment</th>
      <th scope="col">Status</th>
        @if(auth()->user()->role_id == 2)
      <th scope="col">Action</th>
        @endif

    </tr>
    </thead>
    <tbody>

       @php  $i=0; @endphp
       @foreach($posts as $post)
       @php $i++; @endphp
       @if($post->user != null)


    <tr>
        <th><input type="checkbox"  class="CheckBoxs" name="CheckBoxArray[]" value="{{$post->id}}"></th>
      <th scope="row">{{ $i }}</th>
      <td><strong class="d-block text-gray-dark"> {{$post->tittle}} </strong></td>
      <td>{{$post->user->user_name}}</td>
      <td>{{$post->category->name}}</td>
      <td>
         <img src="{{ url('uploads/post').'/'.$post->thumbnail_path }}" width="100px" height="100px">
      </td>
      <td>{{ $post->created_at }}</td>
      <td>{!!str_limit($post->content , 5)!!}</td>
       <td>
           <a href="{{ route('comment.index', $post->slug) }}">View Comment ({{count($post->comments)}})</a>
       </td>


      <td>
          @if(auth()->user()->role_id == 2)
          <a href="{{ route( 'post.status.change', $post->slug ) }}" class="btn btn-primary"> {{ $post->status == 1 ? 'Active' : 'Inactive'}} </a>
          @else
              {{ $post->status == 1 ? 'Active' : 'Inactive'}}
          @endif
      </td>

        @if(auth()->user()->role_id == 2)
      <td>
            <a href="{{ route( 'post.edit', $post->slug ) }}" class="btn btn-success"> Edit </a>
            <a href="{{ route( 'post.delete', $post->id ) }}" class="btn btn-danger"> delete </a>
      </td>
        @endif

    </tr>


            @endif
    @endforeach
</table>

        </form>

</div>
{{ $posts->links() }}

    <small class="d-block text-right mt-3">
      <a href="#">All updates</a>
    </small>
  </div>

  <div class="my-3 p-3 bg-white rounded shadow-sm">
    <h6 class="border-bottom border-gray pb-2 mb-0">Suggestions</h6>
    <div class="media text-muted pt-3">
      <svg class="bd-placeholder-img mr-2 rounded" width="32" height="32" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="xMidYMid slice" focusable="false" role="img" aria-label="Placeholder: 32x32"><title>Placeholder</title><rect width="100%" height="100%" fill="#007bff"/><text x="50%" y="50%" fill="#007bff" dy=".3em">32x32</text></svg>
      <div class="media-body pb-3 mb-0 small lh-125 border-bottom border-gray">
        <div class="d-flex justify-content-between align-items-center w-100">
          <strong class="text-gray-dark">Full Name</strong>
          <a href="#">Follow</a>
        </div>
        <span class="d-block">@username</span>
      </div>
    </div>
    <div class="media text-muted pt-3">
      <svg class="bd-placeholder-img mr-2 rounded" width="32" height="32" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="xMidYMid slice" focusable="false" role="img" aria-label="Placeholder: 32x32"><title>Placeholder</title><rect width="100%" height="100%" fill="#007bff"/><text x="50%" y="50%" fill="#007bff" dy=".3em">32x32</text></svg>
      <div class="media-body pb-3 mb-0 small lh-125 border-bottom border-gray">
        <div class="d-flex justify-content-between align-items-center w-100">
          <strong class="text-gray-dark">Full Name</strong>
          <a href="#">Follow</a>
        </div>
        <span class="d-block">@username</span>
      </div>
    </div>
    <div class="media text-muted pt-3">
      <svg class="bd-placeholder-img mr-2 rounded" width="32" height="32" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="xMidYMid slice" focusable="false" role="img" aria-label="Placeholder: 32x32"><title>Placeholder</title><rect width="100%" height="100%" fill="#007bff"/><text x="50%" y="50%" fill="#007bff" dy=".3em">32x32</text></svg>
      <div class="media-body pb-3 mb-0 small lh-125 border-bottom border-gray">
        <div class="d-flex justify-content-between align-items-center w-100">
          <strong class="text-gray-dark">Full Name</strong>
          <a href="#">Follow</a>
        </div>
        <span class="d-block">@username</span>
      </div>
    </div>
    <small class="d-block text-right mt-3">
      <a href="#">All suggestions</a>
    </small>
  </div>
</main>


@endsection

@section('script')
    <script>
        $('#options').click(function () {

            if(this.checked){
               $('.CheckBoxs').each(function () {

                   this.checked = true;
               });
            }else{
                $('.CheckBoxs').each(function () {

                    this.checked = false;
                });
            }

        });

    </script>
@endsection
