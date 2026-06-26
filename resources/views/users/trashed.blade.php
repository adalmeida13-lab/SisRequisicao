@extends('layouts.app')

@section('page-title')
    Usuários Excluídos
@endsection

@section('content')
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Usuários Excluídos</h5>
            <p class="card-text">Lista de usuários que foram excluídos.</p>
        </div>
    </div>

    <div class="card mt-3">
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
                                <form action="{{ route('users.restore', $user->id) }}" method="POST" style="display: inline-block;">
                                    @csrf
                                    @method('PUT')

                                    <button type="submit" class="btn btn-sm btn-success">
                                        <i class="bi bi-arrow-counterclockwise"></i>
                                        Restaurar
                                    </button>
                                </form>

                                <form action="{{ route('users.forceDelete', $user->id) }}" method="POST" style="display: inline-block;">
                                    @csrf
                                    @method('DELETE')

                                    <button type="submit" class="btn btn-sm btn-danger">
                                        <i class="bi bi-x-lg"></i>
                                        Excluir Permanentemente
                                    </button>
                                </form>
                            </td>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
@endsection
