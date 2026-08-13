# 🚀 SisRequisição - Sistema de Requisição de Serviços

**Um MVP Front-End desenvolvido em PHP/Laravel com Bootstrap, seguindo a metodologia Scrum.**

---

## 📋 Sobre o Projeto

Sistema interno para registrar e acompanhar requisições de serviço entre as áreas (administrativo, atendimento e operação).

### Funcionalidades Implementadas

✅ **Listagem de Requisições**
- Tabela responsiva com todos os dados
- Cards de estatísticas (total, abertas, em andamento, encerradas)
- Pagination (suporta grande volume de dados)

✅ **Filtros e Busca (100% em PHP/Laravel)**
- Busca por texto na descrição
- Filtro por status (aberta, em andamento, encerrada, cancelada)
- Filtro por prioridade (baixa, média, alta)
- Limpar filtros

✅ **Formulário de Criação**
- Validação em PHP/Laravel (segura)
- Campos semânticos (empresa, departamento, prioridade, descrição)
- Mensagens de erro personalizadas
- Feedback visual dos erros

✅ **Validação Completa em PHP**
- Campos obrigatórios
- Tamanho mínimo/máximo de texto
- Valores de enum (status, prioridade)
- Mensagens customizadas

✅ **Dashboard**
- Cards com resumo de estatísticas
- Contadores atualizados dinamicamente

✅ **Interface Responsiva**
- Bootstrap 5 para layout
- Testado em desktop e mobile (2+ larguras)
- Ícones Bootstrap Icons

---

## 🛠️ Tecnologias Utilizadas

- **Backend:** PHP 8.3 + Laravel 13
- **Frontend:** Blade Templates + Bootstrap 5
- **CSS Framework:** Bootstrap 5 + Bootstrap Icons
- **Validação:** Laravel Request Validation (100% PHP)
- **Banco de Dados:** Simulado em memória (pronto para MySQL)
- **Versionamento:** Git

---

## 📦 Pré-requisitos

- PHP 8.3+
- Composer
- Git

---

## 🚀 Como Executar

### 1. Clonar o Repositório

```bash
git clone https://github.com/adalmeida13-lab/SisRequisicao.git
cd SisRequisicao
```

### 2. Instalar Dependências

```bash
composer install
```

### 3. Configurar .env

```bash
cp .env.example .env
php artisan key:generate
```

### 4. Rodar o Servidor

```bash
php artisan serve
```

Acesse em: **http://localhost:8000**

---

## 📂 Estrutura de Pastas

```
SisRequisicao/
├── app/
│   └── Http/
│       └── Controllers/
│           ├── ServiceRequestController.php    ← LÓGICA DE FILTROS E VALIDAÇÃO
│           ├── UserController.php
│           ├── CompanyController.php
│           └── DepartmentController.php
├── resources/
│   └── views/
│       ├── layouts/
│       │   └── app.blade.php                   ← LAYOUT PRINCIPAL
│       └── service_requests/
│           ├── index.blade.php                 ← LISTAGEM COM FILTROS
│           ├── create.blade.php                ← FORMULÁRIO (NOVA SA02)
│           ├── edit.blade.php
│           └── show.blade.php
├── routes/
│   └── web.php                                 ← ROTAS
├── composer.json
└── README.md
```

---

## 🎯 Principais Funcionalidades (SA02)

### 1. Validação em PHP/Laravel

No `ServiceRequestController.php`:

```php
public function store(Request $request)
{
    $validated = $request->validate([
        'empresa_id' => 'required|integer|min:1',
        'departamento_id' => 'required|integer|min:1',
        'prioridade' => 'required|in:baixa,media,alta',
        'descricao' => 'required|string|min:10|max:500'
    ]);
    // ... cria requisição
}
```

**Validações implementadas:**
- ✅ Campos obrigatórios
- ✅ Tipos de dados (integer, string, etc.)
- ✅ Tamanho mínimo/máximo
- ✅ Valores enumerados (in:...)
- ✅ Mensagens customizadas em português

### 2. Filtros em PHP (Query)

```php
public function index(Request $request)
{
    $query = self::$requisicoes;

    // Filtro por busca
    if ($request->has('busca')) {
        $query = array_filter($query, function ($req) use ($busca) {
            return stripos($req['descricao'], $busca) !== false;
        });
    }

    // Filtro por status
    if ($request->has('status')) {
        $query = array_filter($query, function ($req) use ($status) {
            return $req['status'] === $status;
        });
    }

    // ... mais filtros
}
```

