---
tags:
  - "kanban/in-progress"
  - "type/container"
parent: "null"
children: []
status: "in-progress"
created: "2026-08-04"
updated: "2026-08-06"
---

# En Progreso

> Las tareas se mueven aquí desde `todo.md` cuando se inicia trabajo activo.

## Convención
- Una tarea **atómica** por desarrollador a la vez
- Actualizar `updated` al mover
- Referenciar PR/commit en la tarea
- Máximo 2 tareas en progreso simultáneo (WIP limit)

## Tareas Actuales
> Se poblarán al iniciar el desarrollo

---

## Plantilla de Movimiento
Al mover una tarea aquí, actualizar su frontmatter:
```yaml
tags:
  - kanban/in-progress  # Cambiar de kanban/todo
status: in-progress
updated: 2026-08-XX
```