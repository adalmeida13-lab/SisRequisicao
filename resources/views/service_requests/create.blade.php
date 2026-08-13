@extends('layouts.app')

@section('content')
{{-- SA05-M2: container py-4 padronizado em todas as views --}}
<div class="container py-4">

    {{-- SA05-M2: Breadcrumb adicionado no create (antes: ausente) --}}
    <nav aria-label="breadcrumb" role="navigation">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('servicerequest.index') }}">Requisições</a></li>
            <li class="breadcrumb-item active" aria-current="page">Nova Requisição</li>
        </ol>
    </nav>

    <h1 class="h3 mb-4">
        <i class="bi bi-plus-circle text-primary"></i>
        Criar Nova Requisição de Serviço
    </h1>

    <div class="row">
        <div class="col-md-8">
            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0"><i class="bi bi-pencil-square"></i> Formulário de Requisição</h5>
                </div>
                <div class="card-body">

                    {{-- SA05-M1: Legenda de campos obrigatórios padronizada no topo do form --}}
                    <p class="text-muted small mb-3">
                        <span class="text-danger fw-bold">*</span> Campos obrigatórios
                    </p>

                    <form action="{{ route('servicerequest.store') }}" method="POST" novalidate>
                        @csrf

                        <!-- EMPRESA -->
                        <div class="mb-3">
                            <label for="empresa_id" class="form-label fw-semibold">
                                <i class="bi bi-building"></i>
                                Empresa <span class="text-danger" aria-hidden="true">*</span>
                            </label>
                            @if($companies->isEmpty())
                                <div class="alert alert-warning py-2 small">
                                    <i class="bi bi-exclamation-triangle me-1"></i>
                                    Nenhuma empresa ativa cadastrada. Cadastre uma empresa antes de abrir a requisição.
                                </div>
                            @endif
                            <select 
                                class="form-select @error('empresa_id') is-invalid @enderror" 
                                id="empresa_id" 
                                name="empresa_id" 
                                required
                                {{ $companies->isEmpty() ? 'disabled' : '' }}
                                aria-required="true"
                                aria-describedby="empresa_hint @error('empresa_id') empresa_error @enderror">
                                <option value="">
                                    {{ $companies->isEmpty() ? 'Nenhuma empresa disponível' : 'Selecione uma empresa' }}
                                </option>
                                @foreach($companies as $company)
                                    <option value="{{ $company->id }}" {{ old('empresa_id') == $company->id ? 'selected' : '' }}>
                                        {{ $company->name }}
                                    </option>
                                @endforeach
                            </select>
                            {{-- SA05-M1: dica antes do erro --}}
                            <small id="empresa_hint" class="form-text text-muted">
                                Preencha este campo. Selecione a empresa solicitante.
                            </small>
                            @error('empresa_id')
                                <div id="empresa_error" class="invalid-feedback d-block" role="alert">
                                    <i class="bi bi-exclamation-circle-fill"></i>
                                    {{ $message }} — Selecione uma das opções disponíveis.
                                </div>
                            @enderror
                        </div>

                        <!-- DEPARTAMENTO -->
                        <div class="mb-3">
                            <label for="departamento_id" class="form-label fw-semibold">
                                <i class="bi bi-diagram-3"></i>
                                Departamento <span class="text-danger" aria-hidden="true">*</span>
                            </label>
                            @if($departments->isEmpty())
                                <div class="alert alert-warning py-2 small">
                                    <i class="bi bi-exclamation-triangle me-1"></i>
                                    Nenhum departamento ativo cadastrado. Cadastre um departamento antes de abrir a requisição.
                                </div>
                            @endif
                            <select 
                                class="form-select @error('departamento_id') is-invalid @enderror" 
                                id="departamento_id" 
                                name="departamento_id" 
                                required
                                {{ $departments->isEmpty() ? 'disabled' : '' }}
                                aria-required="true"
                                aria-describedby="departamento_hint @error('departamento_id') departamento_error @enderror">
                                <option value="">
                                    {{ $departments->isEmpty() ? 'Nenhum departamento disponível' : 'Selecione um departamento' }}
                                </option>
                                @foreach($departments as $department)
                                    <option value="{{ $department->id }}" {{ old('departamento_id') == $department->id ? 'selected' : '' }}>
                                        {{ $department->name }}{{ $department->company ? ' — ' . $department->company->name : '' }}
                                    </option>
                                @endforeach
                            </select>
                            <small id="departamento_hint" class="form-text text-muted">
                                Preencha este campo. Selecione o departamento de destino.
                            </small>
                            @error('departamento_id')
                                <div id="departamento_error" class="invalid-feedback d-block" role="alert">
                                    <i class="bi bi-exclamation-circle-fill"></i>
                                    {{ $message }} — Selecione uma das opções disponíveis.
                                </div>
                            @enderror
                        </div>

                        <!-- PRIORIDADE -->
                        <div class="mb-3">
                            <label for="prioridade" class="form-label fw-semibold">
                                <i class="bi bi-flag"></i>
                                Prioridade <span class="text-danger" aria-hidden="true">*</span>
                            </label>
                            <select 
                                class="form-select @error('prioridade') is-invalid @enderror" 
                                id="prioridade" 
                                name="prioridade" 
                                required
                                aria-required="true"
                                aria-describedby="prioridade_hint @error('prioridade') prioridade_error @enderror">
                                <option value="">Selecione a prioridade</option>
                                <option value="baixa" {{ old('prioridade') === 'baixa' ? 'selected' : '' }}>🟢 Baixa — pode aguardar</option>
                                <option value="media" {{ old('prioridade') === 'media' ? 'selected' : '' }}>🟡 Média — prazo normal</option>
                                <option value="alta" {{ old('prioridade') === 'alta' ? 'selected' : '' }}>🔴 Alta — urgente</option>
                            </select>
                            <small id="prioridade_hint" class="form-text text-muted">
                                Preencha este campo. Indique a urgência da requisição.
                            </small>
                            @error('prioridade')
                                <div id="prioridade_error" class="invalid-feedback d-block" role="alert">
                                    <i class="bi bi-exclamation-circle-fill"></i>
                                    {{ $message }} — Escolha Baixa, Média ou Alta.
                                </div>
                            @enderror
                        </div>

                        <!-- DESCRIÇÃO -->
                        <div class="mb-4">
                            <label for="descricao" class="form-label fw-semibold">
                                <i class="bi bi-file-text"></i>
                                Descrição <span class="text-danger" aria-hidden="true">*</span>
                            </label>
                            <textarea 
                                class="form-control @error('descricao') is-invalid @enderror" 
                                id="descricao" 
                                name="descricao" 
                                rows="4" 
                                minlength="10"
                                maxlength="500"
                                placeholder="Descreva detalhadamente o serviço solicitado (o que, onde, para quê)..."
                                required
                                aria-required="true"
                                aria-describedby="descricao_hint @error('descricao') descricao_error @enderror">{{ old('descricao') }}</textarea>
                            {{-- SA05-M1: dica de formato clara e específica --}}
                            <small id="descricao_hint" class="form-text text-muted">
                                Mínimo de 10 caracteres, máximo de 500. Seja objetivo: "O quê + Onde + Para quê".
                            </small>
                            @error('descricao')
                                <div id="descricao_error" class="invalid-feedback d-block" role="alert">
                                    <i class="bi bi-exclamation-circle-fill"></i>
                                    {{ $message }}
                                    @if(str_contains($message, 'mínimo') || str_contains($message, 'least'))
                                        — Digite pelo menos 10 caracteres descrevendo a solicitação.
                                    @elseif(str_contains($message, 'máximo') || str_contains($message, 'most'))
                                        — A descrição está muito longa. Resuma em até 500 caracteres.
                                    @else
                                        — Preencha este campo com detalhes da requisição.
                                    @endif
                                </div>
                            @enderror
                        </div>

                        <!-- BOTÕES -->
                        <div class="d-flex gap-2 flex-wrap">
                            <button type="submit" class="btn btn-primary">
                                <i class="bi bi-check-circle"></i>
                                Criar Requisição
                            </button>
                            <a href="{{ route('servicerequest.index') }}" class="btn btn-outline-secondary">
                                <i class="bi bi-x-circle"></i>
                                Cancelar
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- AJUDA LATERAL -->
        <div class="col-md-4 mt-3 mt-md-0">
            <div class="card shadow-sm">
                <div class="card-header bg-info text-white">
                    <i class="bi bi-info-circle"></i>
                    Instruções de Preenchimento
                </div>
                <div class="card-body small">
                    <h6 class="fw-bold">Campos obrigatórios (<span class="text-danger">*</span>)</h6>
                    <ul class="ps-3">
                        <li><strong>Empresa:</strong> Empresa que faz a solicitação</li>
                        <li><strong>Departamento:</strong> Setor que receberá o serviço</li>
                        <li><strong>Prioridade:</strong> Urgência (Baixa / Média / Alta)</li>
                        <li><strong>Descrição:</strong> Mínimo 10 caracteres — o quê, onde e para quê</li>
                    </ul>

                    <hr class="my-2">

                    <h6 class="fw-bold">Mensagens de validação</h6>
                    <ul class="ps-3 text-muted">
                        <li>"Preencha este campo." = campo vazio</li>
                        <li>"Mínimo X caracteres" = texto muito curto</li>
                        <li>"Selecione uma das opções" = select vazio</li>
                    </ul>

                    <hr class="my-2">

                    <h6 class="fw-bold">Após enviar</h6>
                    <ul class="ps-3">
                        <li>Requisição registrada no sistema</li>
                        <li>Mensagem de confirmação exibida</li>
                        <li>Acompanhe o status na listagem</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
