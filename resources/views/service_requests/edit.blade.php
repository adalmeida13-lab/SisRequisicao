@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Editar Requisição de Serviço</h1>
        <form action="{{ route('servicerequest.update', $serviceRequest->id) }}" method="POST">
            @csrf
            @method('PUT')
            <!-- Adicione os campos do formulário aqui -->
            <button type="submit" class="btn btn-primary">Atualizar</button>
        </form>
    </div>
@endsection
