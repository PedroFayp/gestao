@extends('layouts.app')

@section('title', 'Produtos') 
@section('content')
<div class="container p-3">
    <div class="float-end">
        @if(Auth::check() && Auth::user()->role === 1)
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createCategoryModal">
                Cadastrar Categoria
            </button>
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#cadastroModal">
                Cadastrar Produto
            </button>
        @endif
    </div>
</div>

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

@include('componentProducts.modalCategory')
@include('componentProducts.modal')
@include('componentProducts.modalEdit') 

<div class="row p-5 container-fluid">
    @foreach($products as $product)
    <div class="col-md-2 basic-width {{ auth()->check() ? 'animate' : '' }}" data-bs-toggle="tooltip" data-bs-placement="top" title="{{ auth()->check() ? '' : 'Você precisa estar logado para adicionar itens ao carrinho.' }}">
        <div class="card mb-4 model-card">
            @if($product->photo)
            <img src="{{ asset('storage/' . $product->photo) }}" class="card-img-top card-img" alt="{{ $product->name }}">
            @endif
            <div class="card-body model-card-text">
                <h5 class="card-title">{{ $product->name }}</h5>
                <p class="card-text"><strong>Preço:</strong> R$ {{ number_format($product->price, 2, ',', '.') }}</p>
                <p class="card-text"><strong>Quantidade:</strong> {{ $product->stock }}</p>
                
                @if(Auth::check())
                <form action="{{ route('cart.add', $product->id) }}" method="POST" style="display: inline;">
                    @csrf
                    <button type="submit" class="btn btn-link cart-color" title="Adicionar ao carrinho">
                        <i class="bi bi-cart2" style="font-size: 1.5rem;"></i>
                    </button>
                </form>
                @endif

                @if(Auth::check() && Auth::user()->role === 1)
                    <button class="btn btn-link cart-color" title="Editar" data-bs-toggle="modal" data-bs-target="#editProductModal" onclick="openEditModal({{ json_encode($product) }})">
                        <i class="bi bi-pencil" style="font-size: 1.5rem;"></i>
                    </button>
                    <form action="{{ route('products.destroy', $product->id) }}" method="POST" style="display: inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-link cart-color" title="Excluir" onclick="return confirm('Tem certeza que deseja excluir este produto?')">
                            <i class="bi bi-trash" style="font-size: 1.5rem;"></i>
                        </button>
                    </form>
                @endif

                <div class="description-box">{{ $product->description }}</div>
            </div>
        </div>
    </div>
    @endforeach
</div>

<div class="alert-container"></div> 

<script>
    function openEditModal(product) {
        document.getElementById('edit_product_id').value = product.id; 
        document.getElementById('edit_name').value = product.name;
        document.getElementById('edit_description').value = product.description;
        document.getElementById('edit_price').value = product.price;
        document.getElementById('edit_stock').value = product.stock;
        document.getElementById('edit_sku').value = product.sku;
        document.getElementById('edit_expiry_date').value = product.expiry_date;
        document.getElementById('edit_category_id').value = product.category_id;

        var editModal = new bootstrap.Modal(document.getElementById('editProductModal'));
        editModal.show();
    }

    document.getElementById('salvarProdutoEdit').addEventListener('click', function (e) {
        e.preventDefault();

        let formData = new FormData(document.getElementById('editProdutoForm'));
        const productId = document.getElementById('edit_product_id').value;

        fetch('{{ route("products.update", '') }}' + '/' + productId, {
            method: 'PUT',
            body: formData,
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                alert('Produto editado com sucesso!');
                location.reload();
            } else {
                alert('Erro ao editar produto.');
            }
        })
        .catch(error => console.error('Error:', error));
    });
    
</script>

@endsection
