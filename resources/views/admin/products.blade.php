@extends('layouts.app')

@section('title', 'Administração de Produtos')

@if(session('error'))
    <div class="alert alert-danger">{{ session('error') }}</div>
@endif

@section('content')
<div class="container mt-5">
    <h1>Administração de Produtos</h1>

    <div class="row mt-4">
        
        <div class="col-md-4">
            <a href="{{ route('admin.list.log') }}" class="btn btn-secondary">Listagem de Entradas e Saídas</a>
        </div>

        <div class="col-md-4">
            <a href="{{ route('admin.current.inventory.report') }}" class="btn btn-success">Relatório de Estoque Atual</a>
        </div>

        <div class="col-md-4">
            <a href="{{ route('admin.ranking') }}" class="btn btn-info">Ranking dos 10 Produtos com Mais Saída</a>
        </div>

    </div>
</div>

<script>
    document.getElementById('logoutButton').addEventListener('click', function(event) {
        if (window.location.pathname === '/admin/products') {
            event.preventDefault();
            window.location.href = '/home';
        }
    });
    
</script>

@endsection
