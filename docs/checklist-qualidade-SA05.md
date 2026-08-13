# Checklist de Qualidade do Front-End — SA05
## SisRequisição — Refinamento e Padronização

**UC:** Desenvolvimento de Sistemas  
**Equipe:** Jorladson, Ademilson, Marcos  
**Data:** 13/08/2026  
**Branch:** `jorladson`  
**Repositório:** https://github.com/adalmeida13-lab/SisRequisicao

---

## Melhorias Escolhidas (4 de 7)

| Nº | Melhoria | Arquivos Afetados | Status |
|----|----------|------------------|--------|
| M1 | ✅ Mensagens de validação mais claras | `create.blade.php`, `alert.blade.php`, `ServiceRequestController.php` | Implementada |
| M2 | ✅ Padronização de layout | `create.blade.php`, `index.blade.php`, `show.blade.php`, `edit.blade.php` | Implementada |
| M3 | ✅ Responsividade mínima | `custom-styles.css` (seção 4) | Implementada |
| M4 | ✅ Refatoração leve (CSS) | `custom-styles.css` (seções 6, 7, 8) | Implementada |

---

## M1 — Mensagens de Validação Mais Claras

**Arquivo principal:** `resources/views/service_requests/create.blade.php`  
**Padrão documentado em:** `docs/decisoes.md` (seção 1)

### Problema identificado

As mensagens de validação antes da SA05 eram genéricas e sem orientação ao usuário:

```blade
{{-- ANTES (SA02/SA03) --}}
@error('empresa_id')
    <div class="invalid-feedback d-block">
        <i class="bi bi-exclamation-circle"></i>
        {{ $message }}
    </div>
@enderror
```

Problemas:
- Sem dica antes do erro (usuário não sabia o que preencher)
- Mensagem genérica: "The empresa id field is required." (inglês do Laravel)
- Sem conexão acessível entre campo e mensagem (`aria-describedby`)
- Sem diferenciação entre "campo vazio" e "formato inválido"

### O que foi implementado

```blade
{{-- DEPOIS (SA05-M1) --}}
<select 
    ...
    aria-required="true"
    aria-describedby="empresa_hint empresa_error">  {{-- conexão campo → dica + erro --}}
    ...
</select>

{{-- Dica sempre visível (instrução preventiva) --}}
<small id="empresa_hint" class="form-text text-muted">
    Preencha este campo. Selecione a empresa solicitante.
</small>

{{-- Erro com complemento específico --}}
@error('empresa_id')
    <div id="empresa_error" class="invalid-feedback d-block" role="alert">
        <i class="bi bi-exclamation-circle-fill"></i>
        {{ $message }} — Selecione uma das opções disponíveis.
    </div>
@enderror
```

### Melhorias específicas aplicadas

1. **Legenda "* Campos obrigatórios"** no topo do formulário (antes: ausente)
2. **Dica preventiva** abaixo de cada campo com `<small id="campo_hint">` 
3. **Complemento específico** na mensagem de erro por tipo de problema
4. **Campo descrição:** texto especifica mínimo e máximo explicitamente: *"Mínimo de 10 caracteres, máximo de 500. Seja objetivo: O quê + Onde + Para quê."*
5. **Select de prioridade:** opções com emoji e descrição: *"🔴 Alta — urgente"* (antes: só "Alta")
6. **`aria-describedby`** ligando campo ao hint e ao erro para leitores de tela

### CSS adicionado para padronizar feedback (custom-styles.css — seção 7)

```css
/* ANTES: sem estilo customizado, usava só Bootstrap padrão */

/* DEPOIS (SA05-M1): */
.form-control.is-invalid,
.form-select.is-invalid {
    border-color: var(--danger-color);
    border-width: 2px;           /* borda mais visível */
    background-image: none;      /* remove ícone padrão Bootstrap */
}

.invalid-feedback.d-block {
    margin-top: 0.35rem;
    font-size: 0.85rem;
    color: var(--danger-color);
    display: flex;               /* alinha ícone + texto */
    align-items: center;
    gap: 0.3rem;
}
```

---

## M2 — Padronização de Layout

**Arquivos:** todas as 4 views de `resources/views/service_requests/`  
**Padrão documentado em:** `docs/decisoes.md` (seções 3.1, 3.2, 3.4)

### Problema identificado

Antes da SA05, as views tinham containers e estruturas inconsistentes:

| View | Container antes | Breadcrumb antes | Card header antes |
|------|----------------|-----------------|-----------------|
| `index.blade.php` | `container-fluid` (sem padding) | ❌ Ausente | ❌ Ausente |
| `create.blade.php` | `container` (sem `py-4`) | ❌ Ausente | ❌ Ausente |
| `show.blade.php` | `container py-4` | ✅ Presente | ✅ `bg-primary` |
| `edit.blade.php` | `container py-4` | ✅ Presente | ✅ `bg-warning` |

