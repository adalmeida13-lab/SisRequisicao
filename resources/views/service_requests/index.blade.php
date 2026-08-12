@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>
            <i class="bi bi-list-task"></i>
            Requisições de Serviço
        </h1>
        <a href="{{ route('servicerequest.create') }}" class="btn btn-primary">
            <i class="bi bi-plus-circle"></i>
            Nova Requisição
        </a>
    </div>

    <!-- FILTROS -->
    <div class="card mb-4 border-0 shadow-sm">
        <div class="card-body">
            <form method="GET" action="{{ route('servicerequest.index') }}" class="row g-3">
                
                <!-- BUSCA POR TEXTO -->
                <div class="col-md-4">
                    <label for="busca" class="form-label">
                        <i class="bi bi-search"></i>
                        Buscar por Descrição
                    </label>
                    <input 
                        type="text" 
                        class="form-control" 
                        id="busca" 
                        name="busca" 
                        placeholder="Digite para filtrar..."
                        value="{{ request('busca') }}">
                </div>

                <!-- FILTRO POR STATUS -->
                <div class="col-md-3">
                    <label for="status" class="form-label">
                        <i class="bi bi-funnel"></i>
                        Status
                    </label>
                    <select class="form-select" id="status" name="status">
                        <option value="">-- Todos os status --</option>
                        <option value="aberta" {{ request('status') === 'aberta' ? 'selected' : '' }}>Aberta</option>
                        <option value="em_andamento" {{ request('status') === 'em_andamento' ? 'selected' : '' }}>Em Andamento</option>
                        <option value="encerrada" {{ request('status') === 'encerrada' ? 'selected' : '' }}>Encerrada</option>
                        <option value="cancelada" {{ request('status') === 'cancelada' ? 'selected' : '' }}>Cancelada</option>
                    </select>
                </div>

                <!-- FILTRO POR PRIORIDADE -->
                <div class="col-md-3">
                    <label for="prioridade" class="form-label">
                        <i class="bi bi-flag"></i>
                        Prioridade
                    </label>
                    <select class="form-select" id="prioridade" name="prioridade">
                        <option value="">-- Todas --</option>
                        <option value="baixa" {{ request('prioridade') === 'baixa' ? 'selected' : '' }}>Baixa</option>
                        <option value="media" {{ request('prioridade') === 'media' ? 'selected' : '' }}>Média</option>
                        <option value="alta" {{ request('prioridade') === 'alta' ? 'selected' : '' }}>Alta</option>
                    </select>
                </div>

                <!-- BOTÕES -->
                <div class="col-md-2 d-flex align-items-end gap-2">
                    <button type="submit" class="btn btn-success w-100">
                        <i class="bi bi-search"></i>
                        Filtrar
                    </button>
                    <a href="{{ route('servicerequest.index') }}" class="btn btn-outline-secondary w-100">
                        <i class="bi bi-arrow-counterclockwise"></i>
                        Limpar
                    </a>
                </div>
            </form>
        </div>
    </div>

    <!-- ESTATÍSTICAS -->
    <div class="row mb-4">
        <div class="col-md-3">
            <div class="card text-center">
                <div class="card-body">
                    <h6 class="card-title">Total</h6>
                    <h3 class="text-primary">{{ $total ?? 0 }}</h3>
                    <small class="text-muted">Requisições</small>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-center">
                <div class="card-body">
                    <h6 class="card-title">Abertas</h6>
                    <h3 class="text-info">{{ $abertas ?? 0 }}</h3>
                    <small class="text-muted">Aguardando</small>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-center">
                <div class="card-body">
                    <h6 class="card-title">Em Andamento</h6>
                    <h3 class="text-warning">{{ $emAndamento ?? 0 }}</h3>
                    <small class="text-muted">Processando</small>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-center">
                <div class="card-body">
                    <h6 class="card-title">Encerradas</h6>
                    <h3 class="text-success">{{ $encerradas ?? 0 }}</h3>
                    <small class="text-muted">Concluídas</small>
                </div>
            </div>
        </div>
    </div>

    <!-- LISTAGEM -->
    <div class="card border-0 shadow-sm">
        <div class="table-responsive">
            <table class="table table-hover mb-0">
                <thead class="table-light">
                    <tr>
                        <th><i class="bi bi-hash"></i> ID</th>
                        <th><i class="bi bi-file-text"></i> Descrição</th>
                        <th><i class="bi bi-diagram-3"></i> Departamento</th>
                        <th><i class="bi bi-flag"></i> Prioridade</th>
                        <th><i class="bi bi-circle-fill"></i> Status</th>
                        <th><i class="bi bi-calendar"></i> Data</th>
                        <th class="text-center"><i class="bi bi-gear"></i> Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($requisicoes ?? [] as $req)
                        <tr>
                            <td class="fw-bold">#{{ $req->id ?? '-' }}</td>
                            <td>
                                <span class="text-truncate d-inline-block" style="max-width: 250px;">
                                    {{ $req->descricao ?? 'Sem descrição' }}
                                </span>
                            </td>
                            <td>
                                <span class="badge bg-secondary">
                                    {{ $req->departamento ?? 'N/A' }}
                                </span>
                            </td>
                            <td>
                                @php
                                    $prioridade = $req->prioridade ?? 'media';
                                    $cor = $prioridade === 'alta' ? 'danger' : ($prioridade === 'media' ? 'warning' : 'info');
                                @endphp
                                <span class="badge bg-{{ $cor }}">
                                    {{ ucfirst($prioridade) }}
                                </span>
                            </td>
                            <td>
                                @php
                                    $status = $req->status ?? 'aberta';
                                    $corStatus = $status === 'aberta' ? 'primary' : 
                                                ($status === 'em_andamento' ? 'warning' : 
                                                ($status === 'encerrada' ? 'success' : 'secondary'));
                                @endphp
                                <span class="badge bg-{{ $corStatus }}">
                                    {{ str_replace('_', ' ', ucfirst($status)) }}
                                </span>
                            </td>
                            <td class="small">
                                {{ $req->data ?? '-' }}
                            </td>
                            <td class="text-center">
                                <div class="btn-group btn-group-sm" role="group">
                                    <a href="{{ route('servicerequest.show', $req->id ?? '#') }}" 
                                       class="btn btn-outline-info" 
                                       title="Visualizar">
                                        <i class="bi bi-eye"></i>
                                    </a>
                                    <a href="{{ route('servicerequest.edit', $req->id ?? '#') }}" 
                                       class="btn btn-outline-warning" 
                                       title="Editar">
                                        <i class="bi bi-pencil"></i>
                                    </a>
                                    <form method="POST" 
                                          action="{{ route('servicerequest.destroy', $req->id ?? '#') }}" 
                                          style="display: inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" 
                                                class="btn btn-outline-danger btn-sm" 
                                                title="Deletar"
                                                onclick="return confirm('Tem certeza?')">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center py-5">
                                <i class="bi bi-inbox" style="font-size: 2rem; color: #ccc;"></i>
                                <p class="text-muted mt-3">Nenhuma requisição encontrada</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- PAGINAÇÃO -->
    <div class="d-flex justify-content-center mt-4">
        @if(isset($requisicoes))
            {{ $requisicoes->links('pagination::bootstrap-5') }}
        @endif
    </div>
</div>
@endsection
