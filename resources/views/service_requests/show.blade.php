@extends('layouts.app')

@section('content')
<div class="container py-4">
    <!-- Breadcrumb -->
    <nav aria-label="breadcrumb" role="navigation">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('servicerequest.index') }}">Requisições</a></li>
            <li class="breadcrumb-item active" aria-current="page">Detalhes #{{ $serviceRequest->id }}</li>
        </ol>
    </nav>

    <!-- Cabeçalho -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3">
            <i class="bi bi-file-earmark-text"></i> 
            Detalhes da Requisição #{{ $serviceRequest->id }}
        </h1>
        <div class="btn-group" role="group" aria-label="Ações da requisição">
            <a href="{{ route('servicerequest.edit', $serviceRequest->id) }}" 
               class="btn btn-warning" 
               aria-label="Editar requisição">
                <i class="bi bi-pencil"></i> Editar
            </a>
            <a href="{{ route('servicerequest.index') }}" 
               class="btn btn-secondary"
               aria-label="Voltar para lista">
                <i class="bi bi-arrow-left"></i> Voltar
            </a>
        </div>
    </div>

    <!-- Card Principal -->
    <div class="card shadow-sm mb-4">
        <div class="card-header bg-primary text-white">
            <h5 class="mb-0">Informações da Requisição</h5>
        </div>
        <div class="card-body">
            <div class="row">
                <!-- Coluna Esquerda -->
                <div class="col-md-6">
                    <div class="mb-3">
                        <label class="form-label fw-bold">Empresa:</label>
                        <p class="form-control-plaintext">
                            <i class="bi bi-building"></i> {{ $serviceRequest->empresa ?? 'N/A' }}
                        </p>
                    </div>
                    
                    <div class="mb-3">
                        <label class="form-label fw-bold">Departamento:</label>
                        <p class="form-control-plaintext">
                            <i class="bi bi-diagram-3"></i> {{ $serviceRequest->departamento ?? 'N/A' }}
                        </p>
                    </div>
                    
                    <div class="mb-3">
                        <label class="form-label fw-bold">Data de Solicitação:</label>
                        <p class="form-control-plaintext">
                            <i class="bi bi-calendar-event"></i> 
                            {{ isset($serviceRequest->data) ? \Carbon\Carbon::parse($serviceRequest->data)->format('d/m/Y') : 'N/A' }}
                        </p>
                    </div>
                </div>

                <!-- Coluna Direita -->
                <div class="col-md-6">
                    <div class="mb-3">
                        <label class="form-label fw-bold">Status:</label>
                        <p class="form-control-plaintext">
                            @php
                                $status = $serviceRequest->status ?? 'aberta';
                                $statusMap = [
                                    'aberta' => ['label' => 'Aberta', 'class' => 'warning'],
                                    'em_andamento' => ['label' => 'Em Andamento', 'class' => 'info'],
                                    'encerrada' => ['label' => 'Encerrada', 'class' => 'success'],
                                    'cancelada' => ['label' => 'Cancelada', 'class' => 'danger']
                                ];
                                $statusInfo = $statusMap[$status] ?? ['label' => ucfirst($status), 'class' => 'secondary'];
                            @endphp
                            <span class="badge bg-{{ $statusInfo['class'] }}">
                                {{ $statusInfo['label'] }}
                            </span>
                        </p>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-bold">Prioridade:</label>
                        <p class="form-control-plaintext">
                            @php
                                $prioridade = $serviceRequest->prioridade ?? 'media';
                                $prioridadeMap = [
                                    'alta' => ['label' => 'Alta', 'class' => 'danger'],
                                    'media' => ['label' => 'Média', 'class' => 'warning'],
                                    'baixa' => ['label' => 'Baixa', 'class' => 'success']
                                ];
                                $prioridadeInfo = $prioridadeMap[$prioridade] ?? ['label' => ucfirst($prioridade), 'class' => 'secondary'];
                            @endphp
                            <span class="badge bg-{{ $prioridadeInfo['class'] }}">
                                {{ $prioridadeInfo['label'] }}
                            </span>
                        </p>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-bold">ID da Requisição:</label>
                        <p class="form-control-plaintext text-muted small">
                            #{{ $serviceRequest->id }}
                        </p>
                    </div>
                </div>
            </div>

            <!-- Descrição (se existir) -->
            @if(isset($serviceRequest->descricao) && $serviceRequest->descricao)
            <div class="mt-3 pt-3 border-top">
                <label class="form-label fw-bold">Descrição:</label>
                <p class="form-control-plaintext">{{ $serviceRequest->descricao }}</p>
            </div>
            @endif
        </div>
    </div>

    <!-- Ações Adicionais -->
    <div class="d-flex gap-2">
        <a href="{{ route('servicerequest.edit', $serviceRequest->id) }}" class="btn btn-warning">
            <i class="bi bi-pencil"></i> Editar Requisição
        </a>
        <form action="{{ route('servicerequest.destroy', $serviceRequest->id) }}" 
              method="POST" 
              class="d-inline"
              onsubmit="return confirm('Tem certeza que deseja excluir esta requisição?')">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger" aria-label="Excluir requisição">
                <i class="bi bi-trash"></i> Excluir
            </button>
        </form>
        <a href="{{ route('servicerequest.index') }}" class="btn btn-secondary ms-auto">
            <i class="bi bi-list"></i> Voltar para Lista
        </a>
    </div>
</div>
@endsection 