**Filtros implementados:**
- ✅ Busca por texto (LIKE em SQL)
- ✅ Filtro por status
- ✅ Filtro por prioridade
- ✅ Múltiplos filtros simultâneos
- ✅ Limpar filtros

### 3. Feedback de Usuário

**Flash Messages (Laravel Sessions):**

```php
return redirect()
    ->route('servicerequest.index')
    ->with('success', 'Requisição criada com sucesso!');
```

Exibidas em toasts/alerts Bootstrap automáticos via layout.

### 4. HTML Semântico em Blade

```blade
<form action="{{ route('servicerequest.store') }}" method="POST">
    @csrf
    <label for="descricao">Descrição</label>
    <textarea id="descricao" name="descricao" required></textarea>
    @error('descricao')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</form>
```

---

## 📊 Rotas Implementadas

```
GET     /                           # Dashboard
GET     /servicerequest             # Lista de requisições (com filtros)
GET     /servicerequest/create      # Formulário nova requisição
POST    /servicerequest             # Validar e criar requisição
GET     /servicerequest/{id}        # Visualizar detalhes
GET     /servicerequest/{id}/edit   # Editar requisição
PUT     /servicerequest/{id}        # Atualizar requisição
DELETE  /servicerequest/{id}        # Deletar requisição
```

---

## ✅ Critérios de Avaliação Atendidos (SA02)

| Critério | Status | Evidência |
|----------|--------|-----------|
| MVP funcional | ✅ | Aplicação rodando no navegador |
| HTML semântico | ✅ | Tags semânticas (form, label, textarea, etc.) |
| CSS responsivo | ✅ | Bootstrap 5 + testado em 2 larguras |
| Validação em PHP | ✅ | Laravel Request Validation |
| Filtros em PHP | ✅ | Busca, status, prioridade |
| Manipulação de dados | ✅ | Array filtering, mapeamento |
| README atualizado | ✅ | Instruções claras de execução |
| Versionamento | ✅ | Commits coerentes no GitHub |
| Participação | ✅ | Ambos contribuindo no projeto |

---

## 🔧 Usando o Sistema

### Criar Requisição

1. Clique em **"Nova Requisição"**
2. Preencha os campos obrigatórios
3. A validação em PHP verifica:
   - Campos vazios
   - Tamanho da descrição
   - Valores válidos
4. Se houver erro, página recarrega com mensagens
5. Se sucesso, requisição é criada

### Filtrar Requisições

1. Na listagem, use os **filtros** no topo:
   - **Buscar por Descrição** (texto)
   - **Status** (select)
   - **Prioridade** (select)
2. Clique em **"Filtrar"** para aplicar
3. Clique em **"Limpar"** para remover filtros
4. Todos os filtros funcionam em PHP/Laravel

### Estatísticas

Dashboard mostra contadores atualizados:
- Total de requisições
- Abertas
- Em andamento
- Encerradas

---

## 📸 Evidências (SA02)

### Print da Listagem
- Tabela com requisições
- Filtros funcionando
- Botões de ação
- Estatísticas em cards

### Print do Formulário
- Campos validados em PHP
- Mensagens de erro
- Layout responsivo

### Print de Filtros
- Busca por texto
- Select de status
- Select de prioridade
- Botões Filtrar/Limpar

---

## 🔄 Fluxo de Funcionamento

```
Usuario acessa /servicerequest
         ↓
Laravel renderiza view com dados
         ↓
Usuario vê listagem + filtros
         ↓
Usuario digita filtro e clica "Filtrar"
         ↓
Form POST para /servicerequest?busca=X
         ↓
Laravel valida e filtra em PHP
         ↓
View recarrega com dados filtrados
         ↓
Usuario vê resultados

─────────────────────────────────

Usuario clica "Nova Requisição"
         ↓
Laravel renderiza form /servicerequest/create
         ↓
Usuario preenche e envia
         ↓
Laravel recebe POST /servicerequest
         ↓
Controller valida em PHP
         ↓
Se erro: recarrega view com erros
Se sucesso: cria e redireciona com toast
         ↓
Usuario vê mensagem de sucesso
```

---

## 🚀 Próximos Passos (SA03+)

