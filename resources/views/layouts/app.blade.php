<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>
<body>
    
    <nav class="navbar navbar-expand-lg bg-body-tertiary">
        <div class="container">
            <a class="navbar-brand" href="{{ route('home') }}"><i class="bi bi-shop icon-black"></i> Página inicial </a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('products') ? 'active' : '' }}" href="{{ route('products.index') }}">Produtos</a>
                    </li>
                    @if(Auth::check())
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('contato') ? 'active' : '' }}" href="{{ route('contacts.contact') }}">Contato</a>
                    </li>
                    @endif
                    @if(Auth::check() && Auth::user()->role === 1)
                        <li class="nav-item">
                            <a class="nav-link {{ request()->is('ranking') ? 'active' : '' }}" href="{{ route('admin.products') }}">Dados</a>
                        </li>
                    @endif
                </ul>

                <ul class="navbar-nav ms-auto">
                @if(Auth::check())
                        <a href="{{ route('cart.cart') }}" class="btn btn-link" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Carrinho de compras">
                            <i class="bi bi-basket2 icon-black"></i>
                        </a>
                    @endif
                    @if (Auth::check())
                        <li class="nav-item">
                            <a class="nav-link {{ request()->is('perfil') ? 'active' : '' }}" href="{{ route('profile.edit') }}" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Perfil do usuário">
                                <i class="bi bi-person icon-black"></i> {{ Auth::user()->name }}
                            </a>
                        </li>
                        <li class="nav-item">
                            <form method="POST" action="{{ route('logout') }}" id="logout-form">
                                @csrf
                                <button type="submit" class="btn btn-link nav-link" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Sair do sistema" id="logoutButton">
                                    Sair
                                </button>
                            </form>
                        </li>
                    @else
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Entrar no sistema">
                                <i class="bi bi-person icon-black"></i>
                                Entrar
                            </a>
                        </li>
                    @endif
                </ul>
            </div>
        </div>
    </nav>  

    <div class="container-fluid">
        @yield('content')
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const logoutForm = document.getElementById('logout-form');
            if (logoutForm) {
                logoutForm.addEventListener('submit', function(event) {
                    event.preventDefault();
                    fetch(this.action, {
                        method: 'POST',
                        body: new FormData(this),
                        headers: {
                            'X-CSRF-TOKEN': document.querySelector('input[name=_token]').value
                        }
                    }).then(response => {
                        if (response.ok) {
                            location.reload();
                        }
                    });
                });
            }
        });
    </script>

</body>
</html>
