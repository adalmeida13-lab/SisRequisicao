@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Criar Departamento</h1>
        <span class="text-muted">* Campos obrigatórios</span>


        <form action="{{ route('departments.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="name">Nome:</label>
                <input type="text" class="form-control" id="name" name="name" required>
            </div>
            <div class="form-group">
                <label for="company_id">Empresa:</label>
                <select class="form-control" id="company_id" name="company_id" required>
                    <option value="">Selecione uma empresa</option>
                    @foreach($companies as $company)
                        <option value="{{ $company->id }}">{{ $company->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="is_active">Ativo:</label>
                <select class="form-control" id="is_active" name="is_active" required>
                    <option value="1">Sim</option>
                    <option value="0">Não</option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Salvar</button>
        </form>
    </div>
@endsection