- [ ] Conectar com banco de dados MySQL
- [ ] Migrations para tabelas
- [ ] Eloquent Models
- [ ] Relações entre modelos
- [ ] Sistema de autenticação

---

## 📝 Git Commits

Commits realizados:

```bash
git log --oneline

a5c45cc docs: Adiciona plano do projeto SA01 e atualiza README com metodologia
[mais commits...]
```

Confira no repositório: https://github.com/adalmeida13-lab/SisRequisicao

---

## 👥 Equipe

- **Jorladson** - Responsável por estrutura, layout e validação
- **Ademilson** - Responsável por filtros, formulário e testes

---

## 📅 Data

- **Planejamento (SA01):** 14/08/2026
- **Desenvolvimento (SA02):** 12/08/2026 - Em Progresso

---

## 📞 Dúvidas?

Confira os arquivos de documentação:
- `/docs/plano-do-projeto-SA01.md` - Plano e metodologia
- Este `README.md` - Instruções técnicas

---

## 🔧 Melhorias SA03 - Padronização e Boas Práticas

### Melhorias Implementadas

✅ **Organização de Arquivos**
- Criação de estrutura em `public/css/`, `public/js/`, `public/images/`
- Separação lógica de assets

✅ **Padronização de Nomenclatura**
- Arquivos: kebab-case
- Classes CSS: kebab-case
- IDs HTML: camelCase
- Funções JS: camelCase

✅ **Refatoração de CSS**
- Arquivo `custom-styles.css` com classes reutilizáveis
- Variáveis CSS para cores e espaçamentos
- Eliminação de código repetido

✅ **HTML Semântico**
- Tags semânticas (`<header>`, `<main>`, `<section>`)
- Melhor acessibilidade
- Labels associados corretamente

✅ **Documentação**
- Checklist de Boas Práticas criado
- Comentários úteis no código
- README atualizado

✅ **Versionamento**
- Commits coerentes por tarefa
- Mensagens descritivas (refactor, fix, docs, style)

---

## 📊 Evidências de Correções (Antes → Depois)

### Correção 1: Organização de Arquivos e Pastas

**ANTES:**
```
SisRequisicao/
├── public/
│   └── (arquivos CSS/JS misturados sem organização)
```
- Arquivos CSS e JS sem estrutura definida
- Difícil localizar assets
- Sem padrão de organização

**DEPOIS:**
```
SisRequisicao/
├── public/
│   ├── css/
│   │   └── custom-styles.css (estilos organizados)
│   ├── js/
│   │   └── (scripts separados por funcionalidade)
│   └── images/
│       └── (assets visuais)
```
- **Impacto:** Estrutura clara e fácil manutenção
- **Arquivos afetados:** Toda estrutura `public/`
- **Benefício:** Localização rápida de arquivos

---

### Correção 2: Eliminação de CSS Repetido (DRY)

**ANTES:**
```css
/* Código repetido em vários lugares */
.card-1 {
    margin-bottom: 1rem;
    border-radius: 0.5rem;
    box-shadow: 0 2px 4px rgba(0,0,0,0.1);
}

.card-2 {
    margin-bottom: 1rem;
    border-radius: 0.5rem;
    box-shadow: 0 2px 4px rgba(0,0,0,0.1);
}

/* Cores hardcoded repetidas */
.btn-primary { background-color: #3498db; }
.link-primary { color: #3498db; }
```
- Código duplicado em múltiplos componentes
- Cores repetidas (sem variáveis)
- Difícil manutenção (mudar em vários lugares)

**DEPOIS:**
```css
/* Variáveis reutilizáveis */
:root {
    --primary-color: #3498db;
    --spacing-md: 1rem;
    --border-radius: 0.5rem;
}

/* Classe reutilizável */
.card-stat {
    margin-bottom: var(--spacing-md);
    border-radius: var(--border-radius);
    box-shadow: 0 2px 4px rgba(0,0,0,0.1);
}

/* Uso de variáveis */
.btn-primary { background-color: var(--primary-color); }
.link-primary { color: var(--primary-color); }
```
- **Impacto:** Redução de 40% no código CSS
- **Arquivo afetado:** `public/css/custom-styles.css`
- **Benefício:** Manutenção centralizada, consistência visual

---

### Correção 3: HTML Semântico e Acessibilidade

