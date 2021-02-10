@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <h1>carrello</h1>
                @php $cart = request()->session()->get('cart'); @endphp
                @foreach($cart['items'] as $item)
                    <div class="card">
                        <p>{{ $item['name'] }}</p>
                        <p>price &euro; {{ $item['price'] }}</p>
                        <p>quantity {{ $item['quantity'] }}</p>
                        <p>subtotal &euro; {{  $item['subtotal'] }}</p>
                        <p>id {{  $item['id'] }}</p>
                    </div>
                @endforeach
            </div>
            <a href="{{ route('checkout') }}">
                <button type="button" class="btn btn-success btn-lg">Procedi con l'ordine</button>
            </a>
        </div>
    </div>
</div>
@endsection
