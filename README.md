# Sistema de Requisição (SisRequisicao)

## Objetivo

Sistema interno para registrar e acompanhar requisições de serviço entre as áreas
(administrativo, atendimento e operação) de uma organização de médio porte. O MVP
permite cadastrar usuários, empresas e departamentos, além de abrir, acompanhar e
encerrar requisições de serviço com rastreabilidade do fluxo entre departamentos.

## Tecnologias

- **Back-end:** PHP 8 + Laravel
- **Front-end:** Blade (HTML + CSS) + JavaScript
- **Banco de dados:** MySQL (via Eloquent ORM)
- **Versionamento:** Git + GitHub

## Metodologia de desenvolvimento

- **Metodologia:** Scrum (ágil)
- **Por que escolhemos:** o contexto exige lidar com mudanças de prioridade e tempo
  limitado. O Scrum organiza o trabalho em sprints curtas, com papéis definidos,
  reuniões de planejamento/revisão e entregas incrementais validadas pelas áreas
  usuárias, garantindo rastreabilidade do que foi combinado e entregue.

## Como vamos trabalhar

- **Fluxo:** Backlog → Em andamento → Revisão → Concluído
- **Rotina de acompanhamento:** alinhamento rápido no início de cada aula e revisão
  ao final de cada sprint.
- **Ferramenta de tarefas:** GitHub Projects (quadro Kanban) — [link do quadro]

## Definição de pronto (DoD)

- Funciona no navegador sem erros visíveis.
- Sem erros no console (quando aplicável).
- Estrutura HTML organizada/semântica.
- CSS aplicado conforme padrão combinado.
- JS implementado conforme o esperado no MVP.
- Versionado no repositório com commit(s) coerente(s).
- Atualizado no quadro de tarefas (status e responsável).

## Como executar

Pré-requisitos: PHP 8+, Composer, Node.js e um banco MySQL.

```bash
# 1. Instalar dependências
composer install
npm install

# 2. Configurar ambiente
cp .env.example .env
php artisan key:generate
# edite o .env com as credenciais do banco

# 3. Criar o banco e rodar as migrations
php artisan migrate

# 4. Subir o servidor local
php artisan serve
```

Acesse `http://localhost:8000`.

## Documentação

- [Plano do Projeto (SA01)](docs/plano-do-projeto-SA01.md)

## Estrutura de pastas

```
app/            Código da aplicação (Controllers, Models)
database/       Migrations, factories e seeders
resources/views Views Blade (HTML/CSS/JS)
routes/         Definição de rotas
docs/           Documentação do projeto
```
