<form id="editProdutoForm" action="{{ route('products.update', 0) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    <div class="modal fade" id="editProductModal" tabindex="-1" aria-labelledby="editProductModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="editProductModalLabel">Editar Produto</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <input type="hidden" id="edit_product_id" name="id" required>
                    <div class="mb-3">
                        <label for="edit_name" class="form-label">Nome do Produto</label>
                        <input type="text" class="form-control" id="edit_name" name="name" required>
                    </div>
                    <div class="mb-3">
                        <label for="edit_category_id" class="form-label">Categoria</label>
                        <select class="form-select" id="edit_category_id" name="category_id" required>
                            <option value="" disabled selected>Selecione uma categoria</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="edit_description" class="form-label">Descrição</label>
                        <textarea class="form-control" id="edit_description" name="description" rows="3" required></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="edit_price" class="form-label">Preço</label>
                        <input type="number" class="form-control" id="edit_price" name="price" step="0.01" required>
                    </div>
                    <div class="mb-3">
                        <label for="edit_photo" class="form-label">Imagem</label>
                        <input type="file" class="form-control" id="edit_photo" name="photo" accept="image/*">
                    </div>
                    <div class="mb-3">
                        <label for="edit_expiry_date" class="form-label">Data de Vencimento</label>
                        <input type="date" class="form-control" id="edit_expiry_date" name="expiry_date" required>
                    </div>
                    <div class="mb-3">
                        <label for="edit_stock" class="form-label">Quantidade</label>
                        <input type="number" class="form-control" id="edit_stock" name="stock" min="1" required>
                    </div>
                    <div class="mb-3">
                        <label for="edit_sku" class="form-label">Código do produto</label>
                        <input type="text" class="form-control" id="edit_sku" name="sku" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                    <button type="submit" class="btn btn-primary" id="salvarProdutoEdit">Salvar Alterações</button>
                </div>
            </div>
        </div>
    </div>
</form>

<script>
    document.getElementById('salvarProdutoEdit').addEventListener('click', function (e) {
    e.preventDefault();

    let formData = new FormData(document.getElementById('editProdutoForm'));
    const productId = document.getElementById('edit_product_id').value;

    fetch('{{ route("products.update", "") }}' + '/' + productId, {
        method: 'POST', 
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
