@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Criar Nova Requisição de Serviço</h1>
        <form action="{{ route('servicerequest.store') }}" method="POST">
            @csrf
            <!-- Adicione os campos do formulário aqui colocar aqui os campus q vai ter na requisicao somente os que estão na model-->

            <button type="submit" class="btn btn-primary">Criar</button>
        </form>
    </div>
@endsection

