@if(session('success'))
    <div class="alert alert-success" role="alert">
        {{ session('success') }}
    </div>
@endif

<div class="alert alert-warning alert-dismissible fade show fixed-top right-0 m-3" id="alerta" style="display: none;">
  <button type="button" class="close" data-dismiss="alert">&times;</button>
  <strong>Atenção!</strong> Você precisa estar logado para adicionar itens ao carrinho.
</div>

<script>
    $('#carrinho-button').on('click', function() {
        if (!usuarioLogado()) {
            $('#alerta').fadeIn().delay(3000).fadeOut();
        }
    });
</script>