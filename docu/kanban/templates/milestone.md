---
tags:
  - kanban/todo
  - type/milestone
  - version/1.0
parent: "[[version-1.0]]"
children:
  - "[[EPIC-CHILD-1]]"
  - "[[EPIC-CHILD-2]]"
depends_on: []
blocks: []
status: todo
assignee: "@lead"
created: 2026-08-04
updated: 2026-08-04
---

# [[MILESTONE-ID]] Nombre del Hito

## Descripción
Hito intermedio que agrupa épicas. Ej: Alfa, Beta, RC.

## Criterios de Finalización
- [ ] Todas las épicas hijas completadas
- [ ] Tests passing (suite completa)
- [ ] Documentación actualizada
- [ ] Deploy a staging verificado
- [ ] Aprobación stakeholder

## Épicas Incluidas
- [[EPIC-CHILD-1]] Descripción
- [[EPIC-CHILD-2]] Descripción

## Fecha Objetivo
2026-XX-XX

## Definition of Done del Hito
- [ ] Code freeze
- [ ] Regression testing completo
- [ ] Performance baseline documentado
- [ ] Security scan passing
- [ ] Release notes redactadas

## Enlaces
- [[version-1.0]] Versión padre
- [[MILESTONE-NEXT]] Siguiente hito