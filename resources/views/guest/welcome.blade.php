@extends('layouts.app')

@section('content')
    @section('content')

    <div class="container">
        <div class="row product_data">
            @foreach ($products as $product)
                <div class="col-md-4">
                    <img src="{{$product->cover}}" alt="">
                    <h1>{{ $product->name }}</h1>
                    <h1>{{ $product->id }}</h1>
                    <h1>{{ $product->price }}</h1>
                    <form action="{{ route('cart.send', ['id' => $product->id ]) }}" method="POST">
                        @csrf
                        <button type="submit" class="add-to-cart-btn btn btn-primary">Add to Cart</button>
                    </form>
                </div>
            @endforeach
        </div>
    </div>

    @endsection
@endsection
