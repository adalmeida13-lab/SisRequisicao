# Documentação Técnica - SisRequisição
## SA04 - Arquitetura e Fluxos do Sistema

**Versão:** 1.0  
**Data:** 13/08/2026  
**Equipe:** Jorladson, Ademilson, Marcos

---

## 1. Visão Geral do Sistema

O **SisRequisição** é um sistema web desenvolvido em PHP/Laravel para gerenciamento de requisições de serviço entre empresas, departamentos e usuários.

### 1.1 Tecnologias Utilizadas

| Tecnologia | Versão | Finalidade |
|------------|--------|-----------|
| PHP | 8.5.3 | Linguagem back-end |
| Laravel | 13.25.0 | Framework MVC |
| Bootstrap | 5.3.3 | Framework CSS responsivo |
| Bootstrap Icons | 1.11.3 | Ícones SVG |
| SQLite | 3.x | Banco de dados (desenvolvimento) |

---

## 2. Estrutura de Pastas

```
SisRequisicao/
├── app/
│   └── Http/
│       └── Controllers/
│           ├── ServiceRequestController.php  # CRUD de requisições
│           ├── CompanyController.php         # Gerenciamento de empresas
│           ├── DepartmentController.php      # Gerenciamento de departamentos
│           └── UserController.php            # Gerenciamento de usuários
├── database/
│   └── migrations/
│       ├── create_requests_table.php         # Tabela de requisições
│       └── create_request_details_table.php  # Detalhes das requisições
├── resources/
│   └── views/
│       ├── layouts/
│       │   └── app.blade.php                 # Layout principal
│       ├── components/
│       │   └── alert.blade.php               # Componente de mensagens flash
│       ├── service_requests/
│       │   ├── index.blade.php               # Listagem com filtros
│       │   ├── create.blade.php              # Formulário de criação
│       │   ├── show.blade.php                # Detalhes da requisição
│       │   └── edit.blade.php                # Formulário de edição
│       ├── companies/                        # Views de empresas
│       ├── departments/                      # Views de departamentos
│       └── users/                            # Views de usuários
├── public/
│   ├── css/
│   │   └── custom-styles.css                 # Estilos customizados
│   ├── js/                                   # JavaScript (futuro)
│   └── images/                               # Imagens (futuro)
├── routes/
│   └── web.php                               # Rotas da aplicação
└── docs/
    ├── plano-do-projeto-SA01.md              # Planejamento SA01
    ├── Checklist-Boas-Praticas-SA03.md       # Checklist SA03
    ├── plano-execucao-8h-SA04.md             # Plano SA04
    └── arquitetura-tecnica-SA04.md           # Este documento
```

---

## 3. Rotas da Aplicação

### 3.1 Rotas de Requisições de Serviço

| Método | URI | Nome da Rota | Controller@Action | Descrição |
|--------|-----|--------------|-------------------|-----------|
| GET | `/service-requests` | servicerequest.index | ServiceRequestController@index | Listagem com filtros |
| GET | `/service-requests/create` | servicerequest.create | ServiceRequestController@create | Formulário de criação |
| POST | `/service-requests` | servicerequest.store | ServiceRequestController@store | Salvar nova requisição |
| GET | `/service-requests/{id}` | servicerequest.show | ServiceRequestController@show | Ver detalhes |
| GET | `/service-requests/{id}/edit` | servicerequest.edit | ServiceRequestController@edit | Formulário de edição |
| PUT/PATCH | `/service-requests/{id}` | servicerequest.update | ServiceRequestController@update | Atualizar requisição |
| DELETE | `/service-requests/{id}` | servicerequest.destroy | ServiceRequestController@destroy | Excluir requisição |

### 3.2 Outras Rotas

- `/users` - Gerenciamento de usuários
- `/companies` - Gerenciamento de empresas
- `/departments` - Gerenciamento de departamentos

---

## 4. Fluxos do Sistema

### 4.1 Fluxo de Criação de Requisição

```
1. Usuário acessa /service-requests/create
   ↓
2. Sistema exibe formulário com campos obrigatórios:
   - Empresa (select)
   - Departamento (select)
   - Prioridade (select: baixa/media/alta)
   - Descrição (textarea, min:10, max:500)
   ↓
3. Usuário preenche e submete (POST /service-requests)
   ↓
4. Controller valida dados em PHP/Laravel:
   - empresa_id: required|integer|min:1
   - departamento_id: required|integer|min:1
   - prioridade: required|in:baixa,media,alta
   - descricao: required|string|min:10|max:500
   ↓
5. Se VÁLIDO:
   - Cria requisição com status "aberta"
   - Redireciona para /service-requests com mensagem de sucesso
   ↓
6. Se INVÁLIDO:
   - Retorna ao formulário com erros destacados em vermelho
   - Preserva dados preenchidos (old values)
```

