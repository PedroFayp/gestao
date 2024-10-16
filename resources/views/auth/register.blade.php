@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <x-auth-session-status class="mb-4" :status="session('status')" />
    
    <div class="card">
        <div class="card-header">
            <h4 class="mb-0">{{ __('Criar uma nova conta') }}</h4>
        </div>
        <div class="card-body">
            <form method="POST" action="{{ route('register') }}">
                @csrf

                <div class="mb-3">
                    <label for="name" class="form-label">{{ __('Nome') }}</label>
                    <input id="name" type="text" class="form-control" name="name" :value="old('name')" required autofocus autocomplete="name">
                    <x-input-error :messages="$errors->get('name')" class="mt-2" />
                </div>

                <div class="mb-3">
                    <label for="email" class="form-label">{{ __('Email') }}</label>
                    <input id="email" type="email" class="form-control" name="email" :value="old('email')" required autocomplete="username">
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>

                <div class="mb-3">
                    <label for="password" class="form-label">{{ __('Senha') }}</label>
                    <input id="password" type="password" class="form-control" name="password" required autocomplete="new-password">
                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>

                <div class="mb-3">
                    <label for="password_confirmation" class="form-label">{{ __('Confirmar Senha') }}</label>
                    <input id="password_confirmation" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                    <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                </div>

                <div class="mb-3">
                    <label for="role" class="form-label">{{ __('Cargo') }}</label>
                    <select id="role" name="role" class="form-select" required>
                        <option value="" disabled selected>{{ __('Selecione um cargo') }}</option>
                        <option value="1">Admin</option>
                        <option value="2">Visitante</option>
                    </select>
                    <x-input-error :messages="$errors->get('role')" class="mt-2" />
                </div>

                <div class="d-flex justify-content-between align-items-center mt-4">
                    <a class="text-decoration-underline" href="{{ route('login') }}">
                        {{ __('Já possui uma conta? Clique aqui.') }}
                    </a>

                    <button type="submit" class="btn btn-primary">
                        {{ __('Cadastrar') }}
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
