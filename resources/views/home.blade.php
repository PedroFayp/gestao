@extends('layouts.app')

@section('title', 'Página inicial')
@section('content')

@if(session('success'))
    <div class="alert alert-container alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        </button>
    </div>
@endif

@if(session('error'))
    <div class="alert alert-container alert-danger alert-dismissible fade show" role="alert">
        {{ session('error') }}
        </button>
    </div>
@endif

<h1 class="display-3 fw-bold text-center m-3">Bem-vindo {{ Auth::user()->name ?? 'Visitante'}}</h1>

<div class="banner-background">
    <img src="/images/banner3.png" alt="Banner" class="img-fluid" />
    <div class="text-overlay">
        <h1 class="display-3 fw-bold">Produtos em destaque</h1>
        <h3 class="fw-normal text-white mb-3">Mais vendidos</h3>
        @foreach($topProducts as $product)
            <h3 class="fw-normal text-white mb-3">{{ $product->name }}</h3>
        @endforeach
    </div>
</div>


<div class="container-fluid">
    <div class="row">
        <div class="col-md-12 p-3">
            <div class="position-relative overflow-hidden p-3 p-md-5 m-0 text-center display rounded">
                <div class="col-md-12">
                    <h1 class="display-3 fw-bold">Quem somos</h1>
                    <h3 class="fw-normal text-secondary mb-3 text-white">
                        O sistema de gest o de vendas  uma ferramenta completa para gerenciar suas vendas,
                        estoque, clientes e muito mais. Com ele, voc  pode controlar todas as opera es
                        de seu neg cio de forma eficiente e segura.
                    </h3>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
