@extends('layouts.app')

@section('page-title')
    Departamentos
@endsection

@section ('content')
    <a href="{{ route('departments.create') }}" class="btn btn-primary mb-3">
        <i class="bi bi-plus-lg"></i>
        Novo departamento
    </a>
    <a href="{{ route('departments.trashed') }}" class="btn btn-secondary mb-3">
        <i class="bi bi-trash"></i>
        Departamentos Excluídos
    </a>
    <div class="card">
        <div class="card-body"></div>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Ações</th>
                        <th>Nome</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($departments as $department)
                        <tr>
                            <td>
                                <a href="{{ route('departments.edit', $department) }}"
                                class="btn btn-sm btn-secondary">
                                    <i class="bi bi-pencil"></i>
                                    Editar
                                </a>
                                <!-- Button to Open the Modal -->
                                <button type="button" class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#modalDelete{{ $department->id }}">
                                    <i class="bi bi-trash"></i>
                                    Excluir
                                </button>

                                <!-- The Modal -->
                                <div class="modal" id="modalDelete{{ $department->id }}">
                                    <div class="modal-dialog">
                                        <div class="modal-content">

                                        <!-- Modal Header -->
                                        <div class="modal-header">
                                            <h4 class="modal-title">Deletando Registro</h4>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                        </div>

                                        <!-- Modal body -->
                                        <div class="modal-body">
                                            <p>Tem certeza que deseja excluir o departamento {{ $department->name }}?</p>
                                        </div>

                                        <!-- Modal footer -->
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                                            <form action="{{ route('departments.destroy', $department) }}" method="POST" class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger">Excluir</button>
                                            </form>
                                        </div>
                                        </div>
                                    </div>
                                </div>
                            </td>
                            <td>{{ $department->name }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection

