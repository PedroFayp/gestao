<div class="modal fade" id="createCategoryModal" tabindex="-1" aria-labelledby="createCategoryModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="createCategoryModalLabel">Cadastrar Categoria</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form method="POST" id="cadastroCategoriaForm" action="{{ route('categories.store') }}">
          @csrf
          <div class="mb-3">
            <label for="categoryName" class="form-label">Nome da Categoria</label>
            <input type="text" class="form-control" id="categoryName" name="name" required>
            <input type="hidden" id="categoryId" name="categoryId">
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
        <button type="submit" class="btn btn-primary" id="salvarCategoria">Salvar Categoria</button>
      </div>
            <div class="mb-3 modal-body">
                <hr>
                <h6>Categorias Cadastradas</h6>
                <ul id="listaCategorias" class="list-group pagination">
                    @foreach($categories as $category)
                        <li class="list-group-item" data-id="{{ $category->id }}">
                            {{ $category->name }} 
                            @if($category->products_count > 0)
                                <span class="badge bg-info rounded-pill">{{ $category->products_count }}</span>
                            @else
                                <span class="badge bg-success">Sem produtos</span>
                            @endif
                            <div class="float-end">
                                <button class="btn btn-warning btn-sm me-2" onclick="openEditModal({{ json_encode($category) }})"><i class="bi bi-pencil-fill"></i></button>
                                <button class="btn btn-danger btn-sm" onclick="deleteCategory({{ $category->id }}, {{ $category->products_count }})"><i class="bi bi-trash-fill"></i></button>
                            </div>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
</div>