### 4.2 Fluxo de Listagem com Filtros

```
1. Usuário acessa /service-requests
   ↓
2. Sistema exibe:
   - Cards com estatísticas (total, abertas, em andamento, encerradas)
   - Formulário de filtros (busca, status, prioridade)
   - Tabela de requisições
   ↓
3. Usuário aplica filtros (GET /service-requests?status=aberta)
   ↓
4. Controller filtra dados usando array_filter:
   - Busca por descrição (stripos)
   - Filtro por status
   - Filtro por prioridade
   ↓
5. Sistema exibe apenas requisições filtradas
```

### 4.3 Fluxo de Edição

```
1. Usuário acessa /service-requests/{id}/edit
   ↓
2. Sistema:
   - Busca requisição por ID
   - Se não encontrada: redireciona com erro
   - Se encontrada: exibe formulário preenchido
   ↓
3. Campos DESABILITADOS (não editáveis):
   - Empresa
   - Departamento
   - Data de solicitação
   ↓
4. Campos EDITÁVEIS:
   - Status (aberta/em_andamento/encerrada/cancelada)
   - Prioridade (baixa/media/alta)
   - Descrição (min:10, max:500)
   ↓
5. Usuário submete (PUT /service-requests/{id})
   ↓
6. Controller valida e atualiza
   ↓
7. Redireciona para /service-requests/{id} (view show) com mensagem de sucesso
```

### 4.4 Fluxo de Visualização (Show)

```
1. Usuário acessa /service-requests/{id}
   ↓
2. Sistema:
   - Busca requisição por ID
   - Se não encontrada: redireciona para index com erro
   - Se encontrada: exibe card com informações
   ↓
3. Informações exibidas:
   - Empresa, Departamento, Data
   - Status (badge colorido por status)
   - Prioridade (badge colorido por prioridade)
   - Descrição completa
   - ID da requisição
   ↓
4. Ações disponíveis:
   - Editar (botão amarelo)
   - Excluir (botão vermelho com confirmação)
   - Voltar para lista
```

---

## 5. Validações Implementadas

### 5.1 Validação Server-Side (PHP/Laravel)

**Criação de Requisição (store):**
```php
'empresa_id' => 'required|integer|min:1'
'departamento_id' => 'required|integer|min:1'
'prioridade' => 'required|in:baixa,media,alta'
'descricao' => 'required|string|min:10|max:500'
```

**Atualização de Requisição (update):**
```php
'prioridade' => 'required|in:baixa,media,alta'
'descricao' => 'required|string|min:10|max:500'
'status' => 'required|in:aberta,em_andamento,encerrada,cancelada'
```

### 5.2 Validação Client-Side (HTML5)

- Campos com `required` - obrigatórios
- Campos com `minlength="10"` e `maxlength="500"` - limites de caracteres
- Campos com `type="date"` - validação de formato de data
- Atributo `novalidate` no form - permite validação customizada do Laravel

---

## 6. Padrões de Acessibilidade (WCAG 2.1)

### 6.1 Implementados na SA04

1. **Atributos ARIA:**
   - `aria-label` em botões de ação
   - `aria-required="true"` em campos obrigatórios
   - `aria-live="polite"` em mensagens de sucesso
   - `aria-live="assertive"` em mensagens de erro
   - `role="alert"` em feedbacks de validação

2. **Navegação por Breadcrumbs:**
   - Estrutura `<nav aria-label="breadcrumb">`
   - Atributo `aria-current="page"` no item ativo

3. **Semântica HTML:**
   - Tags `<nav>`, `<main>`, `<section>`, `<article>`
   - Hierarquia correta de headings (h1 → h2 → h3)

4. **Contraste de Cores:**
   - Badges: cores Bootstrap com contraste adequado
   - Textos: classes `.text-muted`, `.text-white` conforme fundo

5. **Labels Descritivas:**
   - Todos os campos de formulário têm `<label>` associado
   - Ícones decorativos não interferem em leitores de tela

---

