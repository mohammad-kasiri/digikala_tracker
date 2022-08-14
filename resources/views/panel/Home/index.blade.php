@extends('panel.layout.master')
@section('title' , 'Home')

@section('content')
    @foreach($books as $book)
        <div class="row my-3">
            <div class="col-md-3">
                <img src="{{$book->image}}" class="img-fluid">
            </div>

            <div class="col-md-6  pt-1">
                <h5  class="bold mt-3">
                    <a href="https://www.digikala.com/product/{{$book->digikala_id}}" target="_blank" class="text-dark text-decoration-none">
                        {{$book->title}}
                    </a>
                </h5>
                <span>Real Price: </span> <b>{{number_format($book->rrp_price / 10)}}</b>
                <br>
                <span>Selling Price: </span> <b>{{number_format($book->selling_price / 10)}}</b>
                <br>
                <span>Discount: </span> <b class="text-bg-danger">{{$book->discount_percent}}$</b>

            </div>
            <div class="col-md-3"></div>
        </div>
    @endforeach

@endsection
