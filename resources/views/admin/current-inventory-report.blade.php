@extends('layouts.app')
@section('content')
<div class="container">
    <h1>Relatório de Estoque Atual</h1>
    <a href="{{ route('admin.export.current.inventory') }}" class="btn btn-primary " title="Exportar CSV">
        <i class="fas fa-file-csv"></i> Exportar CSV
    </a>

    <table class="table table-light mt-3">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nome do Produto</th>
                <th>Descrição</th>
                <th>Preço</th>
                <th>Quantidade em Estoque</th>
                <th>SKU</th>
                <th>Data de Validade</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($products as $product)
            <tr>
                <td>{{ $product->id }}</td>
                <td>{{ $product->name }}</td>
                <td>{{ $product->description }}</td>
                <td>{{ $product->price }}</td>
                <td>{{ $product->stock }}</td>
                <td>{{ $product->sku }}</td>
                <td>{{ $product->expiry_date ? \Carbon\Carbon::parse($product->expiry_date)->format('d/m/Y') : 'N/A' }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
