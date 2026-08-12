@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">
        <i class="bi bi-plus-circle"></i>
        Criar Nova Requisição de Serviço
    </h1>

    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('servicerequest.store') }}" method="POST" novalidate>
                        @csrf

                        <!-- EMPRESA -->
                        <div class="mb-3">
                            <label for="empresa_id" class="form-label">
                                <i class="bi bi-building"></i>
                                Empresa <span class="text-danger">*</span>
                            </label>
                            <select 
                                class="form-select @error('empresa_id') is-invalid @enderror" 
                                id="empresa_id" 
                                name="empresa_id" 
                                required>
                                <option value="">-- Selecione uma empresa --</option>
                                <option value="1">Empresa A</option>
                                <option value="2">Empresa B</option>
                                <option value="3">Empresa C</option>
                            </select>
                            @error('empresa_id')
                                <div class="invalid-feedback d-block">
                                    <i class="bi bi-exclamation-circle"></i>
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <!-- DEPARTAMENTO -->
                        <div class="mb-3">
                            <label for="departamento_id" class="form-label">
                                <i class="bi bi-diagram-3"></i>
                                Departamento <span class="text-danger">*</span>
                            </label>
                            <select 
                                class="form-select @error('departamento_id') is-invalid @enderror" 
                                id="departamento_id" 
                                name="departamento_id" 
                                required>
                                <option value="">-- Selecione um departamento --</option>
                                <option value="1">TI</option>
                                <option value="2">RH</option>
                                <option value="3">Financeiro</option>
                                <option value="4">Operações</option>
                            </select>
                            @error('departamento_id')
                                <div class="invalid-feedback d-block">
                                    <i class="bi bi-exclamation-circle"></i>
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <!-- PRIORIDADE -->
                        <div class="mb-3">
                            <label for="prioridade" class="form-label">
                                <i class="bi bi-flag"></i>
                                Prioridade <span class="text-danger">*</span>
                            </label>
                            <select 
                                class="form-select @error('prioridade') is-invalid @enderror" 
                                id="prioridade" 
                                name="prioridade" 
                                required>
                                <option value="">-- Selecione a prioridade --</option>
                                <option value="baixa">Baixa</option>
                                <option value="media">Média</option>
                                <option value="alta">Alta</option>
                            </select>
                            @error('prioridade')
                                <div class="invalid-feedback d-block">
                                    <i class="bi bi-exclamation-circle"></i>
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <!-- DESCRIÇÃO -->
                        <div class="mb-3">
                            <label for="descricao" class="form-label">
                                <i class="bi bi-file-text"></i>
                                Descrição <span class="text-danger">*</span>
                            </label>
                            <textarea 
                                class="form-control @error('descricao') is-invalid @enderror" 
                                id="descricao" 
                                name="descricao" 
                                rows="4" 
                                placeholder="Descreva detalhadamente a requisição..."
                                required>{{ old('descricao') }}</textarea>
                            <small class="form-text text-muted d-block mt-2">
                                Mínimo de 10 caracteres
                            </small>
                            @error('descricao')
                                <div class="invalid-feedback d-block">
                                    <i class="bi bi-exclamation-circle"></i>
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <!-- BOTÕES -->
                        <div class="d-flex gap-2">
                            <button type="submit" class="btn btn-primary">
                                <i class="bi bi-check-circle"></i>
                                Criar Requisição
                            </button>
                            <a href="{{ route('servicerequest.index') }}" class="btn btn-secondary">
                                <i class="bi bi-arrow-left"></i>
                                Cancelar
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- AJUDA LATERAL -->
        <div class="col-md-4">
            <div class="card bg-light">
                <div class="card-header bg-info text-white">
                    <i class="bi bi-info-circle"></i>
                    Ajuda
                </div>
                <div class="card-body">
                    <h6>Campos obrigatórios</h6>
                    <ul class="small">
                        <li><strong>Empresa:</strong> Selecione a empresa responsável</li>
                        <li><strong>Departamento:</strong> Destino da requisição</li>
                        <li><strong>Prioridade:</strong> Urgência da tarefa</li>
                        <li><strong>Descrição:</strong> Detalhes (mínimo 10 caracteres)</li>
                    </ul>

                    <hr>

                    <h6>Após enviar</h6>
                    <ul class="small">
                        <li>A requisição será registrada no sistema</li>
                        <li>Você receberá uma confirmação</li>
                        <li>Poderá acompanhar o status na listagem</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