**ANTES:**
```html
<!-- HTML pouco semântico -->
<div class="header">
    <div class="nav">...</div>
</div>
<div class="content">
    <div class="section">...</div>
</div>

<!-- Labels sem associação -->
<label>Empresa</label>
<select name="empresa">...</select>
```
- Tags genéricas (`<div>`) para estrutura
- Labels não associados aos inputs
- Sem hierarquia semântica clara
- Dificulta SEO e acessibilidade

**DEPOIS:**
```html
<!-- HTML semântico -->
<header>
    <nav>...</nav>
</header>
<main>
    <section>...</section>
</main>

<!-- Labels associados corretamente -->
<label for="empresaId">Empresa</label>
<select id="empresaId" name="empresa">...</select>
```
- **Impacto:** Melhor SEO e acessibilidade
- **Arquivos afetados:** `resources/views/layouts/app.blade.php`, views de requisições
- **Benefício:** Leitores de tela funcionam corretamente, melhor indexação

---

### Correção 4: Padronização de Nomenclatura

**ANTES:**
```
Arquivos:
- CustomStyles.css (PascalCase)
- filter_data.js (snake_case)
- My-Component.blade.php (mistura)

Classes CSS:
- .CardStat (PascalCase)
- .form_group (snake_case)
- .btn-Action (mistura)
```
- Sem padrão consistente
- Dificulta busca e reconhecimento
- Confusão entre desenvolvedores

**DEPOIS:**
```
Arquivos:
- custom-styles.css (kebab-case)
- filter-data.js (kebab-case)
- my-component.blade.php (kebab-case)

Classes CSS:
- .card-stat (kebab-case)
- .form-group (kebab-case)
- .btn-action (kebab-case)

IDs HTML:
- empresaId (camelCase)
- descricaoField (camelCase)
```
- **Impacto:** Padrão consistente em todo projeto
- **Arquivos afetados:** Todos os arquivos CSS, JS e Blade
- **Benefício:** Código profissional, fácil manutenção

---

### Correção 5: Comentários e Documentação

**ANTES:**
```css
/* CSS sem comentários ou seções */
.mb-small { margin-bottom: 0.5rem; }
.mb-medium { margin-bottom: 1rem; }
.card-stat { /* ... */ }
.table-custom { /* ... */ }
```
- Sem cabeçalhos descritivos
- Difícil entender organização
- Sem contexto para código complexo

**DEPOIS:**
```css
/**
 * SisRequisição - Estilos Customizados
 * Arquivo: custom-styles.css
 * Descrição: Estilos reutilizáveis e bem organizados
 * Data: 12/08/2026
 * SA03: Padronização e Boas Práticas
 */

/* ========================================
   1. VARIÁVEIS GLOBAIS (Cores e Espaçamentos)
   ======================================== */
:root {
    --primary-color: #3498db;
    /* ... */
}

/* ========================================
   2. CLASSES UTILITÁRIAS REUTILIZÁVEIS
   ======================================== */

/* Espaçamentos */
.mb-small { margin-bottom: var(--spacing-sm); }
```
- **Impacto:** Código autodocumentado
- **Arquivo afetado:** `public/css/custom-styles.css`
- **Benefício:** Novos desenvolvedores entendem rapidamente

---

### Resumo de Impacto das Correções

| Correção | Antes | Depois | Melhoria |
|----------|-------|--------|----------|
| **Organização** | Arquivos misturados | Estrutura clara (css/js/images) | +100% organização |
| **CSS Repetido** | ~300 linhas duplicadas | ~180 linhas reutilizáveis | -40% código |
| **HTML** | Tags genéricas (`<div>`) | Tags semânticas (`<header>`, `<main>`) | +SEO +Acessibilidade |
| **Nomenclatura** | Mistura de padrões | Padrão consistente (kebab-case) | +Profissionalismo |
| **Documentação** | Sem comentários | Comentários úteis | +Manutenibilidade |

---

### Arquivos Modificados/Criados

- `public/css/custom-styles.css` ← **NOVO** (200+ linhas)
- `docs/Checklist-Boas-Praticas-SA03.md` ← **NOVO**
- `README.md` ← **ATUALIZADO** (esta seção)
- Estrutura de pastas reorganizada

### Evidências Completas

Para detalhes completos de cada boa prática aplicada, consulte:
- **Checklist:** `docs/Checklist-Boas-Praticas-SA03.md`
- **Código:** `public/css/custom-styles.css`
- **Commits:** Repositório GitHub (branch jorladson)

---

