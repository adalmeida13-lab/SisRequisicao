@extends('layouts.app')

@section('page-title')
    Visualizar Empresa
@endsection

@section('content')
    <div class="container">
        <h1>Visualizando Empresa</h1>
        <div class="form-group">
            <label for="name">Nome</label>
            <input type="text" class="form-control" id="name" name="name" value="{{ $company->name }}" readonly>
        </div>
        <div class="form-group">
            <label for="docto">CNPJ</label>
            <input type="text" class="form-control" id="docto" name="docto" value="{{ $company->docto }}" readonly>
        </div>
        <div class="form-group">
            <label for="address">Endereço</label>
            <input type="text" class="form-control" id="address" name="address" value="{{ $company->address }}" readonly>
        </div>
        <div class="form-group">
            <label for="is_active">Ativa</label>
            <select class="form-control" id="is_active" name="is_active" disabled>
                <option value="1" {{ $company->is_active ? 'selected' : '' }}>Sim</option>
                <option value="0" {{ !$company->is_active ? 'selected' : '' }}>Não</option>
            </select>
        </div>
        <a href="{{ route('companies.index') }}" class="btn btn-secondary">Voltar</a>
    </div>
@endsection
