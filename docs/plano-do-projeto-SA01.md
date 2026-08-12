# Plano do Projeto — SA01

**UC:** Desenvolvimento de Sistemas
**SA:** SA01 – Metodologia de desenvolvimento de sistemas
**Nome do projeto (MVP):** Sistema de Requisição (SisRequisicao)

## Identificação

- **Equipe (nomes):**
  1. Jorladson
  2. Ademilson
- **Turma:** Técnico em Desenvolvimento de Sistemas
- **Data:** 14/08

---

## 1) Visão do MVP

### Objetivo do MVP

Sistema interno para registrar e acompanhar requisições de serviço entre as áreas
(administrativo, atendimento e operação). O MVP permite cadastrar usuários, empresas
e departamentos, além de abrir, acompanhar e encerrar requisições de serviço com
rastreabilidade do fluxo entre departamentos.

### Público/área usuária (interno)

Áreas administrativa, de atendimento e de operação da organização. Usuários internos
que abrem requisições e acompanham o status até a conclusão.

### Escopo do MVP (o que o MVP deve ter)

- CRUD de usuários (com soft delete e restauração).
- CRUD de empresas (com soft delete e restauração).
- CRUD de departamentos (com soft delete e restauração).
- CRUD de requisições de serviço (com soft delete e restauração).
- Requisição vinculada a empresa, usuário e departamento.
- Status da requisição: aberta, em andamento, encerrada, cancelada.
- Detalhamento do fluxo da requisição entre departamentos (request_details).
- Interface web responsiva e navegável (HTML/CSS/JS via Blade).

### Fora do escopo (o que NÃO será feito agora)

- Autenticação e controle de permissões por papel (login/roles).
- Notificações por e-mail.
- Relatórios e dashboards avançados.
- Integração com sistemas externos.
- Aplicativo mobile.

---

## 2) Metodologia de desenvolvimento

- **Metodologia escolhida:** Scrum
- **Tipo:** Ágil
- **Principais características:**
  1. Trabalho organizado em sprints (ciclos curtos e com prazo definido).
  2. Papéis definidos: Product Owner, Scrum Master e time de desenvolvimento.
  3. Reuniões de planejamento, revisão e retrospectiva.
  4. Backlog priorizado e refinado continuamente.
  5. Entregas incrementais validadas pelas áreas usuárias.

- **Justificativa técnica:** o cenário exige lidar com mudanças de prioridade típicas
  de ambientes reais e tempo limitado para evoluir o MVP. O Scrum organiza o trabalho
  em sprints curtas, com papéis e reuniões definidos, permitindo ajustar prioridades a
  cada ciclo e manter rastreabilidade do que foi combinado e entregue. As entregas
  incrementais são validadas pelas áreas usuárias, reduzindo retrabalho e
  inconsistências de interface.

---

## 3) Aplicabilidade da metodologia (como será usada no projeto)

### Fluxo de trabalho (etapas/colunas do quadro)

`Backlog → Em andamento → Revisão → Concluído`

### Rotina de acompanhamento

Alinhamento rápido no início de cada aula (daily) e revisão ao final de cada sprint,
com validação das entregas pelas áreas usuárias.

### Como as demandas/tarefas entram no fluxo (origem e priorização)

As demandas entram pelo backlog, priorizadas pelo Product Owner com base no valor para
as áreas usuárias e na dependência entre tarefas. Prioridades: **M** (Must/obrigatória),
**S** (Should/deveria), **C** (Could/poderia).

### Como será feita a validação das entregas

Cada tarefa é validada contra a Definição de Pronto (DoD) e revisada pelo time antes de
ser movida para "Concluído". As entregas de sprint são apresentadas às áreas usuárias
para validação inicial.

---

## 4) Ferramentas (Gestão e Desenvolvimento)

- **Quadro de tarefas:** GitHub Projects (Kanban) — [link do quadro]
- **Controle de versão (Git):** (x) sim ( ) não
- **Repositório:** ( ) local (x) remoto (GitHub)
- **Ferramentas de desenvolvimento:** VS Code, navegador atualizado, Git, Composer,
  PHP, Node.js, MySQL.

