# Decisões e Padrões do Time — SisRequisição
## SA05 – Refinamento do Front-End

**UC:** Desenvolvimento de Sistemas  
**Equipe:** Jorladson, Ademilson, Marcos  
**Data de registro:** 13/08/2026

---

## 1. Padrão de Validação e Mensagens

### 1.1 Regra geral

Toda validação é realizada **100% no servidor** (PHP/Laravel). Não usamos JavaScript para validação, conforme decisão do professor.

### 1.2 Padrão de mensagens adotado pelo time

| Situação | Mensagem exibida | Exemplo |
|----------|-----------------|---------|
| **Campo obrigatório vazio** | "Preencha este campo." | Campo Empresa em branco |
| **Formato inválido** | "Formato inválido. Verifique e tente novamente." | — |
| **Valor fora da lista aceita** | "Selecione uma das opções disponíveis." | Prioridade: valor não aceito |
| **Texto muito curto** | "Digite pelo menos N caracteres descrevendo…" | Descrição < 10 chars |
| **Texto muito longo** | "A [campo] está muito longa. Resuma em até N caracteres." | Descrição > 500 chars |
| **Ação concluída com sucesso** | "Operação realizada com sucesso!" | Criação de requisição |
| **Erro inesperado** | "Ocorreu um erro. Tente novamente ou contate o suporte." | Falha interna |

### 1.3 Onde as mensagens estão implementadas

- **Validações de negócio:** `app/Http/Controllers/ServiceRequestController.php`
- **Exibição de erros:** Diretiva `@error('campo')` nas views Blade
- **Mensagens flash:** `resources/views/components/alert.blade.php`
- **Dicas de campo:** Atributo `aria-describedby` + `<small id="campo_hint">`

### 1.4 Estrutura de exibição de erro padronizada

```blade
{{-- Dica do campo (sempre visível) --}}
<small id="campo_hint" class="form-text text-muted">
    Preencha este campo. [instrução específica]
</small>

{{-- Mensagem de erro (só aparece após validação falhar) --}}
@error('nome_do_campo')
    <div id="campo_error" class="invalid-feedback d-block" role="alert">
        <i class="bi bi-exclamation-circle-fill"></i>
        {{ $message }} — [complemento específico]
    </div>
@enderror
```

### 1.5 Conexão acessível (aria-describedby)

```html
<input aria-describedby="campo_hint campo_error" ...>
```

Garante que leitores de tela leiam a dica E o erro ao focar no campo.

---

## 2. Padrão de Nomes (Arquivos, Funções, Classes)

### 2.1 Arquivos

| Tipo | Padrão | Exemplo |
|------|--------|---------|
| Blade views | `kebab-case.blade.php` | `service-requests.blade.php` |
| CSS | `kebab-case.css` | `custom-styles.css` |
| Controllers | `PascalCase + Controller.php` | `ServiceRequestController.php` |
| Migrations | `snake_case` com timestamp | `2024_01_01_create_requests_table.php` |
| Docs | `kebab-case.md` ou `kebab-case.pdf` | `decisoes.md`, `checklist-sa05.md` |

### 2.2 PHP (Laravel)

| Elemento | Padrão | Exemplo |
|----------|--------|---------|
| Controllers | `PascalCase` | `ServiceRequestController` |
| Métodos | `camelCase` | `store()`, `showAll()` |
| Variáveis | `camelCase` | `$serviceRequest`, `$requisicoes` |
| Rotas nomeadas | `kebab-case.acao` | `servicerequest.index` |
| Arrays/coleções | plural + camelCase | `$requisicoes`, `$statusMap` |

### 2.3 Blade / HTML

| Elemento | Padrão | Exemplo |
|----------|--------|---------|
| IDs de input | `snake_case` | `id="empresa_id"` |
| IDs de hint/erro | `campo_hint`, `campo_error` | `id="descricao_hint"` |
| Classes CSS | `kebab-case` | `class="card-stat"`, `class="btn-action-group"` |
| Variáveis PHP no Blade | `camelCase` | `$serviceRequest`, `$statusClass` |

### 2.4 CSS

| Elemento | Padrão | Exemplo |
|----------|--------|---------|
| Classes | `kebab-case` | `.card-stat`, `.filter-section` |
| Variáveis CSS | `--kebab-case` | `--primary-color`, `--spacing-md` |
| Comentários de seção | `/* === NOME === */` | `/* === 1. VARIÁVEIS === */` |

### 2.5 Commits Git

Formato: `tipo(escopo): descrição`

| Tipo | Quando usar |
|------|------------|
| `feat` | Nova funcionalidade |
| `fix` | Correção de bug |
| `refactor` | Refatoração sem mudar comportamento |
| `style` | Formatação, CSS, visual |
| `docs` | Documentação, README |
| `chore` | Tarefas de manutenção |

**Exemplos:**
```
feat(SA05-M1): Padroniza mensagens de validação em create.blade.php
style(SA05-M2): Standardiza container e breadcrumbs em todas as views
refactor(SA05-M4): Refatora CSS com focus-visible e remove duplicações
```

---

## 3. Padrão Visual Mínimo

### 3.1 Espaçamentos

Usamos as variáveis CSS definidas em `public/css/custom-styles.css`:

