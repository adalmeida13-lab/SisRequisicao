@extends('layouts.app')

@section('page-title')
    Empresas
@endsection

@section('content')
    <a href="{{ route('companies.create') }}" class="btn btn-primary">
        <i class="bi bi-plus-lg"></i>
        Nova empresa
    </a>
    <a href="{{ route('companies.trashed') }}" class="btn btn-secondary">
        <i class="bi bi-trash"></i>
        Empresas Excluídas
    </a>
    <div class="card mt-3">
        <div class="card-body">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Ações</th>
                        <th>Nome</th>
                        <th>CNPJ</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($companies as $company)
                        <tr>
                            <td>
                                <a href="{{ route('companies.edit', $company) }}"
                                class="btn btn-sm btn-secondary">
                                    <i class="bi bi-pencil"></i>
                                    Editar
                                </a>
                                <!-- Button to Open the Modal -->
                                <button type="button" class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#modalDelete{{ $company->id }}">
                                    <i class="bi bi-trash"></i>
                                    Excluir
                                </button>

                                <!-- The Modal -->
                                <div class="modal" id="modalDelete{{ $company->id }}">
                                    <div class="modal-dialog">
                                        <div class="modal-content">

                                        <!-- Modal Header -->
                                        <div class="modal-header">
                                            <h4 class="modal-title">Deletando Registro</h4>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                        </div>

                                        <!-- Modal body -->
                                        <div class="modal-body">
                                            <p>Tem certeza que deseja excluir a empresa {{ $company->name }}?</p>

                                        </div>
                                        <!-- Modal footer -->
                                        <div class="modal-footer"></div>
                                            <form action="{{ route('companies.destroy', $company) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger">Excluir</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </td>
                            <td>{{ $company->name }}</td>
                            <td>{{ $company->docto }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection

