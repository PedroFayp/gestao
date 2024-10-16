<form id="cadastroProdutoForm" action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="modal fade" id="cadastroModal" tabindex="-1" aria-labelledby="cadastroModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="cadastroModalLabel">Cadastrar Produto</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="name" class="form-label">Nome do Produto</label>
                            <input type="text" class="form-control" id="name" name="name" required>
                        </div>
                        <div class="mb-3">
                            <label for="category_id" class="form-label">Categoria</label>
                            <select class="form-select" id="category_id" name="category_id" required>
                                <option value="" disabled selected>Selecione uma categoria</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="description" class="form-label">Descrição</label>
                            <textarea class="form-control" id="description" name="description" rows="3" required></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="price" class="form-label">Preço</label>
                            <input type="number" class="form-control" id="price" name="price" step="0.01" required>
                        </div>
                        <div class="mb-3">
                            <label for="photo" class="form-label">Imagem</label>
                            <input type="file" class="form-control" id="photo" name="photo" accept="image/*" required>
                            <div id="photoError" class="text-danger" style="display: none;"></div>
                        </div>
                        <div class="mb-3">
                            <label for="expiry_date" class="form-label">Data de Vencimento</label>
                            <input type="date" class="form-control" id="expiry_date" name="expiry_date" required>
                            <div id="expiryError" class="text-danger" style="display: none;"></div>
                        </div>
                        <div class="mb-3">
                            <label for="stock" class="form-label">Quantidade</label>
                            <input type="number" class="form-control" id="stock" name="stock" min="1" required>
                        </div>
                        <div class="mb-3">
                            <label for="sku" class="form-label">Código do produto</label>
                            <input type="text" class="form-control" id="sku" name="sku" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                        <button type="submit" class="btn btn-primary" id="salvarProduto">Salvar Produto</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const expiryDateInput = document.getElementById('expiry_date');
            const photoInput = document.getElementById('photo');
            const photoError = document.getElementById('photoError');
            const expiryError = document.getElementById('expiryError');
            const fileSizeLimit = 5 * 1024 * 1024;

            expiryDateInput.addEventListener('input', function() {
                const expiryDate = new Date(expiryDateInput.value);
                const today = new Date();
                if (expiryDate <= today) {
                    expiryError.textContent = "A data de vencimento deve ser uma data futura.";
                    expiryError.style.display = "block";
                } else {
                    expiryError.style.display = "none";
                }
            });

            photoInput.addEventListener('change', function() {
                if (photoInput.files[0] && photoInput.files[0].size > fileSizeLimit) {
                    photoError.textContent = "O tamanho da imagem deve ser inferior a 5MB.";
                    photoError.style.display = "block";
                    photoInput.value = "";
                } else {
                    photoError.style.display = "none";
                }
            });

            document.getElementById('cadastroProdutoForm').addEventListener('submit', function(event) {
                const expiryDate = new Date(expiryDateInput.value);
                const today = new Date();
                if (expiryDate <= today) {
                    event.preventDefault();
                    alert("A data de vencimento deve ser uma data futura.");
                    return;
                }

                if (photoInput.files[0] && photoInput.files[0].size > fileSizeLimit) {
                    event.preventDefault();
                    alert("O tamanho da imagem deve ser inferior a 5MB.");
                }
            });
        });
    </script>