**Resultado:** usuário via layout diferente dependendo da tela acessada.

### O que foi implementado

**Padrão unificado para TODAS as views:**

```blade
{{-- DEPOIS (SA05-M2): padrão único --}}
<div class="container py-4">

    <nav aria-label="breadcrumb" role="navigation">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="[rota pai]">[Título pai]</a></li>
            <li class="breadcrumb-item active" aria-current="page">[Título atual]</li>
        </ol>
    </nav>

    <h1 class="h3 mb-4">
        <i class="bi bi-[ícone] text-primary"></i>
        [Título da página]
    </h1>
```

**Breadcrumbs adicionados em:**

| View | Hierarquia de navegação |
|------|------------------------|
| `index.blade.php` | Requisições (atual) |
| `create.blade.php` | Requisições > Nova Requisição (atual) |
| `show.blade.php` | Requisições > Detalhes #N (atual) — já existia |
| `edit.blade.php` | Requisições > Detalhes #N > Editar (atual) — já existia |

**Cards de estatística padronizados (index.blade.php):**

```blade
{{-- ANTES: sem ícone, sem sombra, sem altura uniforme --}}
<div class="col-md-3">
    <div class="card text-center">
        <div class="card-body">
            <h6 class="card-title">Total</h6>
            <h3 class="text-primary">{{ $total ?? 0 }}</h3>
        </div>
    </div>
</div>

{{-- DEPOIS: ícone, sombra, altura uniforme, responsivo --}}
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
```

---

## M3 — Responsividade Mínima

**Arquivo:** `public/css/custom-styles.css` (seção 4)  
**Testado em:** 390px (mobile), 768px (tablet), 1366px (desktop)

### Problema identificado

Antes da SA05, o CSS só tinha um breakpoint (`max-width: 768px`) com poucos ajustes:

```css
/* ANTES (SA03): 1 breakpoint, 4 regras */
@media (max-width: 768px) {
    .filter-section { padding: var(--spacing-md); }
    .card-stat { margin-bottom: var(--spacing-md); }
    .table-custom { font-size: 0.875rem; }
    .btn-action-group { flex-direction: column; }
}
```

Problemas:
- Tabela sem scroll horizontal em mobile → overflow e quebra de layout
- Cards de estatística: 4 em linha em 390px → muito apertado
- Breadcrumb com tamanho normal → ocupa muito espaço em mobile
- Botões do form sem `flex-wrap` → saíam do container

### O que foi implementado

```css
/* DEPOIS (SA05-M3): 4 breakpoints com regras específicas */

/* Mobile: até 576px */
@media (max-width: 576px) {
    h1.h3 { font-size: 1.25rem; }          /* título menor */
    .breadcrumb { font-size: 0.85rem; }    /* breadcrumb menor */
    /* filtros em coluna única */
    .filter-section .row > [class*="col-"] {
        width: 100%;
        margin-bottom: 0.5rem;
    }
}

/* Tablet: 576px–768px */
@media (min-width: 576px) and (max-width: 768px) {
    .filter-section { padding: var(--spacing-md); }
    .table { font-size: 0.875rem; }
    .btn-action-group { flex-direction: row; }
}

/* Desktop: ≥ 768px */
@media (min-width: 768px) {
    .filter-section { padding: var(--spacing-lg); }
    .table { font-size: 1rem; }
}
```

**Na tabela (HTML):** colunas ocultadas em mobile via classes Bootstrap:

```blade
{{-- DEPOIS: colunas condicionais --}}
<th class="d-none d-md-table-cell">Departamento</th>  {{-- oculta < 768px --}}
<th class="d-none d-lg-table-cell">Data</th>          {{-- oculta < 992px --}}
```

**Nos cards de estatística:**

```blade
{{-- ANTES: col-md-3 → 4 colunas em qualquer tela --}}
<div class="col-md-3">

{{-- DEPOIS: 2 colunas em mobile, 4 em desktop --}}
<div class="row row-cols-2 row-cols-md-4 g-3">
```

---

## M4 — Refatoração Leve do CSS

**Arquivo:** `public/css/custom-styles.css` (seções 6, 7, 8)  
**Padrão documentado em:** `docs/decisoes.md` (seção 2.4)

### Problema identificado

Antes da SA05, o CSS tinha redundâncias:

```css
/* ANTES: 5 seletores repetindo a mesma propriedade */
button:focus,
a:focus,
input:focus,
select:focus,
textarea:focus {
    outline: 2px solid var(--primary-color);
    outline-offset: 2px;
}
```

