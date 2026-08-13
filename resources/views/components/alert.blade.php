{{-- Componente de Mensagens Flash --}}

@if(session('success'))
<div class="alert alert-success alert-dismissible fade show shadow-sm" 
     role="alert" 
     aria-live="polite"
     aria-atomic="true">
    <div class="d-flex align-items-center">
        <i class="bi bi-check-circle-fill me-2"></i>
        <div>
            <strong>Sucesso!</strong> {{ session('success') }}
        </div>
    </div>
    <button type="button" 
            class="btn-close" 
            data-bs-dismiss="alert" 
            aria-label="Fechar mensagem de sucesso">
    </button>
</div>
@endif

@if(session('error'))
<div class="alert alert-danger alert-dismissible fade show shadow-sm" 
     role="alert" 
     aria-live="assertive"
     aria-atomic="true">
    <div class="d-flex align-items-center">
        <i class="bi bi-exclamation-triangle-fill me-2"></i>
        <div>
            <strong>Erro!</strong> {{ session('error') }}
        </div>
    </div>
    <button type="button" 
            class="btn-close" 
            data-bs-dismiss="alert" 
            aria-label="Fechar mensagem de erro">
    </button>
</div>
@endif

@if(session('warning'))
<div class="alert alert-warning alert-dismissible fade show shadow-sm" 
     role="alert" 
     aria-live="polite"
     aria-atomic="true">
    <div class="d-flex align-items-center">
        <i class="bi bi-exclamation-circle-fill me-2"></i>
        <div>
            <strong>Atenção!</strong> {{ session('warning') }}
        </div>
    </div>
    <button type="button" 
            class="btn-close" 
            data-bs-dismiss="alert" 
            aria-label="Fechar mensagem de aviso">
    </button>
</div>
@endif

@if(session('info'))
<div class="alert alert-info alert-dismissible fade show shadow-sm" 
     role="alert" 
     aria-live="polite"
     aria-atomic="true">
    <div class="d-flex align-items-center">
        <i class="bi bi-info-circle-fill me-2"></i>
        <div>
            <strong>Informação:</strong> {{ session('info') }}
        </div>
    </div>
    <button type="button" 
            class="btn-close" 
            data-bs-dismiss="alert" 
            aria-label="Fechar mensagem informativa">
    </button>
</div>
@endif

@if($errors->any())
<div class="alert alert-danger alert-dismissible fade show shadow-sm" 
     role="alert" 
     aria-live="assertive"
     aria-atomic="true">
    <div class="d-flex align-items-start">
        <i class="bi bi-x-circle-fill me-2 mt-1"></i>
        <div>
            <strong>Atenção!</strong> Foram encontrados os seguintes erros:
            <ul class="mb-0 mt-2">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    </div>
    <button type="button" 
            class="btn-close" 
            data-bs-dismiss="alert" 
            aria-label="Fechar lista de erros">
    </button>
</div>
@endif
