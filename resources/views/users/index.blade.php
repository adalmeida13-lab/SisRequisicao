@extends('layouts.app')

@section('page-title')
    Usuários
@endsection

@section('content')
    <a href="{{ route('users.create') }}" class="btn btn-primary">
        <i class="bi bi-plus-lg"></i>
        Novo usuário
    </a>
    <a href="{{ route('users.trashed') }}" class="btn btn-secondary">
        <i class="bi bi-trash"></i>
        Usuários Excluídos
    </a>
    <div class="card">
        <div class="card-body">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Ações</th>
                        <th>Nome</th>
                        <th>Email</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($users as $user)
                        <tr>
                             <td>
                                <a href="{{ route('users.edit', $user) }}"
                                class="btn btn-sm btn-secondary">
                                    <i class="bi bi-pencil"></i>
                                    Editar
                                </a>
                                <!-- Button to Open the Modal -->
                                <button type="button" class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#modalDelete{{ $user->id }}">
                                    <i class="bi bi-trash"></i>
                                    Excluir
                                </button>

                                <!-- The Modal -->
                                <div class="modal" id="modalDelete{{ $user->id }}">
                                    <div class="modal-dialog">
                                        <div class="modal-content">

                                        <!-- Modal Header -->
                                        <div class="modal-header">
                                            <h4 class="modal-title">Deletando Registro</h4>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                        </div>

                                        <!-- Modal body -->
                                        <div class="modal-body">
                                            <p>Tem certeza que deseja excluir o usuário {{ $user->name }}?</p>
                                        </div>

                                        <!-- Modal footer -->
                                        <div class="modal-footer">
                                            <form action="{{ route('users.destroy', $user) }}" method="POST">
                                                @csrf
                                                @method('DELETE')

                                                <button type="submit" class="btn btn-danger">
                                                    <i class="bi bi-trash"></i>
                                                    Sim! Excluir
                                                </button>
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                                    Não! Cancelar
                                                </button>
                                            </form>
                                        </div>

                                        </div>
                                    </div>
                                </div>

                                <a href="{{ route('users.show', $user) }}"
                                class="btn btn-sm btn-secondary">
                                    <i class="bi bi-eye"></i>
                                    Visualizar
                                </a>

                            </td>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