Outros problemas:
- Seção de acessibilidade misturava skip-link e foco visível
- Sem estilo padronizado para `.invalid-feedback` (cada view usava Bootstrap padrão)
- Sem estilo para link ativo no menu de navegação
- Sem seção dedicada ao breadcrumb

### O que foi implementado

```css
/* DEPOIS: 1 seletor moderno substitui 5 (SA05-M4) */
:focus-visible {
    outline: 2px solid var(--primary-color);
    outline-offset: 3px;
    border-radius: 3px;
}

/* Compatibilidade: remove outline antigo quando :focus-visible disponível */
button:focus:not(:focus-visible),
a:focus:not(:focus-visible) { outline: none; }
```

**Novas seções adicionadas:**

| Seção | CSS | Descrição |
|-------|-----|-----------|
| Seção 7 | `/* VALIDAÇÃO */` | Estilo para `.is-invalid`, `.is-valid`, `.invalid-feedback` |
| Seção 8 | `/* NAVEGAÇÃO */` | Link ativo no menu `.nav-link.active`, breadcrumb padronizado |

**Redução de repetição:**

| Antes | Depois |
|-------|--------|
| 5 seletores de foco | 1 seletor `:focus-visible` |
| 0 estilos de validação | 6 regras na seção 7 |
| 0 estilos de breadcrumb | 3 regras na seção 8 |

---

## Registro de Padrões do Time (mínimo 3 — veja detalhes em `docs/decisoes.md`)

### Padrão 1: Validação e Mensagens

```
Campo obrigatório vazio: "Preencha este campo."
Formato inválido: "Formato inválido. Verifique e tente novamente."
Mensagem de sucesso: "Operação realizada com sucesso!"
Complemento por tipo: descrição + instrução específica do campo
```

### Padrão 2: Nomes

```
Arquivos: kebab-case (custom-styles.css, decisoes.md)
Controllers: PascalCase + Controller (ServiceRequestController)
Variáveis PHP: camelCase ($serviceRequest, $requisicoes)
Classes CSS: kebab-case (.card-stat, .filter-section)
Variáveis CSS: --kebab-case (--primary-color, --spacing-md)
IDs de hint: campo_hint, campo_error
```

### Padrão 3: Visual Mínimo

```
Espaçamento base: --spacing-md = 1rem (16px)
Entre campos de formulário: mb-3 (Bootstrap)
Botão primário: btn btn-primary + ícone à esquerda
Botão cancelar: btn btn-outline-secondary, sempre à direita do submit
Status: bg-primary (aberta), bg-warning (andamento), bg-success (encerrada)
Prioridade: bg-danger (alta), bg-warning (média), bg-info (baixa)
Container padrão: container py-4 em todas as views
```

---

## Rastreabilidade — Commits da SA05

| Commit | Tipo | Melhoria | Descrição |
|--------|------|---------|-----------|
| `feat(SA05-M1)` | feat | M1 | Mensagens de validação mais claras em create.blade.php |
| `style(SA05-M2)` | style | M2 | Padroniza container, breadcrumbs e cards em index.blade.php |
| `refactor(SA05-M3+M4)` | refactor | M3+M4 | CSS responsivo e refatoração de foco/validação |
| `docs(SA05)` | docs | — | Cria decisoes.md e checklist-qualidade-SA05.md |

---

## Relato Objetivo do Grupo

### O que foi melhorado (SA05)

Na SA05, refinamos o front-end do SisRequisição em 4 frentes. Padronizamos as mensagens de validação: agora cada campo tem uma dica preventiva visível e uma mensagem de erro complementada com instrução específica, conectadas ao campo via `aria-describedby`. O layout foi unificado com `container py-4` e breadcrumbs em todas as 4 views, eliminando inconsistências visuais. Na responsividade, dividimos o CSS em 4 breakpoints e ocultamos colunas da tabela em mobile. Por fim, refatoramos o CSS eliminando 5 seletores redundantes de foco (substituídos por `:focus-visible`) e adicionando seções dedicadas para validação, navegação e breadcrumb.

### Principais dificuldades e como foram resolvidas

A maior dificuldade foi garantir que os ajustes de CSS não quebrassem o Bootstrap já aplicado. Resolvemos usando classes CSS específicas (em vez de sobrescrever as classes Bootstrap globalmente) e testando os breakpoints com DevTools do navegador nas larguras 390px, 768px e 1366px.

---

**Evidência de funcionamento:** Descrição objetiva acima (sem prints — conforme permitido pelo PDF da SA05: *"print antes/depois **ou** descrição objetiva"*)

**Localização deste arquivo:** `docs/checklist-qualidade-SA05.md`

---

*Equipe SisRequisição — SA05 — 13/08/2026*
