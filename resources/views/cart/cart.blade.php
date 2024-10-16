@extends('layouts.app')

@section('content')
<div class="container p-3">
    <h1>Carrinho de Compras</h1>

    @include('components._messages')

    @if(session('cart') && count(session('cart')) > 0)
        <table class="table table-light">
            <thead>
                <tr>
                    <th>Produto</th>
                    <th>Quantidade</th>
                    <th>Preço Unitário</th>
                    <th>Preço Total</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                @foreach(session('cart') as $id => $details)
                    <tr>
                        <td>{{ $details['name'] }}</td>
                        <td>
                            <form action="{{ route('cart.update', $id) }}" method="POST">
                                @csrf
                                <input type="number" name="quantity" value="{{ $details['quantity'] }}" min="1" required>
                                <button type="submit">Atualizar</button>
                            </form>
                        </td>
                        <td>R$ {{ number_format($details['price'], 2, ',', '.') }}</td>
                        <td>R$ {{ number_format($details['price'] * $details['quantity'], 2, ',', '.') }}</td>
                        <td>
                            <form action="{{ route('cart.remove', $id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Remover</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div class="d-flex justify-content-between">
            <h4>Total: R$ {{ number_format(array_sum(array_map(function($item) {
                return $item['price'] * $item['quantity'];
            }, session('cart'))), 2, ',', '.') }}</h4>
            <form action="{{ route('checkout') }}" method="POST">
                @csrf
                <button type="submit" class="btn btn-primary">Finalizar Compra</button>
            </form>
        </div>
    @else
        <p>Seu carrinho está vazio.</p>
    @endif
</div>
@endsection
