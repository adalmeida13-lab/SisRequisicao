# Checklist de Entrega — SA06
## Protótipo Front-End Final — SisRequisição

**UC:** Desenvolvimento de Sistemas  
**Equipe:** Jorladson, Ademilson, Marcos  
**Data:** 13/08/2026  
**Repositório:** https://github.com/adalmeida13-lab/SisRequisicao  
**Branch:** `jorladson`

---

## ✅ Itens Verificados — Execução

| Item | Status | Observação |
|------|--------|-----------|
| Abre no navegador sem erro visível | ✅ | Rota principal `/service-requests` carrega corretamente |
| Sem erro crítico no console | ✅ | Verificado no DevTools (F12) — 0 erros JavaScript |
| Servidor PHP executa sem falhas | ✅ | `php artisan serve` inicia em `http://localhost:8000` |
| CSS e Bootstrap carregam | ✅ | Estilos visíveis, `custom-styles.css` aplicado |

---

## ✅ Itens Verificados — Fluxo

| Item | Status | Evidência |
|------|--------|-----------|
| Navegação entre seções/páginas funciona | ✅ | Listagem → Criar → Detalhes → Editar → Voltar (circular) |
| Formulário valida campos obrigatórios | ✅ | Campos vazios bloqueados com mensagem em português |
| Mensagem/feedback de **erro** aparece | ✅ | "Preencha este campo." exibido abaixo do input com borda vermelha |
| Mensagem/feedback de **sucesso** aparece | ✅ | "Operação realizada com sucesso!" após criar/editar (alert verde) |
| Breadcrumbs de navegação funcionam | ✅ | Todas as views têm breadcrumb clicável |

---

## ✅ Interação Principal — Adicionar item em lista

| Ação | Status | Como testar |
|------|--------|-------------|
| Criar nova requisição | ✅ | `/service-requests/create` → preencher form → "Criar Requisição" |
| Requisição aparece na listagem | ✅ | Redireciona para `/service-requests` com item adicionado |
| Validação bloqueia envio | ✅ | Submeter form vazio → erros abaixo dos campos |
| Mensagem de sucesso exibida | ✅ | Alert verde "Requisição criada com sucesso!" |

**Interações secundárias implementadas:**
- ✅ **Editar requisição** — `/service-requests/{id}/edit` → alterar status/prioridade
- ✅ **Visualizar detalhes** — `/service-requests/{id}` → card com badges coloridos
- ✅ **Excluir requisição** — Botão vermelho com confirmação JavaScript
- ✅ **Filtrar requisições** — Formulário com busca por texto, status e prioridade

---

## ✅ Organização do Repositório

| Item | Status | Localização |
|------|--------|-------------|
| Pastas organizadas (CSS/JS/Images) | ✅ | `public/css/`, `public/js/`, `public/images/` |
| Views em estrutura MVC | ✅ | `resources/views/service_requests/` |
| Controllers organizados | ✅ | `app/Http/Controllers/ServiceRequestController.php` |
| README atualizado | ✅ | Instruções de execução + funcionalidades + stack tecnológica |
| Documentação técnica | ✅ | `docs/` contém 6 arquivos: SA01, SA03, SA04, SA05, SA06 |

---

## 📌 Evidências de Funcionamento

### Evidência 1 — Listagem com Cards de Estatística

**Arquivo:** `evidencias/01-listagem-cards.png` (ou descrito abaixo)  
**O que mostra:**
- 4 cards de estatística (Total, Abertas, Em Andamento, Encerradas)
- Tabela com requisições exibindo colunas: ID, Descrição, Departamento, Prioridade, Status, Data, Ações
- Botões de ação (Visualizar, Editar, Excluir) funcionais
- Breadcrumb "Requisições" no topo

### Evidência 2 — Formulário de Criação com Validação

**Arquivo:** `evidencias/02-formulario-validacao.png` (ou descrito abaixo)  
**O que mostra:**
- Formulário com 4 campos obrigatórios (Empresa, Departamento, Prioridade, Descrição)
- Dicas preventivas abaixo de cada campo: *"Preencha este campo. Selecione..."*
- Mensagem de erro em campo vazio: borda vermelha + ícone + texto complementar
- Select de prioridade com emoji: "🔴 Alta — urgente"
- Sidebar de ajuda à direita

### Evidência 3 — Mensagem de Sucesso

**Arquivo:** `evidencias/03-mensagem-sucesso.png` (ou descrito abaixo)  
**O que mostra:**
- Alert verde no topo da página: "✅ Sucesso! Operação realizada com sucesso!"
- Botão "X" para dispensar (dismissível)
- Requisição adicionada na tabela abaixo

### Evidência 4 — Responsividade Mobile

**Arquivo:** `evidencias/04-mobile-responsivo.png` (ou descrito abaixo)  
**O que mostra:**
- Cards de estatística em 2 colunas (390px de largura)
- Colunas "Departamento" e "Data" ocultas na tabela
- Breadcrumb com tamanho reduzido
- Botões de ação empilhados corretamente

