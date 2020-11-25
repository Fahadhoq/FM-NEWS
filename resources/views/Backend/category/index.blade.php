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

<table class="table">
  <thead class="thead-dark">
    <tr>
      <th scope="col">Serial</th>
      <th scope="col">Name</th>
        @if(auth()->user()->role_id == 2)
      <th scope="col">Slug</th>
        @endif
      <th scope="col">Status</th>
        @if(auth()->user()->role_id == 2)
      <th scope="col">Action</th>
        @endif

    </tr>
  </thead>
  <tbody>
  @php  $i=0; @endphp
  @foreach($categories as $category)
  @php $i++; @endphp
    <tr>
      <th scope="row">{{ $i }}</th>
      <td>{{ $category->name }}</td>

        @if(auth()->user()->role_id == 2)
          <td>{{ $category->slug }}</td>
        @endif

        <td>
            @if(auth()->user()->role_id == 2)
            <a href="{{ route( 'category.status.change', $category->slug ) }}" class="btn btn-primary"> {{ $category->status == 1 ? 'Active' : 'Inactive'}} </a>
            @else
                {{ $category->status == 1 ? 'Active' : 'Inactive'}}
            @endif
        </td>
      <td>
          @if(auth()->user()->role_id == 2)
            <a href="{{route( 'category.edit' , $category->slug )}}" class="btn btn-success"> Edit </a>
            <a href="{{route( 'category.delete' , $category->id )}}" class="btn btn-danger"> delete </a>
          @endif
      </td>
    </tr>
    @endforeach
</table>
{{ $categories->links() }}

@endsection