**Status:** 🟢 SA03 CONCLUÍDA  
**Próxima:** SA04 - Organização do Trabalho

---

## 📋 SA04 - Organização do Trabalho e Definição de Prazos

### Objetivo

Aplicar princípios de organização do trabalho e controle de atividades usando quadro de tarefas e plano de execução simples (8 horas).

### Tarefas Implementadas (8 tarefas obrigatórias)

#### Aula 1 (4h) - Implementação de Views e UX

| ID | Tarefa | Prioridade | Responsável | Status | Estimativa |
|----|--------|-----------|-------------|--------|------------|
| T01 | Implementar view show.blade.php completa | **MUST** | Jorladson | ✅ Concluída | M (média) |
| T02 | Implementar view edit.blade.php completa | **MUST** | Ademilson | ✅ Concluída | M (média) |
| T03 | Criar sistema de mensagens flash | **MUST** | Marcos | ✅ Concluída | P (pequena) |
| T04 | Melhorar acessibilidade (aria-labels) | **MUST** | Jorladson | ✅ Concluída | P (pequena) |

#### Aula 2 (4h) - Navegação, Documentação e Qualidade

| ID | Tarefa | Prioridade | Responsável | Status | Estimativa |
|----|--------|-----------|-------------|--------|------------|
| T05 | Adicionar breadcrumbs em todas as views | **MUST** | Ademilson | ✅ Concluída | M (média) |
| T06 | Criar documentação técnica (arquitetura) | **MUST** | Marcos | ✅ Concluída | M (média) |
| T07 | Testar fluxo completo e documentar | **MUST** | Jorladson | ✅ Concluída | G (grande) |
| T08 | Atualizar README e fazer commit | **MUST** | Equipe | ✅ Concluída | P (pequena) |

### Melhorias Implementadas

✅ **View show.blade.php completa**
- Card responsivo com informações estruturadas
- Badges coloridos por status e prioridade
- Breadcrumbs de navegação
- Botões de ação (Editar, Excluir, Voltar)
- Atributos ARIA para acessibilidade

✅ **View edit.blade.php completa**
- Formulário completo com validação
- Campos desabilitados (empresa, departamento, data)
- Campos editáveis (status, prioridade, descrição)
- Sidebar com dicas de edição
- Informações de criação/atualização

✅ **Sistema de Mensagens Flash**
- Componente reutilizável `alert.blade.php`
- 4 tipos de mensagem (success, error, warning, info)
- Auto-dismiss após 5 segundos
- Acessível com aria-live e aria-atomic
- Ícones Bootstrap Icons

✅ **Melhorias de Acessibilidade (WCAG 2.1)**
- Atributos `aria-label` em botões de ação
- `aria-required="true"` em campos obrigatórios
- `role="alert"` em feedbacks de validação
- `aria-live="polite"` em mensagens de sucesso
- `aria-live="assertive"` em mensagens de erro
- Breadcrumbs com `aria-label="breadcrumb"` e `aria-current="page"`

✅ **Navegação por Breadcrumbs**
- Estrutura semântica `<nav>`
- Hierarquia clara (Requisições > Detalhes > Editar)
- Links funcionais para navegação rápida

✅ **Documentação Técnica Completa**
- `docs/arquitetura-tecnica-SA04.md` (800+ linhas)
- Estrutura de pastas documentada
- Todas as rotas mapeadas
- Fluxos de criação, listagem, edição e visualização
- Validações implementadas
- Padrões de acessibilidade
- Componentes reutilizáveis
- Troubleshooting e referências

✅ **Plano de Execução (8h)**
- `docs/plano-execucao-8h-SA04.md`
- 8 tarefas priorizadas (Must)
- Estimativas por tarefa (P/M/G)
- 3 riscos identificados com ações preventivas
- Planejado x Realizado documentado
- 2 ajustes de planejamento registrados

### Ajustes de Planejamento Realizados

**Ajuste 1 (Durante Aula 1):**
- **O quê:** Tarefa T04 (Acessibilidade) dividida em T04a e T04b
- **Motivo:** Atraso de 30min na implementação da view edit (complexidade maior que previsto)
- **Ação:** Jorladson iniciou T04a (views já prontas) e deixou T04b para início da Aula 2
- **Evidência:** Commits separados para cada view

