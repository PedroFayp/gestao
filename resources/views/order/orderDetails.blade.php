@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Detalhes do Pedido #{{ $order->id }}</h1>

    <p>Total: R$ {{ number_format($order->total, 2, ',', '.') }}</p>

    <table class="table">
        <thead>
            <tr>
                <th>Produto</th>
                <th>Quantidade</th>
                <th>Preço</th>
            </tr>
        </thead>
        <tbody>
            @foreach($order->items as $item)
                <tr>
                    <td>{{ $item->product->name }}</td>
                    <td>{{ $item->quantity }}</td>
                    <td>R$ {{ number_format($item->price, 2, ',', '.') }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
