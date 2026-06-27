@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Departamentos Excluídos</h1>

        <table class="table">
            <thead>
                <tr>
                    <th>Ações</th>
                    <th>Nome</th>
                    <th>Empresa</th>

                </tr>
            </thead>
            <tbody>
                @foreach($departments as $department)
                    <tr>
                        <td>
                            <form action="{{ route('departments.restore', $department->id) }}" method="POST" style="display: inline;">
                                @csrf
                                @method('PUT')
                                <button type="button" class = "btn btn-success" data-bs-toggle="modal" data-bs-target="#restoreModal{{ $department->id }}">
                                    <i class="bi bi-undo"></i>
                                    Restaurar
                                </button>
                                <div class="modal fade" id="restoreModal{{ $department->id }}" tabindex="-1" aria-labelledby="restoreModalLabel{{ $department->id }}" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="restoreModalLabel{{ $department->id }}">Restaurar Departamento</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                Tem certeza que deseja restaurar o departamento "{{ $department->name }}"?
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                                                <button type="submit" class="btn btn-success">Restaurar</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                            <form action="{{ route('departments.forceDelete', $department->id) }}" method="POST" style="display: inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger" onclick="return confirm('Tem certeza que deseja excluir permanentemente?')">Excluir Permanente</button>
                            </form>
                        </td>
                        <td>{{ $department->name }}</td>
                        <td>{{ $department->company->name ?? 'Nenhuma' }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
