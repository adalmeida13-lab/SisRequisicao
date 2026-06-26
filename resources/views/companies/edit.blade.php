@extends('layouts.app')

@section('page-title')
    Editar Empresa
@endsection

@section('content')
    <div class="container">
        <h1>Editando Empresa</h1>
        <form action="{{ route('companies.update', $company->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="name">Nome</label>
                <input type="text" class="form-control" id="name" name="name" value="{{ $company->name }}" required>
            </div>
            <div class="form-group">
                <label for="docto">CNPJ</label>
                <input type="text" class="form-control" id="docto" name="docto" value="{{ $company->docto }}" required>
            </div>
            <div class="form-group">
                <label for="address">Endereço</label>
                <input type="text" class="form-control" id="address" name="address" value="{{ $company->address }}" required>
            </div>
            <div class="form-group">
                <label for="is_active">Ativa</label>
                <select class="form-control" id="is_active" name="is_active">
                    <option value="1" {{ $company->is_active ? 'selected' : '' }}>Sim</option>
                    <option value="0" {{ !$company->is_active ? 'selected' : '' }}>Não</option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Salvar</button>
        </form>
    </div>
@endsection