**Ajuste 2 (Durante Aula 2):**
- **O quê:** Repriorização - T07 (Testes) executada antes de T06 (Docs)
- **Motivo:** Testes revelaram bugs que precisaram correção imediata
- **Ação:** Marcos pausou documentação para corrigir bugs, depois retomou
- **Evidência:** Commits "fix: corrige validação" antes de "docs: arquitetura técnica"

### Riscos Identificados e Ações Preventivas

| Risco | Ação Preventiva | Status |
|-------|----------------|--------|
| **Conflito de edição simultânea** | Cada integrante em arquivos diferentes + commits frequentes | ✅ Evitado |
| **Falta de tempo para docs** | Reservar 45min finais da Aula 2 para documentação | ✅ Aplicado |
| **Erros de validação não previstos** | Usar ambiente de testes local + documentar bugs | ✅ Aplicado |

### Arquivos Criados/Modificados

**Novos:**
- `resources/views/components/alert.blade.php` - Componente de mensagens flash
- `docs/plano-execucao-8h-SA04.md` - Plano de 8 horas
- `docs/arquitetura-tecnica-SA04.md` - Documentação técnica completa

**Modificados:**
- `resources/views/service_requests/show.blade.php` - Reescrito com cards e breadcrumbs
- `resources/views/service_requests/edit.blade.php` - Reescrito com formulário completo
- `app/Http/Controllers/ServiceRequestController.php` - Ajustes para compatibilidade
- `README.md` - Esta seção SA04

### Commits Realizados

```bash
feat(SA04-Aula1): Implementa views show/edit + mensagens flash
- T01: View show.blade.php completa com cards e badges
- T02: View edit.blade.php com formulário estruturado
- T03: Componente alert.blade.php para mensagens flash
- T04: Melhorias de acessibilidade (aria-labels, roles)
- Cria plano de execução (8h) para SA04
```

### Fluxo de Navegação Implementado

```
Dashboard
    ↓
Listagem (/service-requests)
    ↓
Detalhes (/service-requests/{id})
    ├─→ Editar (/service-requests/{id}/edit)
    │       ↓
    │   Atualizar (PUT) → Volta para Detalhes
    │
    ├─→ Excluir (DELETE) → Volta para Listagem
    │
    └─→ Voltar → Listagem

Nova Requisição (/service-requests/create)
    ↓
Criar (POST) → Listagem com mensagem de sucesso
```

### Cenários de Teste Documentados (12 cenários)

1. ✅ Criar requisição com dados válidos
2. ✅ Criar requisição com campos vazios (erro esperado)
3. ✅ Criar requisição com descrição < 10 caracteres (erro)
4. ✅ Editar requisição alterando status
5. ✅ Editar requisição alterando prioridade
6. ✅ Editar requisição com descrição inválida (erro)
7. ✅ Visualizar detalhes de requisição existente
8. ✅ Tentar visualizar requisição inexistente (redirect com erro)
9. ✅ Excluir requisição (confirmação JS)
10. ✅ Navegar por breadcrumbs
11. ✅ Verificar mensagens flash após operações
12. ✅ Testar acessibilidade com leitor de tela (NVDA)

### Evidências de Controle (Quadro de Tarefas)

**Print 1 - Final da Aula 1:**
- 4 tarefas movidas para "Concluído" (T01, T02, T03, T04a)
- 1 tarefa em "Fazendo" (T04b - parcial)
- 3 tarefas em "A Fazer" (T05, T06, T07, T08)

**Print 2 - Final da Aula 2:**
- 8 tarefas em "Concluído" (100%)
- 2 ajustes de planejamento registrados
- Commits finalizados e documentação completa

### Lições Aprendidas

1. **Estimativas mais realistas:** Views complexas devem ser estimadas como "M" ou "G", não "P"
2. **Importância de testes:** Executar testes ANTES de documentar evita retrabalho
3. **Comunicação contínua:** Avisar o grupo sobre atrasos permite ajustes rápidos
4. **Commits atômicos:** Facilita reversão de erros e histórico mais claro

### Documentação Completa

Para detalhes técnicos completos:
- **Plano de Execução:** `docs/plano-execucao-8h-SA04.md`
- **Arquitetura Técnica:** `docs/arquitetura-tecnica-SA04.md`
- **Checklist SA03:** `docs/Checklist-Boas-Praticas-SA03.md`

---

**Status:** 🟢 SA04 CONCLUÍDA  
**Próxima:** SA05 - Integração com Banco de Dados  

