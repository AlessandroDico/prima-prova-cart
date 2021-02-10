@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <h1>checkout</h1>
            <h2>Riepilogo ordine</h2>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th scope="col">Prodotto</th>
                        <th scope="col">Prezzo</th>
                        <th scope="col">Quantità</th>
                        <th scope="col">Totale</th>
                    </tr>
                </thead>
                <tbody>
                    @php $cart = request()->session()->get('cart'); @endphp
                    @foreach($cart['items'] as $item)
                        <tr>
                            <td>{{ $item['name'] }}</td>
                            <td>&euro; {{ $item['price'] }}</td>
                            <td>{{ $item['quantity'] }}</td>
                            <td>&euro; {{  $item['subtotal'] }}</td>
                        </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <td colspan="4">
                    <b>Totale:</b> &euro; {{ $cart['total'] }}
                    </td>
                </tfoot>
            </table>
            <form>
                <div class="form-group">
                    <label for="exampleInputEmail1">Email address</label>
                    <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email">
                    <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">name</label>
                    <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter name">
                    <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">address</label>
                    <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter address">
                    <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">Password</label>
                    <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>
</div>
@endsection