## 7. Componentes Reutilizáveis

### 7.1 Componente de Mensagens Flash

**Arquivo:** `resources/views/components/alert.blade.php`

**Uso:**
```blade
@include('components.alert')
```

**Tipos de mensagem:**
- `session('success')` - Verde (sucesso)
- `session('error')` - Vermelho (erro)
- `session('warning')` - Amarelo (aviso)
- `session('info')` - Azul (informação)
- `$errors->any()` - Lista de erros de validação

**Features:**
- Dismissível (botão X)
- Auto-fade após 5 segundos (via JavaScript no layout)
- Ícones Bootstrap Icons
- Acessível (aria-live, aria-atomic)

---

## 8. Estrutura de Dados

### 8.1 Modelo de Requisição (Simulado em Memória)

```php
[
    'id' => integer,              // ID único
    'empresa' => string,          // Nome da empresa
    'departamento' => string,     // Nome do departamento
    'descricao' => string,        // Descrição da requisição (10-500 chars)
    'prioridade' => string,       // baixa|media|alta
    'status' => string,           // aberta|em_andamento|encerrada|cancelada
    'data' => string (Y-m-d)      // Data de criação
]
```

**Observação:** Atualmente o sistema usa array em memória (`static $requisicoes`). Em produção, será substituído por Eloquent Models com banco de dados.

---

## 9. Melhorias Futuras (Backlog)

1. **Persistência de Dados:**
   - Migrar de array em memória para banco SQLite/MySQL
   - Criar Models Eloquent (Request, Company, Department, User)

2. **Autenticação:**
   - Laravel Breeze/Jetstream para login/logout
   - Middleware de autorização (apenas criador pode editar)

3. **Uploads:**
   - Anexar arquivos às requisições
   - Validação de tipos e tamanhos

4. **Notificações:**
   - Email ao criar/atualizar requisição
   - Notificações em tempo real (WebSockets)

5. **Relatórios:**
   - Exportar para PDF/Excel
   - Dashboard com gráficos (Chart.js)

6. **Testes:**
   - PHPUnit para testes unitários
   - Laravel Dusk para testes E2E

---

## 10. Convenções de Código

### 10.1 Nomenclatura

- **Controllers:** PascalCase + sufixo "Controller" (ex: `ServiceRequestController`)
- **Views:** snake_case (ex: `service_requests/index.blade.php`)
- **Rotas:** kebab-case (ex: `/service-requests/create`)
- **Variáveis PHP:** camelCase (ex: `$serviceRequest`)
- **Constantes:** UPPER_SNAKE_CASE (ex: `MAX_DESCRIPTION_LENGTH`)

### 10.2 Blade Templates

- Sempre usar `@csrf` em formulários POST/PUT/DELETE
- Usar `@error('campo')` para exibir erros de validação
- Usar `old('campo')` para preservar valores em caso de erro
- Comentários descritivos em seções complexas

### 10.3 Git Commits

**Formato:** `tipo(escopo): mensagem`

**Tipos:**
- `feat`: nova funcionalidade
- `fix`: correção de bug
- `docs`: documentação
- `refactor`: refatoração sem mudança de comportamento
- `style`: formatação de código
- `test`: adição de testes

**Exemplo:**
```
feat(SA04): Implementa view show completa com breadcrumbs
```

---

## 11. Troubleshooting

### 11.1 Problemas Comuns

**Erro: "Route not found"**
- Verificar se rota está em `routes/web.php`
- Rodar `php artisan route:cache`

**Erro: "View not found"**
- Verificar caminho em `resources/views/`
- Blade usa `.` ao invés de `/` (ex: `service_requests.index`)

**Erro: "Class ServiceRequestController not found"**
- Verificar namespace no controller
- Rodar `composer dump-autoload`

**Erro de validação não aparece**
- Verificar `@error('nome_do_campo')` na view
- Verificar se `@csrf` está no formulário

---

## 12. Referências

- [Laravel Documentation 11.x](https://laravel.com/docs/11.x)
- [Bootstrap 5.3 Docs](https://getbootstrap.com/docs/5.3/)
- [WCAG 2.1 Guidelines](https://www.w3.org/WAI/WCAG21/quickref/)
- [PHP The Right Way](https://phptherightway.com/)

---

**Documento mantido por:** Equipe SisRequisição  
**Última atualização:** 13/08/2026 - SA04 Aula 2  
**Versão:** 1.0
