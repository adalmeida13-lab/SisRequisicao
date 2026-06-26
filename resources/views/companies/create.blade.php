@extends('layouts.app')

@section('page-title')
    Criar Empresa
@endsection

@section('content')
    <div class="container">
        <h1>Criar Empresa</h1>
        <form action="{{ route('companies.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="name">Nome</label>
                <input type="text" class="form-control" id="name" name="name" required>
            </div>
            <div class="form-group">
                <label for="docto">CNPJ</label>
                <input type="text" class="form-control" id="docto" name="docto" required>
            <div class="form-group">
                <label for="address">Endereço</label>
                <input type="text" class="form-control" id="address" name="address" required>
            </div>
            <div class="form-group">
                <label for="is_active">Ativa</label>
                <select class="form-control" id="is_active" name="is_active">
                    <option value="1">Sim</option>
                    <option value="0">Não</option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Salvar</button
        </form>
    </div>
@endsection

