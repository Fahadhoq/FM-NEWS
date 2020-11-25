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
    <h6 class="border-bottom border-gray pb-2 mb-0">User Profile
      @foreach($users as $user)
      <a href="{{ route('User.ProfileEdit' , $user->user_name) }}" class="btn btn-success"> Edit </a>
      <a href="{{ route('User.delete' , $user->user_name) }}" class="btn btn-danger"> delete </a>
      @endforeach
    </h6>
    <div class="media text-muted pt-3">
        @foreach($users as $user)
           <img src="{{ url('uploads/image').'/'.$user->image }}" width="100px" height="100px">
           <div>
               <h6>User Name : {{$user->user_name}}</h6>
               <h6>First Name : {{$user->first_name}}</h6>
               <h6>Last Name : {{$user->last_name}}</h6>
               <h6>Full Name : {{$user->full_name}}</h6>

           </div>
        @endforeach
    </div>

      <div class="media text-muted pt-3">
          @foreach($users as $user)
              <div>
                  <h6>Email : {{$user->email}}</h6>
                  <h6>Phone : {{$user->phone}}</h6>
              </div>
          @endforeach
      </div>

  </div>

    <div class="my-3 p-3 bg-white rounded shadow-sm">
        <div class="media text-muted pt-3">
            @foreach($users as $user)

                <div>
                    <table class="table">
                     <thead class="thead-dark">
                <tr>
                    <th scope="col">Role </th>
                    <th scope="col">Status</th>
                </tr>
                    </thead>
        <tbody>
        <tr>
            <td>
                <a href="{{ route( 'user.role.change', $user->user_name ) }}" class="btn btn-primary"> {{ $user->Role->name }} </a>
            </td>

            <td>
                <a href="{{ route( 'user.status.change', $user->user_name ) }}" class="btn btn-primary"> {{ $user->active == 1 ? 'Active' : 'Inactive'}} </a>
            </td>
        </tr>
        </tbody>
                    </table>

                </div>
                    @endforeach
                </div>

            </div>
        {{--    <table class="table">--}}
{{--    <thead class="thead-dark">--}}
{{--    <tr>--}}
{{--      <th scope="col">Serial</th>--}}
{{--      <th scope="col">first name</th>--}}
{{--      <th scope="col">last name</th>--}}
{{--      <th scope="col">full name</th>--}}
{{--      <th scope="col">user name</th>--}}
{{--      <th scope="col">image</th>--}}
{{--      <th scope="col">email</th>--}}
{{--      <th scope="col">phone</th>--}}
{{--      <th scope="col">role</th>--}}
{{--      <th scope="col">Status</th>--}}
{{--      <th scope="col">Action</th>--}}

{{--    </tr>--}}
{{--    </thead>--}}
{{--    <tbody>--}}

{{--       @php  $i=0; @endphp--}}
{{--       @foreach($users as $user)--}}
{{--       @php $i++; @endphp--}}
{{--    <tr>--}}
{{--      <th scope="row">{{ $i }}</th>--}}
{{--      <td><strong class="d-block text-gray-dark"> {{$user->first_name}} </strong></td>--}}
{{--      <td>{{$user->last_name}}</td>--}}
{{--      <td>{{$user->full_name}}</td>--}}
{{--      <td>{{$user->user_name}}</td>--}}
{{--      <td>--}}
{{--         <img src="{{ url('uploads/image').'/'.$user->image }}" width="100px" height="100px">--}}
{{--      </td>--}}
{{--      <td>{{ $user->email }}</td>--}}
{{--      <td>{{ $user->phone }}</td>--}}
{{--      <td>{{ $user->Role->name }}</td>--}}
{{--      <td>{{ $user->status == 1 ? 'Active' : 'Inactive'}}</td>--}}
{{--      <td>--}}
{{--            <a href="{{ route('User.ProfileEdit' , $user->user_name) }}" class="btn btn-success"> Edit </a>--}}
{{--            <a href="{{ route('User.delete' , $user->user_name) }}" class="btn btn-danger"> delete </a>--}}
{{--      </td>--}}

{{--    </tr>--}}
{{--    @endforeach--}}
{{--</table>--}}




</main>


@endsection

