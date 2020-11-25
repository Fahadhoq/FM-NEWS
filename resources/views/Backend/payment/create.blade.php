@extends('Backend.layout.master')



@section('container')

    <h1>Payment Pay</h1>

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

            <form action="{{ route( 'pay.create' ) }}" method="post" enctype="multipart/form-data">
                @csrf

                @if(auth()->user()->role_id == 2)
                <div class="form-group">
                    <label for="user_id"> User Name </label>
                    <select class="form-control select2" id="select2" name="user_id">
                        @foreach ($PaymentUsers as $PaymentUser)

                            <option value="{{$PaymentUser->id}}"> {{$PaymentUser->full_name}} </option>

                        @endforeach
                    </select>
                </div>
                @else
                    <div class="form-group">
                        <label for="user_id"> User Name </label>
                        <select class="form-control select2" id="select2" name="user_id">

                                <option value="{{auth()->user()->id}}"> {{auth()->user()->full_name}} </option>

                        </select>
                    </div>
                @endif

                <div class="form-group">
                    <label for="payment_category_id">Payment Category </label>
                    <select class="form-control select2" id="select2" name="payment_category_id">
                        @foreach ($paymentcategories as $PaymentCategory)

                            <option value="{{$PaymentCategory->id}}"> {{$PaymentCategory->name}} </option>

                        @endforeach
                    </select>
                </div>

                <button type="submit" class="btn btn-primary">Submit</button>

            </form>


        </div><!-- div row -->

    </main>

@endsection
