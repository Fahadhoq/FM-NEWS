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

    <table class="table">
    <thead class="thead-dark">
    <tr>
      <th scope="col">Serial</th>
      <th scope="col">user name</th>
      <th scope="col">image</th>
      <th scope="col">role</th>
      <th scope="col">Status</th>
      <th scope="col">Action</th>

    </tr>
    </thead>
    <tbody>

       @php  $i=0; @endphp
       @foreach($users as $user)
       @php $i++; @endphp
    <tr>
      <th scope="row">{{ $i }}</th>
      <td><strong class="d-block text-gray-dark"> {{$user->user_name}} </strong></td>
      <td>
         <img src="{{ url('uploads/image').'/'.$user->image }}" width="100px" height="100px">
      </td>
        <td>
            <a href="{{ route( 'user.role.change', $user->user_name ) }}" class="btn btn-primary"> {{ $user->Role->name }} </a>
        </td>

        <td>
            <a href="{{ route( 'user.status.change', $user->user_name ) }}" class="btn btn-primary"> {{ $user->active == 1 ? 'Active' : 'Inactive'}} </a>
        </td>
      <td>
            <a href="{{ route('User.Profile' , $user->user_name) }}" class="btn btn-success"> View </a>
            <a href="{{ route('User.delete' , $user->user_name) }}" class="btn btn-danger"> delete </a>
      </td>

    </tr>
    @endforeach
</table>

</div>
{{ $users->links() }}

  </div>
</main>


@endsection

