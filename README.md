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

### Arquivos Modificados/Criados

- `public/css/custom-styles.css` ← **NOVO**
- `docs/Checklist-Boas-Praticas-SA03.md` ← **NOVO**
- `README.md` ← Atualizado
- Estrutura de pastas reorganizada

### Evidências

Consulte o arquivo `docs/Checklist-Boas-Praticas-SA03.md` para detalhes completos de cada boa prática aplicada.

---

**Status:** 🟡 SA03 IMPLEMENTADA  
**Próxima:** SA04 - Integração completa  

