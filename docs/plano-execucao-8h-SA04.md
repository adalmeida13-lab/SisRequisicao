# Plano de Execução (8h) - SA04
## SisRequisição - Organização do Trabalho e Definição de Prazos

**UC:** Desenvolvimento de Sistemas  
**Equipe:** Jorladson, Ademilson, Marcos  
**Data:** 13/08/2026  
**Carga horária:** 8 horas (2 aulas de 4h)

---

## 1. Objetivo

Organizar e executar tarefas remanescentes do protótipo SisRequisição com foco em:
- Finalizar views incompletas (show, edit)
- Implementar melhorias de UX (mensagens flash, breadcrumbs)
- Garantir acessibilidade e documentação técnica
- Acompanhar progresso com quadro de tarefas e ajustes de planejamento

---

## 2. Lista de Tarefas "MUST" para 8h

### Aula 1 (4h) - Implementação de Views e UX

| ID | Tarefa | Prioridade | Responsável | Estimativa | Prazo |
|----|--------|-----------|-------------|------------|-------|
| T01 | Implementar view show.blade.php completa | **MUST** | Jorladson | M (média) | A1 |
| T02 | Implementar view edit.blade.php completa | **MUST** | Ademilson | M (média) | A1 |
| T03 | Criar sistema de mensagens flash (sucesso/erro) | **MUST** | Marcos | P (pequena) | A1 |
| T04 | Melhorar acessibilidade (aria-labels, roles) | **MUST** | Jorladson | P (pequena) | A1 |

### Aula 2 (4h) - Navegação, Documentação e Qualidade

| ID | Tarefa | Prioridade | Responsável | Estimativa | Prazo |
|----|--------|-----------|-------------|------------|-------|
| T05 | Adicionar breadcrumbs em todas as views | **MUST** | Ademilson | M (média) | A2 |
| T06 | Criar documentação técnica (arquitetura) | **MUST** | Marcos | M (média) | A2 |
| T07 | Testar fluxo completo e documentar cenários | **MUST** | Jorladson | G (grande) | A2 |
| T08 | Atualizar README e fazer prints do quadro | **MUST** | Equipe | P (pequena) | A2 |

---

## 3. Método de Estimativa

**Modelo usado:** P/M/G (Pequena/Média/Grande)

### Justificativas

| Tarefa | Estimativa | Justificativa |
|--------|-----------|--------------|
| T01 - View show.blade.php | M | Requer layout estruturado com cards e botões de ação |
| T02 - View edit.blade.php | M | Precisa copiar estrutura do create.blade.php e adaptar |
| T03 - Mensagens flash | P | Componente simples usando session() do Laravel |
| T04 - Acessibilidade | P | Adicionar atributos ARIA e ajustar labels existentes |
| T05 - Breadcrumbs | M | Criar componente reutilizável e integrar em 5 views |
| T06 - Documentação técnica | M | Documentar rotas, fluxos e estrutura de pastas |
| T07 - Testes manuais | G | Testar CRUD completo, validações e casos de erro |
| T08 - README e prints | P | Atualizar documentação e capturar evidências |

---

## 4. Riscos e Dificuldades Previstas

### Risco 1: Conflito de edição simultânea em arquivos
**Descrição:** Múltiplos integrantes editando o mesmo arquivo (ex: routes/web.php)  
**Ação preventiva:**
- Cada integrante trabalha em arquivos diferentes na Aula 1
- Commits pequenos e frequentes
- Comunicação no grupo antes de editar arquivo compartilhado

### Risco 2: Falta de tempo para finalizar documentação
**Descrição:** Tarefas de código podem atrasar e comprometer tempo de docs  
**Ação preventiva:**
- Reservar 45 minutos finais da Aula 2 exclusivos para documentação
- Priorizar tarefas MUST sobre SHOULD/COULD
- Se houver atraso, dividir tarefa grande em subtarefas menores

### Risco 3: Erros de validação não previstos
**Descrição:** Testes podem revelar bugs em validações do formulário  
**Ação preventiva:**
- Usar ambiente de testes local (não produção)
- Documentar bugs encontrados em issues do GitHub
- Ajustar prioridades se bug crítico for encontrado

---

## 5. Planejado x Realizado

### Aula 1 (4h)

**Planejado:**
- Finalizar views show e edit
- Implementar sistema de mensagens flash
- Melhorar acessibilidade das views existentes

**Realizado:**
- ✅ View show.blade.php implementada com cards e ações
- ✅ View edit.blade.php implementada com formulário completo
- ✅ Sistema de mensagens flash criado
- ✅ Atributos ARIA adicionados em create e index
- ⚠️ **Ajuste:** T04 dividida em T04a (create/index) e T04b (show/edit) - atraso de 30min

---

### Aula 2 (4h)

**Planejado:**
- Adicionar breadcrumbs em todas as views
- Criar documentação técnica completa
- Testar fluxo CRUD completo
- Atualizar README e capturar prints

**Realizado:**
- ✅ Breadcrumbs implementados como componente reutilizável
- ✅ Documentação técnica criada em /docs/arquitetura-tecnica.md
- ✅ 12 cenários de teste documentados e executados
- ✅ README atualizado com seção SA04
- ✅ 2 prints do quadro capturados (final A1 e final A2)

---

## 6. Ajustes de Planejamento Realizados

### Ajuste 1 (Durante Aula 1)
**O que foi ajustado:** Tarefa T04 (Acessibilidade) dividida em T04a e T04b  
**Motivo:** Atraso de 30 minutos na implementação da view edit - complexidade maior que previsto  
**Ação tomada:** Responsável Jorladson iniciou T04a (views já prontas) e deixou T04b para início da Aula 2  
**Evidência:** Card "T04 - Acessibilidade" movido para "Fazendo" no final da A1 (parcialmente concluído)

### Ajuste 2 (Durante Aula 2)
**O que foi ajustado:** Repriorização - T07 (Testes) executada antes de T06 (Docs)  
**Motivo:** Testes revelaram 2 bugs que precisaram correção imediata  
**Ação tomada:** Marcos pausou documentação para corrigir bugs, depois retomou  
**Evidência:** Commits "fix: corrige validação de data" e "fix: ajusta redirect após update"

---

## 7. Lições Aprendidas

1. **Estimativas mais realistas:** Views complexas devem ser estimadas como "M" ou "G", não "P"
2. **Importância de testes:** Executar testes ANTES de documentar evita retrabalho
3. **Comunicação contínua:** Avisar o grupo sobre atrasos permite ajustes rápidos
4. **Commits atômicos:** Facilita reversão de erros e histórico mais claro

---

## 8. Status Final das Tarefas

| ID | Tarefa | Status | Observações |
|----|--------|--------|-------------|
| T01 | View show.blade.php | ✅ Concluída | Implementada com cards Bootstrap |
| T02 | View edit.blade.php | ✅ Concluída | Formulário igual ao create.blade.php |
| T03 | Mensagens flash | ✅ Concluída | Componente alert.blade.php criado |
| T04 | Acessibilidade | ✅ Concluída | Atributos ARIA em todas as 4 views |
| T05 | Breadcrumbs | ✅ Concluída | Componente breadcrumb.blade.php criado |
| T06 | Documentação técnica | ✅ Concluída | 3 páginas de docs em /docs/ |
| T07 | Testes manuais | ✅ Concluída | 12 cenários testados e documentados |
| T08 | README e prints | ✅ Concluída | README atualizado + 2 prints enviados |

---

**Total de tarefas:** 8  
**Concluídas:** 8 (100%)  
**Ajustes de planejamento:** 2  
**Bugs encontrados e corrigidos:** 2

---

*Documento gerado pela Equipe SisRequisição - SA04*  
*Última atualização: 13/08/2026*
