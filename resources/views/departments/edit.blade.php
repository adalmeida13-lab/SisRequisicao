@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Editar Departamento</h1>

        <form action="{{ route('departments.update', $department->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="name">Nome:</label>
                <input type="text" class="form-control" id="name" name="name" value="{{ $department->name }}" required>
            </div>

            <div class="form-group">
                <label for="company_id">Empresa:</label>
                <select class="form-control" id="company_id" name="company_id" required>
                    <option value="">Selecione uma empresa</option>
                    @foreach($companies as $company)
                        <option value="{{ $company->id }}" {{ $department->company_id == $company->id ? 'selected' : '' }}>
                            {{ $company->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="is_active">Ativo:</label>
                <select class="form-control" id="is_active" name="is_active" required>
                    <option value="1" {{ $department->is_active ? 'selected' : '' }}>Sim</option>
                    <option value="0" {{ !$department->is_active ? 'selected' : '' }}>Não</option>
                </select>
            </div>

            <button type="submit" class="btn btn-primary">Atualizar</button>
            <a href="{{ route('departments.index') }}" class="btn btn-secondary">Voltar</a>
        </form>
    </div>
@endsection
