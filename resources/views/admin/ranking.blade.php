@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h2>Ranking dos 10 Produtos Mais Vendidos</h2>
    <table class="table table-light">
        <thead>
            <tr>
                <th>Posição</th>
                <th>Nome do Produto</th>
                <th>Quantidade Vendida</th>
            </tr>
        </thead>
        <tbody>
            @foreach($topProducts as $index => $product)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $product->name }}</td>
                    <td>{{ $product->sold_count }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <div class="mt-3">
        <a href="{{ route('admin.export.ranking.csv') }}" class="btn btn-primary">
            <i class="fas fa-file-csv"></i> Exportar CSV
        </a>
    </div>
</div>
@endsection
