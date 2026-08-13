@extends('layouts.app')

@section('content')
<div class="container py-4">
    <!-- Breadcrumb -->
    <nav aria-label="breadcrumb" role="navigation">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('servicerequest.index') }}">Requisições</a></li>
            <li class="breadcrumb-item"><a href="{{ route('servicerequest.show', $serviceRequest->id) }}">Detalhes #{{ $serviceRequest->id }}</a></li>
            <li class="breadcrumb-item active" aria-current="page">Editar</li>
        </ol>
    </nav>

    <h1 class="mb-4">
        <i class="bi bi-pencil-square"></i>
        Editar Requisição de Serviço #{{ $serviceRequest->id }}
    </h1>

    <div class="row">
        <div class="col-md-8">
            <div class="card shadow-sm">
                <div class="card-header bg-warning text-dark">
                    <h5 class="mb-0">Formulário de Edição</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('servicerequest.update', $serviceRequest->id) }}" method="POST" novalidate>
                        @csrf
                        @method('PUT')

                        <!-- EMPRESA (apenas exibição) -->
                        <div class="mb-3">
                            <label for="empresa" class="form-label">
                                <i class="bi bi-building"></i>
                                Empresa
                            </label>
                            <input 
                                type="text" 
                                class="form-control" 
                                id="empresa" 
                                name="empresa" 
                                value="{{ $serviceRequest->empresa ?? 'N/A' }}"
                                disabled
                                readonly>
                            <small class="form-text text-muted">Empresa não pode ser alterada</small>
                        </div>

                        <!-- DEPARTAMENTO (apenas exibição) -->
                        <div class="mb-3">
                            <label for="departamento" class="form-label">
                                <i class="bi bi-diagram-3"></i>
                                Departamento
                            </label>
                            <input 
                                type="text" 
                                class="form-control" 
                                id="departamento" 
                                name="departamento" 
                                value="{{ $serviceRequest->departamento ?? 'N/A' }}"
                                disabled
                                readonly>
                            <small class="form-text text-muted">Departamento não pode ser alterado</small>
                        </div>

                        <!-- DATA (apenas exibição) -->
                        <div class="mb-3">
                            <label for="data" class="form-label">
                                <i class="bi bi-calendar-event"></i>
                                Data de Solicitação
                            </label>
                            <input 
                                type="text" 
                                class="form-control" 
                                id="data" 
                                name="data" 
                                value="{{ isset($serviceRequest->data) ? \Carbon\Carbon::parse($serviceRequest->data)->format('d/m/Y') : 'N/A' }}"
                                disabled
                                readonly>
                            <small class="form-text text-muted">Data original da requisição</small>
                        </div>

                        <!-- STATUS -->
                        <div class="mb-3">
                            <label for="status" class="form-label">
                                <i class="bi bi-check-circle"></i>
                                Status <span class="text-danger">*</span>
                            </label>
                            <select 
                                class="form-select @error('status') is-invalid @enderror" 
                                id="status" 
                                name="status" 
                                required
                                aria-required="true">
                                <option value="">-- Selecione um status --</option>
                                <option value="aberta" {{ old('status', $serviceRequest->status ?? '') == 'aberta' ? 'selected' : '' }}>Aberta</option>
                                <option value="em_andamento" {{ old('status', $serviceRequest->status ?? '') == 'em_andamento' ? 'selected' : '' }}>Em Andamento</option>
                                <option value="encerrada" {{ old('status', $serviceRequest->status ?? '') == 'encerrada' ? 'selected' : '' }}>Encerrada</option>
                                <option value="cancelada" {{ old('status', $serviceRequest->status ?? '') == 'cancelada' ? 'selected' : '' }}>Cancelada</option>
                            </select>
                            @error('status')
                                <div class="invalid-feedback d-block" role="alert">
                                    <i class="bi bi-exclamation-circle"></i>
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <!-- PRIORIDADE -->
                        <div class="mb-3">
                            <label for="prioridade" class="form-label">
                                <i class="bi bi-exclamation-triangle"></i>
                                Prioridade <span class="text-danger">*</span>
                            </label>
                            <select 
                                class="form-select @error('prioridade') is-invalid @enderror" 
                                id="prioridade" 
                                name="prioridade"
                                required
                                aria-required="true">
                                <option value="">-- Selecione a prioridade --</option>
                                <option value="baixa" {{ old('prioridade', $serviceRequest->prioridade ?? '') == 'baixa' ? 'selected' : '' }}>Baixa</option>
                                <option value="media" {{ old('prioridade', $serviceRequest->prioridade ?? '') == 'media' ? 'selected' : '' }}>Média</option>
                                <option value="alta" {{ old('prioridade', $serviceRequest->prioridade ?? '') == 'alta' ? 'selected' : '' }}>Alta</option>
                            </select>
                            @error('prioridade')
                                <div class="invalid-feedback d-block" role="alert">
                                    <i class="bi bi-exclamation-circle"></i>
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <!-- DESCRIÇÃO -->
                        <div class="mb-4">
                            <label for="descricao" class="form-label">
                                <i class="bi bi-text-paragraph"></i>
                                Descrição <span class="text-danger">*</span>
                            </label>
                            <textarea 
                                class="form-control @error('descricao') is-invalid @enderror" 
                                id="descricao" 
                                name="descricao" 
                                rows="4" 
                                placeholder="Descreva detalhes adicionais sobre a requisição..."
                                required
                                aria-required="true"
                                minlength="10"
                                maxlength="500">{{ old('descricao', $serviceRequest->descricao ?? '') }}</textarea>
                            @error('descricao')
                                <div class="invalid-feedback d-block" role="alert">
                                    <i class="bi bi-exclamation-circle"></i>
                                    {{ $message }}
                                </div>
                            @enderror
                            <small class="form-text text-muted">Mínimo 10, máximo 500 caracteres</small>
                        </div>

                        <!-- BOTÕES -->
                        <div class="d-flex gap-2">
                            <button type="submit" class="btn btn-warning" aria-label="Salvar alterações">
                                <i class="bi bi-save"></i>
                                Salvar Alterações
                            </button>
                            <a href="{{ route('servicerequest.show', $serviceRequest->id) }}" 
                               class="btn btn-secondary"
                               aria-label="Cancelar edição">
                                <i class="bi bi-x-circle"></i>
                                Cancelar
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Sidebar de Ajuda -->
        <div class="col-md-4">
            <div class="card shadow-sm">
                <div class="card-header bg-info text-white">
                    <h5 class="mb-0">
                        <i class="bi bi-info-circle"></i> Dicas de Edição
                    </h5>
                </div>
                <div class="card-body">
                    <ul class="list-unstyled">
                        <li class="mb-2">
                            <i class="bi bi-check-circle text-success"></i>
                            <strong>Campos obrigatórios:</strong> Empresa, Departamento, Solicitante, Data e Status
                        </li>
                        <li class="mb-2">
                            <i class="bi bi-exclamation-triangle text-warning"></i>
                            <strong>Atenção:</strong> Alterações no status podem impactar o fluxo de trabalho
                        </li>
                        <li class="mb-2">
                            <i class="bi bi-calendar text-primary"></i>
                            <strong>Data:</strong> Use o formato DD/MM/AAAA
                        </li>
                    </ul>
                </div>
            </div>

            <div class="card shadow-sm mt-3">
                <div class="card-body text-center">
                    <p class="text-muted mb-2">
                        <i class="bi bi-clock-history"></i>
                        <strong>Criado em:</strong><br>
                        {{ $serviceRequest->created_at ? \Carbon\Carbon::parse($serviceRequest->created_at)->format('d/m/Y H:i') : 'N/A' }}
                    </p>
                    @if($serviceRequest->updated_at && $serviceRequest->updated_at != $serviceRequest->created_at)
                    <p class="text-muted">
                        <i class="bi bi-pencil"></i>
                        <strong>Última atualização:</strong><br>
                        {{ \Carbon\Carbon::parse($serviceRequest->updated_at)->format('d/m/Y H:i') }}
                    </p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