### Regras básicas de uso (combinados do time)

- **Como atualizar o quadro:** atualizar status e responsável ao iniciar e concluir cada
  tarefa, no alinhamento diário.
- **Padrão mínimo de commits:** commits pequenos e coerentes, com mensagem descritiva
  do que foi feito (ex.: "feat: CRUD de departamentos"). Commitar ao concluir uma
  unidade de trabalho.
- **Organização de pastas do projeto:** seguir a estrutura padrão do Laravel
  (`app/`, `database/`, `resources/views`, `routes/`, `docs/`).

---

## 5) Backlog inicial (tarefas priorizadas)

| ID | Tarefa | Prioridade (M/S/C) | Responsável | Critério de pronto (resumo) |
|----|--------|--------------------|-------------|-----------------------------|
| 01 | Estrutura inicial do projeto (Laravel + Git) | M | Jorladson | Repositório versionado, app rodando localmente |
| 02 | CRUD de usuários | M | Ademilson | Cadastrar/editar/excluir/visualizar usuários sem erros |
| 03 | CRUD de empresas | M | Jorladson | Cadastrar/editar/excluir/visualizar empresas sem erros |
| 04 | CRUD de departamentos | M | Ademilson | Cadastrar/editar/excluir/visualizar departamentos sem erros |
| 05 | CRUD de requisições de serviço | M | Jorladson | Abrir/acompanhar/encerrar requisições sem erros |
| 06 | Soft delete e restauração (lixeira) | M | Ademilson | Excluir e restaurar registros sem perda de dados |
| 07 | Detalhamento do fluxo entre departamentos | S | Jorladson | Registrar e exibir o histórico da requisição |
| 08 | Interface responsiva e navegável | S | Ademilson | Layout consistente e navegável no navegador |
| 09 | Validação de formulários | S | Jorladson | Campos validados com mensagens claras |
| 10 | Documentação (README + Plano do Projeto) | M | Ademilson | README e docs atualizados no repositório |

---

## 6) Definição de Pronto (DoD) — critérios mínimos de qualidade

- (x) Funciona no navegador sem erros visíveis
- (x) Sem erros no console (quando aplicável)
- (x) Estrutura HTML organizada/semântica (quando aplicável)
- (x) CSS aplicado conforme padrão combinado
- (x) JS implementado conforme o esperado no MVP (quando aplicável)
- (x) Versionado no repositório com commit(s) coerente(s)
- (x) Atualizado no quadro de tarefas (status e responsável)
- Outros critérios definidos pela equipe: [preencher se necessário]

---

## 7) Cronograma inicial (tarefas e prazos)

| Tarefa/Entregável | Responsável | Data/Aula prevista | Observações |
|-------------------|-------------|--------------------|-------------|
| Estrutura inicial do projeto | Jorladson | 14/08 | Base do repositório |
| CRUD de usuários | Ademilson | 14/08 | Prioridade Must |
| CRUD de empresas | Jorladson | 14/08 | Prioridade Must |
| CRUD de departamentos | Ademilson | 14/08 | Prioridade Must |
| CRUD de requisições de serviço | Jorladson | 14/08 | Prioridade Must |
| Soft delete e restauração | Ademilson | 14/08 | Prioridade Must |
| Detalhamento do fluxo entre departamentos | Jorladson | 14/08 | Prioridade Should |
| Interface responsiva e navegável | Ademilson | 14/08 | Prioridade Should |
| Validação de formulários | Jorladson | 14/08 | Prioridade Should |
| Documentação (README + Plano) | Ademilson | 14/08 | Prioridade Must |

---

## 8) Evidências para entrega (links/prints)

- **Link do repositório:** [https://github.com/adalmeida13-lab/SisRequisicao]
- **Link do quadro de tarefas:** [link do GitHub Projects]
- **Print 1 (quadro com backlog priorizado):** [colar link/imagem no AVA]
- **Print 2 (cronograma ou visão de prazos no quadro):** [colar link/imagem no AVA]
