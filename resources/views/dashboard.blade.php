@extends('layouts.app')

@section('title', 'Dashboard | Sistema de Requisições')

@section('content')
    <div class="container-fluid py-2">
        <div class="d-flex justify-content-between align-items-center flex-wrap gap-3 mb-4">
            <div>
                <p class="text-primary fw-semibold mb-1">Visão geral</p>
                <h1 class="h3 mb-1">Dashboard</h1>
                <p class="text-muted mb-0">Acompanhe as requisições e acesse rapidamente as funções do sistema.</p>
            </div>

            <a href="{{ route('servicerequest.create') }}" class="btn btn-primary">
                <i class="bi bi-plus-circle me-1"></i>
                Nova requisição
            </a>
        </div>

        <div class="row row-cols-1 row-cols-sm-2 row-cols-xl-4 g-3 mb-4">
            <div class="col">
                <a href="{{ route('servicerequest.index') }}" class="text-decoration-none">
                    <div class="card h-100 dashboard-card border-start border-primary border-4">
                        <div class="card-body d-flex justify-content-between align-items-center">
                            <div>
                                <p class="text-muted text-uppercase small fw-semibold mb-2">Total</p>
                                <h2 class="h3 text-dark mb-0">{{ $total }}</h2>
                                <small class="text-muted">Todas as requisições</small>
                            </div>
                            <span class="dashboard-icon bg-primary-subtle text-primary">
                                <i class="bi bi-clipboard2-check"></i>
                            </span>
                        </div>
                    </div>
                </a>
            </div>

            <div class="col">
                <a href="{{ route('servicerequest.index', ['status' => 'aberta']) }}" class="text-decoration-none">
                    <div class="card h-100 dashboard-card border-start border-info border-4">
                        <div class="card-body d-flex justify-content-between align-items-center">
                            <div>
                                <p class="text-muted text-uppercase small fw-semibold mb-2">Abertas</p>
                                <h2 class="h3 text-dark mb-0">{{ $abertas }}</h2>
                                <small class="text-muted">Aguardando atendimento</small>
                            </div>
                            <span class="dashboard-icon bg-info-subtle text-info">
                                <i class="bi bi-envelope-open"></i>
                            </span>
                        </div>
                    </div>
                </a>
            </div>

            <div class="col">
                <a href="{{ route('servicerequest.index', ['status' => 'em_andamento']) }}" class="text-decoration-none">
                    <div class="card h-100 dashboard-card border-start border-warning border-4">
                        <div class="card-body d-flex justify-content-between align-items-center">
                            <div>
                                <p class="text-muted text-uppercase small fw-semibold mb-2">Em andamento</p>
                                <h2 class="h3 text-dark mb-0">{{ $emAndamento }}</h2>
                                <small class="text-muted">Em atendimento</small>
                            </div>
                            <span class="dashboard-icon bg-warning-subtle text-warning-emphasis">
                                <i class="bi bi-arrow-repeat"></i>
                            </span>
                        </div>
                    </div>
                </a>
            </div>

            <div class="col">
                <a href="{{ route('servicerequest.index', ['status' => 'encerrada']) }}" class="text-decoration-none">
                    <div class="card h-100 dashboard-card border-start border-success border-4">
                        <div class="card-body d-flex justify-content-between align-items-center">
                            <div>
                                <p class="text-muted text-uppercase small fw-semibold mb-2">Encerradas</p>
                                <h2 class="h3 text-dark mb-0">{{ $encerradas }}</h2>
                                <small class="text-muted">Concluídas</small>
                            </div>
                            <span class="dashboard-icon bg-success-subtle text-success">
                                <i class="bi bi-check2-circle"></i>
                            </span>
                        </div>
                    </div>
                </a>
            </div>
        </div>

        <div class="row g-4">
            <div class="col-12 col-xl-8">
                <div class="card h-100">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <div>
                                <h2 class="h5 mb-1">Requisições recentes</h2>
                                <p class="text-muted small mb-0">Últimas solicitações registradas no sistema.</p>
                            </div>
                            <a href="{{ route('servicerequest.index') }}" class="btn btn-sm btn-outline-primary">Ver todas</a>
                        </div>

                        @if ($recentRequests->isEmpty())
                            <div class="text-center text-muted py-5">
                                <i class="bi bi-inbox fs-1 d-block mb-2"></i>
                                Nenhuma requisição cadastrada.
                            </div>
                        @else
                            <div class="table-responsive">
                                <table class="table align-middle mb-0">
                                    <thead class="table-light">
                                        <tr>
                                            <th>Requisição</th>
                                            <th class="d-none d-md-table-cell">Departamento</th>
                                            <th>Status</th>
                                            <th class="text-end">Data</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($recentRequests as $request)
                                            @php
                                                $statusLabels = [
                                                    'aberta' => 'Aberta',
                                                    'em_andamento' => 'Em andamento',
                                                    'encerrada' => 'Encerrada',
                                                    'cancelada' => 'Cancelada',
                                                ];
                                                $statusColors = [
                                                    'aberta' => 'primary',
                                                    'em_andamento' => 'warning',
                                                    'encerrada' => 'success',
                                                    'cancelada' => 'secondary',
                                                ];
                                                $status = $request->status ?? 'aberta';
                                            @endphp
                                            <tr>
                                                <td>
                                                    <a href="{{ route('servicerequest.show', $request->id) }}" class="fw-semibold text-decoration-none">
                                                        #{{ $request->id }}
                                                    </a>
                                                    <span class="d-block text-muted small text-truncate" style="max-width: 280px;">
                                                        {{ $request->descricao }}
                                                    </span>
                                                </td>
                                                <td class="d-none d-md-table-cell">{{ $request->departamento }}</td>
                                                <td>
                                                    <span class="badge text-bg-{{ $statusColors[$status] ?? 'secondary' }}">
                                                        {{ $statusLabels[$status] ?? ucfirst($status) }}
                                                    </span>
                                                </td>
                                                <td class="text-end text-muted small">
                                                    {{ \Carbon\Carbon::parse($request->data)->format('d/m/Y') }}
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            <div class="col-12 col-xl-4">
                <div class="card mb-4">
                    <div class="card-body">
                        <h2 class="h5 mb-1">Resumo por status</h2>
                        <p class="text-muted small mb-4">Distribuição atual das requisições.</p>

                        @php
                            $statusSummary = [
                                ['label' => 'Abertas', 'value' => $abertas, 'color' => 'info'],
                                ['label' => 'Em andamento', 'value' => $emAndamento, 'color' => 'warning'],
                                ['label' => 'Encerradas', 'value' => $encerradas, 'color' => 'success'],
                                ['label' => 'Canceladas', 'value' => $canceladas, 'color' => 'secondary'],
                            ];
                        @endphp

                        @foreach ($statusSummary as $item)
                            @php $percentage = $total > 0 ? round(($item['value'] / $total) * 100) : 0; @endphp
                            <div class="mb-3">
                                <div class="d-flex justify-content-between small mb-1">
                                    <span>{{ $item['label'] }}</span>
                                    <span class="text-muted">{{ $item['value'] }} ({{ $percentage }}%)</span>
                                </div>
                                <div class="progress" role="progressbar" aria-label="{{ $item['label'] }}" aria-valuenow="{{ $percentage }}" aria-valuemin="0" aria-valuemax="100">
                                    <div class="progress-bar bg-{{ $item['color'] }}" style="width: {{ $percentage }}%"></div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

                <div class="card">
                    <div class="card-body">
                        <h2 class="h5 mb-3">Acesso rápido</h2>
                        <div class="d-grid gap-2">
                            <a href="{{ route('servicerequest.create') }}" class="btn btn-primary text-start">
                                <i class="bi bi-plus-circle me-2"></i> Abrir requisição
                            </a>
                            <a href="{{ route('companies.index') }}" class="btn btn-outline-secondary text-start">
                                <i class="bi bi-building me-2"></i> Gerenciar empresas
                            </a>
                            <a href="{{ route('departments.index') }}" class="btn btn-outline-secondary text-start">
                                <i class="bi bi-diagram-3 me-2"></i> Gerenciar departamentos
                            </a>
                            <a href="{{ route('users.index') }}" class="btn btn-outline-secondary text-start">
                                <i class="bi bi-people me-2"></i> Gerenciar usuários
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('styles')
    <style>
        .dashboard-card {
            transition: transform .2s ease, box-shadow .2s ease;
        }

        .dashboard-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 .5rem 1rem rgba(0, 0, 0, .1);
        }

        .dashboard-icon {
            width: 46px;
            height: 46px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            border-radius: 12px;
            font-size: 1.35rem;
        }
    </style>
@endpush
