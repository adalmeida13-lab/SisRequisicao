@extends('layouts.app')

@section('content')
    <a href="{{ route('servicerequest.create') }}" class="btn btn-primary">
        <i class="bi bi-plus-lg"></i>
        Nova Requisição
    </a>
    <div class="card">
        <div class="card-body">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Ações</th>
                        <th>Solicitante</th>
                        <th>Departamento</th>
                        <th>Data de Solicitação</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($serviceRequests as $serviceRequest)
                        <tr>
                            <td>
                                <a href="{{ route('servicerequest.edit', $serviceRequest) }}"
                                class="btn btn-sm btn-secondary">
                                    <i class="bi bi-pencil"></i>
                                    Editar
                                </a>
                                <!-- Button to Open the Modal -->
                            <button type="button" class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#modalDelete{{ $serviceRequest->id }}">
                                    <i class="bi bi-trash"></i>
                                    Excluir
                                </button>

                                <!-- The Modal -->
                                <div class="modal" id="modalDelete{{ $serviceRequest->id }}">
                                    <div class="modal-dialog">
                                        <div class="modal-content">

                                        <!-- Modal Header -->
                                        <div class="modal-header">
                                            <h4 class="modal-title">Deletando Registro</h4>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                        </div>

                                        <!-- Modal body -->
                                        <div class="modal-body">
                                            <p>Tem certeza que deseja excluir a requisição {{ $serviceRequest->id }}?</p>
                                        </div>

                                        <!-- Modal footer -->
                                        <div class="modal-footer">
                                            <form action="{{ route('servicerequest.destroy', $serviceRequest) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger">Excluir</button>
                                            </form>
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                                Cancelar
                                            </button>
                                        </div>
                                        </div>
                                    </div>
                                </div>
                            </td>
                            <td>{{ $serviceRequest->requester }}</td>
                            <td>{{ $serviceRequest->department->name ?? 'Nenhum' }}</td>
                            <td>{{ $serviceRequest->request_date }}</td>
                            <td>{{ $serviceRequest->status }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection

