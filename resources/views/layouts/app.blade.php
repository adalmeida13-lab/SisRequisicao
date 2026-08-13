<!DOCTYPE html>

<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Sistema de Requisições')</title>


    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

    <link href="{{ asset('css/custom-styles.css') }}" rel="stylesheet">

    @stack('styles')


</head>

<body>

    <nav class="navbar navbar-expand-lg navbar-dark app-navbar shadow-sm">
        <div class="container-fluid">

            <a class="navbar-brand" href="{{ route('dashboard') }}">
                <i class="bi bi-clipboard-check"></i>
                SISREQUISIÇÃO
            </a>

            <div class="ms-auto">

                @auth
                    <span class="user-chip text-white me-3">
                        <i class="bi bi-person-circle"></i>
                        {{ Auth::user()->name }}
                    </span>

                    <form method="POST" action="{{ route('logout') }}" class="d-inline">
                        @csrf

                        <button class="btn btn-outline-light btn-sm">
                            Sair
                        </button>
                    </form>
                @endauth

            </div>

        </div>

    </nav>

    <div class="container-fluid">

        <div class="row app-shell">

            <aside class="col-md-2 sidebar p-3">

                <div class="sidebar-label">Navegação</div>

                <a href="{{ route('dashboard') }}" class="{{ request()->routeIs('dashboard') ? 'active' : '' }}" aria-current="{{ request()->routeIs('dashboard') ? 'page' : 'false' }}">
                    <i class="bi bi-speedometer2"></i>
                    Dashboard
                </a>

                <a href="{{ route('servicerequest.index') }}" class="{{ request()->routeIs('servicerequest.index', 'servicerequest.show', 'servicerequest.edit') ? 'active' : '' }}" aria-current="{{ request()->routeIs('servicerequest.index', 'servicerequest.show', 'servicerequest.edit') ? 'page' : 'false' }}">
                    <i class="bi bi-list-task"></i>
                    Requisições
                </a>

                <a href="{{ route('servicerequest.create') }}" class="{{ request()->routeIs('servicerequest.create') ? 'active' : '' }}" aria-current="{{ request()->routeIs('servicerequest.create') ? 'page' : 'false' }}">
                    <i class="bi bi-plus-circle"></i>
                    Nova Requisição
                </a>

                <a href="{{ route('users.index') }}" class="{{ request()->routeIs('users.*') ? 'active' : '' }}" aria-current="{{ request()->routeIs('users.*') ? 'page' : 'false' }}">
                    <i class="bi bi-people"></i>
                    Usuários
                </a>
                <a href="{{ route('companies.index') }}" class="{{ request()->routeIs('companies.*') ? 'active' : '' }}" aria-current="{{ request()->routeIs('companies.*') ? 'page' : 'false' }}">
                    <i class="bi bi-building"></i>
                    Empresas
                </a>
                <a href="{{ route('departments.index') }}" class="{{ request()->routeIs('departments.*') ? 'active' : '' }}" aria-current="{{ request()->routeIs('departments.*') ? 'page' : 'false' }}">
                    <i class="bi bi-diagram-3"></i>
                    Departamentos
                </a>

            </aside>

            <main class="col-md-10 content">

                <div class="container-fluid content-inner">

                    @hasSection('page-title')
                        <div class="page-header">
                            <div>
                                <div class="page-eyebrow">Sistema de requisições</div>
                                <h1 class="page-title">@yield('page-title')</h1>
                            </div>
                        </div>
                    @endif

                    @if ($errors->any())

                        <div class="alert alert-danger">

                            <strong>
                                Foram encontrados erros:
                            </strong>

                            <ul class="mb-0">

                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach

                            </ul>

                        </div>

                    @endif

                    @yield('content')

                </div>

            </main>

        </div>

    </div>

    <!-- Toast Success -->

    @if (session('success'))
        <div class="toast-container position-fixed bottom-0 end-0 p-3">

            <div class="toast show text-bg-success border-0">

                <div class="d-flex">

                    <div class="toast-body">

                        <i class="bi bi-check-circle-fill"></i>

                        {{ session('success') }}

                    </div>

                    <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast">
                    </button>

                </div>

            </div>

        </div>
    @endif

    <!-- Toast Error -->

    @if (session('error'))
        <div class="toast-container position-fixed bottom-0 end-0 p-3">

            <div class="toast show text-bg-danger border-0">

                <div class="d-flex">

                    <div class="toast-body">

                        <i class="bi bi-exclamation-triangle-fill"></i>

                        {{ session('error') }}

                    </div>

                    <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast">
                    </button>

                </div>

            </div>

        </div>
    @endif

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {

            let toastElList = document.querySelectorAll('.toast');

            toastElList.forEach(function(toastEl) {

                let toast = new bootstrap.Toast(toastEl, {
                    delay: 5000
                });

                toast.show();

            });

        });
    </script>

    @stack('scripts')

</body>

</html>
