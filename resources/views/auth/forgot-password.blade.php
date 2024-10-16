@extends('layouts.app')

@section('content')
    <div class="container w-50 mt-5">
        <div class="mb-4 text-sm text-gray-600 dark:text-gray-400">
            {{ __('Esqueceu sua senha? Sem problemas. Basta informar seu endereço de email e enviaremos um link para redefinir sua senha.') }}
        </div>

        <x-auth-session-status class="mb-4" :status="session('status')" />

        <form method="POST" action="{{ route('password.email') }}">
            @csrf

            <div class="mb-3">
                <label for="email" class="form-label">{{ __('Email') }}</label>
                <input id="email" type="email" class="form-control" name="email" :value="old('email')" required autofocus />
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>

            <div class="d-flex justify-content-end mt-3">
                <button type="submit" class="btn btn-primary">
                    {{ __('Enviar') }}
                </button>
            </div>
        </form>
    </div>
@endsection
