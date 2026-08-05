---
name: kanban
description: Operaciones completas del tablero Kanban vía CLI Node.js: CRUD tareas, métricas (CFD, lead time, WIP, throughput), Git sync (commits/PRs), validación, auto-archive. Usable en modo plan y build.
license: MIT
compatibility: opencode
metadata:
  version: "1.0"
  author: "@dev"
  board-path: "docu/kanban"
  task-path: "docu/kanban/tasks"
  template-path: "docu/kanban/templates"
  cli-path: ".opencode/skills/kanban/scripts/kanban.js"
---

## Qué Hago
Proporciono **operaciones programáticas completas** para el tablero Kanban de TG-PayGate mediante un CLI Node.js autocontenido (`kanban.js`). Sin dependencias externas, funciona en cualquier entorno con Node.js.

## Operaciones Disponibles

### 📋 CRUD Tareas
| Comando | Descripción |
|---------|-------------|
| `read [columna]` | Lee columna o tablero completo |
| `create <tipo> <dominio> --title "..."` | Crea desde template (task, bug, epic, milestone) |
| `move <ID> <columna>` | Mueve entre columnas (autodetecta origen) |
| `update <ID> [--set campo=val] [--append "..."]` | Actualiza frontmatter y/o body |
| `delete <ID> [--hard]` | Archiva (si done) o elimina |

### 📊 Métricas Avanzadas
| Comando | Descripción |
|---------|-------------|
| `metrics cfd [--days 30]` | Cumulative Flow Diagram |
| `metrics lead-time [--ids A,B]` | Lead time (creado→done) y cycle time (in-progress→done) |
| `metrics wip [--limits '{"in-progress":2}']` | WIP vs límites, aging, tareas bloqueadas |
| `metrics throughput [--weeks 12]` | Throughput semanal, trend, rolling average |

### 🔄 Git Sync Automation
| Comando | Descripción |
|---------|-------------|
| `git sync-commits [--since D] [--until D] [--apply]` | Parsea `feat/fix/move/review/done(ID)` y mueve tareas |
| `git sync-prs [--apply]` | PRs abiertos→review, merged→done (requiere `gh` CLI) |

### 🛠️ Utilidades
| Comando | Descripción |
|---------|-------------|
| `validate` | IDs únicos, links rotos, frontmatter válido, parent/children bidireccional |
| `archive [--days 7] [--apply]` | Mueve done > N días a done.md histórico |

## Convenciones de Frontmatter (Obligatorias)
```yaml
tags:
  - kanban/{backlog|todo|in-progress|review|done}
  - type/{task|bug|epic|milestone}
  - domain/{FUN|UX|UI|WEB|CSS|PUB|CLI|CRE|ADM|CRM|INS|DOC|KAN|TST-F|TST-P|TST-S}
  - priority/P{0-3}
parent: "[[PARENT-ID]]"  # null si root
children: ["[[CHILD-ID]]"]
depends_on: ["[[DEP-ID]]"]
blocks: ["[[BLOCKED-ID]]"]
status: {todo|in-progress|review|done}
assignee: "@dev|@kanban|@user"
created: "YYYY-MM-DD"
updated: "YYYY-MM-DD"
```

## Dominios Soportados (16)
`FUN` `UX` `UI` `WEB` `CSS` `PUB` `CLI` `CRE` `ADM` `CRM` `INS` `DOC` `KAN` `TST-F` `TST-P` `TST-S`

## Patrones de Commit para Auto-Sync
```bash
feat(FUN-001): descripción      # Iniciar trabajo
fix(UI-003): descripción        # Bugfix
move(FUN-001→in-progress): ...  # Movimiento manual
review(FUN-001): PR #123        # PR abierto
done(FUN-001): merged           # PR mergeado
```

## Auto-Mantenimiento (Regla de Oro)
> **El agente @kanban TIENE PERMISO y DEBE modificar sus propios archivos** para:
> 1. Corregir bugs detectados en validación
> 2. Añadir operaciones nuevas solicitadas
> 3. Optimizar rendimiento
> 4. Adaptar a cambios en convención de frontmatter
> 
> **Proceso**: Propone cambio → `kanban.js validate` → Aplica → Confirma funcionando