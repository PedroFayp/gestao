@extends('layouts.app')

@section('title', 'Contatos')

@section('content')
<div class="container p-3">
    <h1>Contatos</h1>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <form action="{{ route('contacts.store') }}" method="POST">
        @csrf
        <div class="mb-3">
                <label for="name" class="form-label">Seu nome</label>
                <input type="text" class="form-control" id="name" name="name" value="{{ auth()->user()->name }}" disabled>
            </div>

            <div class="mb-3">
                <label for="email" class="form-label">Seu email</label>
                <input type="email" class="form-control" id="email" name="email" value="{{ auth()->user()->email }}" disabled>
            </div>

        <div class="mb-3">
            <label for="subject" class="form-label">Assunto</label>
            <input type="text" class="form-control" id="subject" name="subject" required>
        </div>
        <div class="mb-3">
            <label for="message" class="form-label">Mensagem</label>
            <textarea class="form-control" id="message" name="message" rows="5" required></textarea>
        </div>
        <button type="submit" class="btn btn-primary float-end">Enviar Mensagem</button>
    </form>
</div>

<script>
    document.getElementById('logoutButton').addEventListener('click', function(event) {
        event.preventDefault();
        if (window.location.pathname === '/contact') { 
            document.getElementById('logout-form').submit();
        }
    });
</script>

@endsection