---

## ⚠️ Pendências Conhecidas

| Pendência | Impacto | Observação |
|-----------|---------|-----------|
| Dados em memória (array estático) | **Baixo** | Ao recarregar a página, dados criados são perdidos. Migração para banco SQLite planejada para versão futura. |
| Sem autenticação de usuário | **Médio** | Qualquer pessoa pode criar/editar/excluir. Login será implementado com Laravel Breeze na próxima fase. |

**Observação:** Essas pendências são **intencionais** para manter o escopo de protótipo front-end (SA01–SA06). Funcionalidades back-end completas não fazem parte desta entrega.

---

## 📊 Resumo de Funcionalidades Entregues

### Navegação
✅ Listagem de requisições com cards de estatística  
✅ Criar nova requisição (formulário completo)  
✅ Visualizar detalhes de requisição (card com badges)  
✅ Editar requisição existente (status, prioridade, descrição)  
✅ Excluir requisição (com confirmação)  
✅ Filtrar requisições (busca, status, prioridade)  

### Validação e UX
✅ Validação 100% PHP/Laravel (server-side)  
✅ Mensagens em português com complemento específico  
✅ Dicas preventivas abaixo de cada campo  
✅ Mensagens flash (sucesso/erro/warning/info)  
✅ Breadcrumbs em todas as views  

### Acessibilidade
✅ Atributos ARIA (`aria-label`, `aria-required`, `aria-describedby`)  
✅ `role="alert"` em feedbacks de validação  
✅ `scope="col"` em cabeçalhos de tabela  
✅ Foco visível padronizado (`:focus-visible`)  

### Responsividade
✅ 4 breakpoints CSS (576px / 768px / 992px / 1200px)  
✅ Cards de estatística: 2 colunas em mobile, 4 em desktop  
✅ Tabela com colunas ocultas em mobile  
✅ Filtros em coluna única em celular  

### Padrões e Documentação
✅ 3 padrões do time documentados (`docs/decisoes.md`)  
✅ Checklist de qualidade SA05 com evidências antes/depois  
✅ Arquitetura técnica documentada (800+ linhas)  
✅ Plano de execução 8h (SA04)  

---

## 🔗 Rastreabilidade

### Commits finais (SA01 → SA06)

| SA | Commits | Principais mudanças |
|----|---------|---------------------|
| SA01 | 2 | Plano do projeto, estrutura inicial |
| SA02 | 3 | Formulário create, listagem com filtros |
| SA03 | 2 | Organização de pastas CSS/JS/Images, boas práticas |
| SA04 | 2 | Views show/edit completas, mensagens flash, docs técnica |
| SA05 | 4 | Validação clara, layout padronizado, responsividade, refatoração CSS |
| SA06 | 1 | Checklist de entrega e README final |

**Total aproximado:** 14 commits no branch `jorladson`

### Quadro de tarefas

**Status final:** Todas as tarefas das SAs 01–06 marcadas como "Concluído" ✅  
**Link:** https://github.com/users/Jorladsonp/projects/2/views/1

---

## 🚀 Como Executar o Protótipo

### Pré-requisitos
- PHP 8.3+ instalado
- Composer instalado
- Git (opcional, para clonar)

### Passo a passo

```bash
# 1. Clone o repositório (ou use a pasta já existente)
git clone https://github.com/adalmeida13-lab/SisRequisicao.git
cd SisRequisicao
git checkout jorladson

# 2. Instale dependências
composer install --ignore-platform-req=ext-fileinfo

# 3. Configure o ambiente
cp .env.example .env
php artisan key:generate

# 4. Crie o banco SQLite (opcional — dados em memória por enquanto)
touch database/database.sqlite
php artisan migrate

# 5. Inicie o servidor
php artisan serve

# 6. Abra no navegador
# Acesse: http://localhost:8000/service-requests
```

**Atalho (se já estiver configurado):**
```bash
cd SisRequisicao
php artisan serve
# Abrir: http://localhost:8000/service-requests
```

---

## 📅 Histórico de Entregas

| SA | Data | O que foi entregue |
|----|------|-------------------|
| SA01 | 11/08/2026 | Plano do projeto, backlog, metodologia |
| SA02 | 12/08/2026 | Formulário create, listagem com filtros PHP/Laravel |
| SA03 | 12/08/2026 | Organização de pastas, checklist de 6 boas práticas |
| SA04 | 13/08/2026 | Views show/edit, mensagens flash, docs técnica 800+ linhas |
| SA05 | 13/08/2026 | 4 melhorias (validação, layout, responsividade, refatoração) |
| **SA06** | **13/08/2026** | **Checklist de entrega, README final, evidências** |

---

**Assinatura da equipe:**  
Jorladson, Ademilson, Marcos  
**Data:** 13/08/2026  
**Protótipo:** ✅ Executável e demonstrável
