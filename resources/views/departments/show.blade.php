@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Detalhes do Departamento</h1>

        <div class="form-group">
            <label for="name">Nome:</label>
            <input type="text" class="form-control" id="name" name="name" value="{{ $department->name }}" disabled>
        </div>

        <div class="form-group">
            <label for="company_id">Empresa:</label>
            <input type="text" class="form-control" id="company_id" name="company_id" value="{{ $department->company->name }}" disabled>
        </div>

        <div class="form-group">
            <label for="is_active">Ativo:</label>
            <input type="text" class="form-control" id="is_active" name="is_active" value="{{ $department->is_active ? 'Sim' : 'Não' }}" disabled>
        </div>

        <a href="{{ route('departments.index') }}" class="btn btn-secondary">Voltar</a>
    </div>
@endsection
