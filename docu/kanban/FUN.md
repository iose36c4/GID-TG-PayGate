---
tags:
  - kanban/area
  - type/index
  - domain/FUN
  - version/1.0
parent: "[[desarrollo]]"
children:
  - "[[FUN-001]]"
  - "[[FUN-002]]"
  - "[[FUN-003]]"
  - "[[FUN-004]]"
  - "[[FUN-005]]"
  - "[[FUN-006]]"
  - "[[FUN-007]]"
  - "[[FUN-008]]"
  - "[[FUN-009]]"
depends_on: []
blocks: []
status: active
assignee: "@dev"
created: 2026-08-04
updated: 2026-08-04
---

# 1️⃣ FUN - Fundación Laravel + Arquitectura

**Objetivo**: Base técnica sólida: Laravel 11, arquitectura Domain-Driven, subdominios dinámicos, auth/permisos, seeders, config multi-entorno.

**Owner**: @dev | **Tareas**: 9 | **Progreso**: 0/9 (0%)

## 📋 Tareas

- [ ] [[FUN-001]] Inicializar proyecto Laravel 11 + dependencias core
- [ ] [[FUN-002]] Configurar estructura `app/Domains/{Public,Creadores,Staff}`
- [ ] [[FUN-003]] Configurar `RouteServiceProvider` para subdominios dinámicos
- [ ] [[FUN-004]] Crear middleware `EnsureCorrectSubdomain` (rol ↔ subdominio)
- [ ] [[FUN-005]] Instalar y configurar `spatie/laravel-permission`
- [ ] [[FUN-006]] Migración `users` + campos: `role` (enum), `telegram_id`, `email_verified_at`, `settings` (JSON)
- [ ] [[FUN-007]] Seeders: Roles (user, creador, staff, admin) + Permisos base
- [ ] [[FUN-008]] Configurar `.env.example` portable + `config/*` multi-dominio
- [ ] [[FUN-009]] BaseService, BaseController, ApiResponse trait, Exception Handler global

## 🔗 Enlaces
- [[desarrollo]] — Índice maestro
- [[todo]] — Planificación completa