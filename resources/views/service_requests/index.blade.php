@extends('layouts.app')

@section('content')
{{-- SA05-M2: Padronizado container py-4 (antes: container-fluid sem padding) --}}
<div class="container py-4">

    {{-- SA05-M2: Breadcrumb adicionado no index (antes: ausente) --}}
    <nav aria-label="breadcrumb" role="navigation">
        <ol class="breadcrumb">
            <li class="breadcrumb-item active" aria-current="page">Requisições</li>
        </ol>
    </nav>

    <div class="d-flex justify-content-between align-items-center mb-4 flex-wrap gap-2">
        <h1 class="h3">
            <i class="bi bi-list-task text-primary"></i>
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
    {{-- SA05-M2+M3: cards padronizados com shadow-sm e responsivos --}}
    <div class="row row-cols-2 row-cols-md-4 g-3 mb-4">
        <div class="col">
            <div class="card text-center shadow-sm h-100 card-stat">
                <div class="card-body">
                    <i class="bi bi-clipboard-list fs-3 text-primary mb-1"></i>
                    <h6 class="card-title text-muted small text-uppercase mb-1">Total</h6>
                    <h3 class="text-primary fw-bold mb-0">{{ $total ?? 0 }}</h3>
                    <small class="text-muted">Requisições</small>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card text-center shadow-sm h-100 card-stat">
                <div class="card-body">
                    <i class="bi bi-hourglass-split fs-3 text-info mb-1"></i>
                    <h6 class="card-title text-muted small text-uppercase mb-1">Abertas</h6>
                    <h3 class="text-info fw-bold mb-0">{{ $abertas ?? 0 }}</h3>
                    <small class="text-muted">Aguardando</small>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card text-center shadow-sm h-100 card-stat">
                <div class="card-body">
                    <i class="bi bi-arrow-repeat fs-3 text-warning mb-1"></i>
                    <h6 class="card-title text-muted small text-uppercase mb-1">Em Andamento</h6>
                    <h3 class="text-warning fw-bold mb-0">{{ $emAndamento ?? 0 }}</h3>
                    <small class="text-muted">Processando</small>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card text-center shadow-sm h-100 card-stat">
                <div class="card-body">
                    <i class="bi bi-check-circle fs-3 text-success mb-1"></i>
                    <h6 class="card-title text-muted small text-uppercase mb-1">Encerradas</h6>
                    <h3 class="text-success fw-bold mb-0">{{ $encerradas ?? 0 }}</h3>
                    <small class="text-muted">Concluídas</small>
                </div>
            </div>
        </div>
    </div>

    <!-- LISTAGEM -->
    {{-- SA05-M3: table-responsive garante scroll horizontal em mobile --}}
    <div class="card border-0 shadow-sm">
        <div class="table-responsive">
            <table class="table table-hover mb-0" aria-label="Lista de requisições de serviço">
                <thead class="table-light">
                    <tr>
                        <th scope="col"><i class="bi bi-hash"></i> ID</th>
                        <th scope="col"><i class="bi bi-file-text"></i> Descrição</th>
                        <th scope="col" class="d-none d-md-table-cell"><i class="bi bi-diagram-3"></i> Departamento</th>
                        <th scope="col"><i class="bi bi-flag"></i> Prioridade</th>
                        <th scope="col"><i class="bi bi-circle-fill"></i> Status</th>
                        <th scope="col" class="d-none d-lg-table-cell"><i class="bi bi-calendar"></i> Data</th>
                        <th scope="col" class="text-center"><i class="bi bi-gear"></i> Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($requisicoes ?? [] as $req)
                        <tr>
                            <td class="fw-bold">#{{ $req->id ?? '-' }}</td>
                            <td>
                                <span class="d-inline-block text-truncate" style="max-width: 200px;" 
                                      title="{{ $req->descricao ?? '' }}">
                                    {{ $req->descricao ?? 'Sem descrição' }}
                                </span>
                            </td>
                            <td class="d-none d-md-table-cell">
                                <span class="badge bg-secondary">
                                    {{ $req->departamento ?? 'N/A' }}
                                </span>
                            </td>
                            <td>
                                @php
                                    $prioridade = $req->prioridade ?? 'media';
                                    $cor = $prioridade === 'alta' ? 'danger' : ($prioridade === 'media' ? 'warning' : 'info');
                                    $labelPrioridade = ['baixa' => 'Baixa', 'media' => 'Média', 'alta' => 'Alta'][$prioridade] ?? ucfirst($prioridade);
                                @endphp
                                <span class="badge bg-{{ $cor }}">
                                    {{ $labelPrioridade }}
                                </span>
                            </td>
                            <td>
                                @php
                                    $status = $req->status ?? 'aberta';
                                    $corStatus = ['aberta' => 'primary', 'em_andamento' => 'warning', 'encerrada' => 'success', 'cancelada' => 'secondary'][$status] ?? 'secondary';
                                    $labelStatus = ['aberta' => 'Aberta', 'em_andamento' => 'Em Andamento', 'encerrada' => 'Encerrada', 'cancelada' => 'Cancelada'][$status] ?? ucfirst($status);
                                @endphp
                                <span class="badge bg-{{ $corStatus }}">
                                    {{ $labelStatus }}
                                </span>
                            </td>
                            <td class="small d-none d-lg-table-cell">
                                {{ $req->data ?? '-' }}
                            </td>
                            {{-- SA05-M1+M3: botões com aria-label descritivo --}}
                            <td class="text-center">
                                <div class="btn-group btn-group-sm" role="group" aria-label="Ações da requisição #{{ $req->id }}">
                                    <a href="{{ route('servicerequest.show', $req->id ?? '#') }}" 
                                       class="btn btn-outline-info" 
                                       aria-label="Visualizar requisição #{{ $req->id }}">
                                        <i class="bi bi-eye" aria-hidden="true"></i>
                                    </a>
                                    <a href="{{ route('servicerequest.edit', $req->id ?? '#') }}" 
                                       class="btn btn-outline-warning"
                                       aria-label="Editar requisição #{{ $req->id }}">
                                        <i class="bi bi-pencil" aria-hidden="true"></i>
                                    </a>
                                    <form method="POST" 
                                          action="{{ route('servicerequest.destroy', $req->id ?? '#') }}" 
                                          style="display: inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" 
                                                class="btn btn-outline-danger btn-sm"
                                                aria-label="Excluir requisição #{{ $req->id }}"
                                                onclick="return confirm('Tem certeza que deseja excluir a requisição #{{ $req->id }}?')">
                                            <i class="bi bi-trash" aria-hidden="true"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center py-5">
                                <i class="bi bi-inbox fs-1 text-muted" aria-hidden="true"></i>
                                <p class="text-muted mt-2 mb-0">Nenhuma requisição encontrada</p>
                                <a href="{{ route('servicerequest.create') }}" class="btn btn-sm btn-primary mt-3">
                                    <i class="bi bi-plus-circle"></i> Criar primeira requisição
                                </a>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

</div>
@endsection
