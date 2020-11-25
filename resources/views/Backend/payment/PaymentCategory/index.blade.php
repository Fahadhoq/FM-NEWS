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
      <th scope="col">Amount</th>
      <th scope="col">Status</th>
        @if(auth()->user()->role_id == 2)
      <th scope="col">Action</th>
        @endif

    </tr>
  </thead>
  <tbody>
  @php  $i=0; @endphp
  @foreach($PaymentCategories as $PaymentCategory)
  @php $i++; @endphp
    <tr>
      <th scope="row">{{ $i }}</th>
      <td>{{ $PaymentCategory->name }}</td>
      <td>{{ $PaymentCategory->amount }}</td>
        <td>
            @if(auth()->user()->role_id == 2)
            <a href="{{ route( 'payment.category.status.change', $PaymentCategory->slug ) }}" class="btn btn-primary"> {{ $PaymentCategory->status == 1 ? 'Active' : 'Inactive'}} </a>
            @else
                {{ $PaymentCategory->status == 1 ? 'Active' : 'Inactive'}}
            @endif
        </td>
      <td>
          @if(auth()->user()->role_id == 2)
            <a href="{{route( 'payment.category.edit' , $PaymentCategory->slug )}}" class="btn btn-success"> Edit </a>
            <a href="{{route( 'payment.category.delete' , $PaymentCategory->id )}}" class="btn btn-danger"> delete </a>
          @endif
      </td>
    </tr>
    @endforeach
</table>
{{ $PaymentCategories->links() }}

@endsection