```css
:root {
    --spacing-sm: 0.5rem;   /* 8px  — entre elementos próximos */
    --spacing-md: 1rem;     /* 16px — entre seções */
    --spacing-lg: 1.5rem;   /* 24px — espaçamento de cards/seções */
}
```

**Regras:**
- Margem entre campos de formulário: `mb-3` (Bootstrap = 1rem)
- Margem abaixo de títulos de seção: `mb-4` (Bootstrap = 1.5rem)
- Padding interno de cards: `card-body` padrão Bootstrap + `.py-4` na página

### 3.2 Estilo de Botões

| Ação | Classe Bootstrap | Ícone |
|------|-----------------|-------|
| **Criar / Confirmar** | `btn btn-primary` | `bi-check-circle` |
| **Editar** | `btn btn-warning` | `bi-pencil` |
| **Excluir** | `btn btn-danger` | `bi-trash` |
| **Cancelar / Voltar** | `btn btn-outline-secondary` | `bi-x-circle` ou `bi-arrow-left` |
| **Visualizar** | `btn btn-outline-info` | `bi-eye` |
| **Filtrar** | `btn btn-success` | `bi-search` |
| **Limpar** | `btn btn-outline-secondary` | `bi-arrow-counterclockwise` |

**Regras:**
- Botão de submit sempre com ícone à esquerda
- Botão de cancelar sempre à direita do submit
- Botões agrupados: usar `btn-group` ou `d-flex gap-2`
- Em mobile: botões com `flex-wrap` para não quebrar layout

### 3.3 Avisos / Feedback

| Tipo | Classe | Uso |
|------|--------|-----|
| **Sucesso** | `alert-success` | Ação concluída |
| **Erro** | `alert-danger` | Falha ou validação |
| **Aviso** | `alert-warning` | Atenção necessária |
| **Info** | `alert-info` | Informação geral |

**Regras:**
- Mensagens flash: sempre no topo da página, dismissíveis
- Feedbacks de formulário: abaixo do campo, com ícone
- Mensagens de erro de lista (múltiplos): em lista `<ul>` dentro do alert

### 3.4 Hierarquia Visual de Títulos

| Nível | Tag | Classe | Uso |
|-------|-----|--------|-----|
| Título de página | `<h1>` | `.h3` (tamanho reduzido) | Título principal da view |
| Título de card | `<h5>` | padrão Bootstrap | Cabeçalho de card |
| Label de campo | `<label>` | `.fw-semibold` | Rótulo de input |
| Dica de campo | `<small>` | `.form-text .text-muted` | Instrução abaixo do input |

### 3.5 Cores de Status e Prioridade

| Valor | Cor Bootstrap | Contexto |
|-------|--------------|---------|
| Prioridade Alta | `bg-danger` (vermelho) | Urgente |
| Prioridade Média | `bg-warning` (amarelo) | Normal |
| Prioridade Baixa | `bg-info` (azul claro) | Pode aguardar |
| Status Aberta | `bg-primary` (azul) | Aguardando |
| Status Em Andamento | `bg-warning` (amarelo) | Em progresso |
| Status Encerrada | `bg-success` (verde) | Concluída |
| Status Cancelada | `bg-secondary` (cinza) | Cancelada |

---

## 4. Padrão de Acessibilidade (adotado na SA04/SA05)

1. **`aria-label`** em todos os botões que só têm ícone
2. **`aria-required="true"`** em campos obrigatórios
3. **`aria-describedby`** ligando campo → dica + campo → erro
4. **`role="alert"`** em mensagens de erro dinâmicas
5. **`aria-live="polite"`** em mensagens de sucesso
6. **`aria-current="page"`** no item ativo do breadcrumb
7. **`scope="col"`** em cabeçalhos de tabela
8. **`aria-hidden="true"`** em ícones decorativos

---

## 5. Padrão de Responsividade (adotado na SA05)

**Breakpoints usados:**

| Breakpoint | Largura | Bootstrap |
|------------|---------|-----------|
| Mobile | < 576px | (padrão) |
| Tablet | 576–768px | `sm` |
| Desktop | ≥ 768px | `md` |
| Desktop grande | ≥ 1200px | `xl` |

**Colunas ocultas em mobile:**
- Coluna "Departamento" da tabela: `d-none d-md-table-cell`
- Coluna "Data" da tabela: `d-none d-lg-table-cell`

**Cards de estatística:**
- Mobile: 2 colunas (`row-cols-2`)
- Desktop: 4 colunas (`row-cols-md-4`)

---

## 6. Onde encontrar os padrões no código

| Padrão | Arquivo |
|--------|---------|
| Validação e mensagens | `app/Http/Controllers/ServiceRequestController.php` |
| Exibição de feedback | `resources/views/components/alert.blade.php` |
| Dicas e erros de campo | `resources/views/service_requests/create.blade.php` |
| CSS responsivo e foco | `public/css/custom-styles.css` (seções 4, 6, 7, 8) |
| Breadcrumbs | Todas as views em `resources/views/service_requests/` |
| Padrão de botões | `resources/views/service_requests/index.blade.php` |

---

**Mantido por:** Equipe SisRequisição  
**Última atualização:** 13/08/2026 — SA05
