@extends('layouts.app')

@section('page-title')
    Empresas Excluídas
@endsection

@section('content')
    <div class="container">
        <h1>Empresas Excluídas</h1>
        <p>Esta é a página de empresas excluídas.</p>
    </div>

    <div class="container mt-4">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Ações</th>
                    <th>Nome</th>
                    <th>CNPJ</th>
                    <th>Endereço</th>
                    <th>Ativa</th>
                </tr>
            </thead>
            <tbody>
                @foreach($companies as $company)
                    <tr>
                        <td>
                            <form action="{{ route('companies.restore', $company->id) }}" method="POST" style="display: inline-block;">
                                @csrf
                                @method('PUT')

                                <button type="submit" class="btn btn-sm btn-success">
                                    <i class="bi bi-arrow-counterclockwise"></i>
                                    Restaurar
                                </button>
                            </form>

                            <form action="{{ route('companies.forceDelete', $company->id) }}" method="POST" style="display: inline-block;">
                                @csrf
                                @method('DELETE')

                                <button type="submit" class="btn btn-sm btn-danger">
                                    <i class="bi bi-x-lg"></i>
                                    Excluir Permanentemente
                                </button>
                            </form>
                        </td>
                        <td>{{ $company->name }}</td>
                        <td>{{ $company->docto }}</td>
                        <td>{{ $company->address }}</td>
                        <td>{{ $company->is_active ? 'Sim' : 'Não' }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <a href="{{ route('companies.index') }}" class="btn btn-secondary">Voltar</a>
@endsection
