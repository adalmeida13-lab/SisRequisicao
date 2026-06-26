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

    <style>
        body {
            background: #f5f7fa;
        }

        .sidebar {
            min-height: 100vh;
            background: #212529;
        }

        .sidebar a {
            color: #ced4da;
            text-decoration: none;
            padding: 12px;
            display: block;
            border-radius: 8px;
            margin-bottom: 5px;
        }

        .sidebar a:hover {
            background: #343a40;
            color: #fff;
        }

        .content {
            padding: 25px;
        }

        .card {
            border: none;
            box-shadow: 0 0 10px rgba(0, 0, 0, .05);
        }

        .navbar-brand {
            font-weight: bold;
        }
    </style>

    @stack('styles')


</head>

<body>

    <nav class="navbar navbar-expand-lg navbar-dark bg-dark shadow-sm">
        <div class="container-fluid">

            <a class="navbar-brand" href="#">
                <i class="bi bi-clipboard-check"></i>
                SISREQUISIÇÃO
            </a>

            <div class="ms-auto">

                @auth
                    <span class="text-white me-3">
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

        <div class="row">

            <div class="col-md-2 sidebar p-3">

                <h6 class="text-light mb-3">
                    MENU
                </h6>

                <a href="#">
                    <i class="bi bi-speedometer2"></i>
                    Dashboard
                </a>

                <a href="#">
                    <i class="bi bi-list-task"></i>
                    Requisições
                </a>

                <a href="#">
                    <i class="bi bi-plus-circle"></i>
                    Nova Requisição
                </a>

                <a href="{{ route('users.index') }}">
                    <i class="bi bi-people"></i>
                    Usuários
                </a>
                <a href="{{ route('companies.index') }}">
                    <i class="bi bi-building"></i>
                    Empresas
                </a>

            </div>

            <div class="col-md-10 content">

                <div class="container-fluid">

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

            </div>

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
