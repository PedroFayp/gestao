@extends('layouts.app')

@section('content')
    <div class="container mt-5">
        <x-auth-session-status class="mb-4" :status="session('status')" />

        @if ($errors->any())
            <div class="alert alert-danger">
                {{ __('E-mail e/ou senha inválidos.') }}
            </div>
        @endif

        <div class="card">
            <div class="card-header">
                <h4 class="mb-0">{{ __('Entre com sua conta') }}</h4>
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    <div class="mb-3">
                        <label for="email" class="form-label">{{ __('E-mail:') }}</label>
                        <input id="email" type="email" class="form-control" name="email" :value="old('email')" required autofocus autocomplete="username">
                    </div>

                    <div class="mb-3">
                        <label for="password" class="form-label">{{ __('Senha:') }}</label>
                        <input id="password" type="password" class="form-control" name="password" required autocomplete="current-password">
                    </div>

                    <div class="mt-3">
                        <a href="{{ route('register') }}" class="text-decoration-underline">{{ __('Criar conta') }}</a>
                    </div>

                    <div class="d-flex justify-content-between align-items-center mb-3">
                        @if (Route::has('password.request'))
                            <a class="text-decoration-underline" href="{{ route('password.request') }}">
                                {{ __('Esqueceu a senha?') }}
                            </a>
                        @endif

                        <button type="submit" class="btn btn-primary">
                            {{ __('Entrar') }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
