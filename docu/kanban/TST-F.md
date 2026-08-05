---
tags:
  - kanban/area
  - type/index
  - domain/TST-F
  - version/1.0
parent: "[[desarrollo]]"
children:
  - "[[TST-F-001]]"
  - "[[TST-F-002]]"
  - "[[TST-F-003]]"
  - "[[TST-F-004]]"
  - "[[TST-F-005]]"
  - "[[TST-F-006]]"
  - "[[TST-F-007]]"
  - "[[TST-F-008]]"
  - "[[TST-F-009]]"
  - "[[TST-F-010]]"
  - "[[TST-F-011]]"
  - "[[TST-F-012]]"
  - "[[TST-F-013]]"
  - "[[TST-F-014]]"
depends_on: []
blocks: []
status: active
assignee: "@qa"
created: 2026-08-04
updated: 2026-08-04
---

# 1️⃣4️⃣ TST-F - Pruebas Funcionalidad

**Objetivo**: Pest config, unit tests (100% services), feature tests (auth, roles, 4 dominios), installer E2E, contract tests, browser tests, mutation testing, CI pipeline.

**Owner**: @qa | **Tareas**: 14 | **Progreso**: 0/14 (0%)

## 📋 Tareas

- [ ] [[TST-F-001]] Config Pest + Pest Plugin Laravel + Parallel testing
- [ ] [[TST-F-002]] Unit tests: Services (100% coverage target), Policies, Helpers, Casts
- [ ] [[TST-F-003]] Feature tests: Auth (login, register, verification, reset, 2FA)
- [ ] [[TST-F-004]] Feature tests: Roles + Middleware subdominio (matrix 4 roles × 4 dominios)
- [ ] [[TST-F-005]] Feature tests: Public (landing, listado, detalle, checkout, webhook)
- [ ] [[TST-F-006]] Feature tests: Clientes (dashboard, accesos, perfil, facturas, tickets)
- [ ] [[TST-F-007]] Feature tests: Creadores (onboarding, CRUD canales, stats, retiros, API)
- [ ] [[TST-F-008]] Feature tests: Admin (config, staff, transacciones, logs, flags)
- [ ] [[TST-F-009]] Feature tests: CRM (tickets, cliente360, KB, reportes, automatizaciones)
- [ ] [[TST-F-010]] Feature tests: Instalador (E2E 5 pasos, edge cases, rollback)
- [ ] [[TST-F-011]] Contract tests: Webhooks Telegram + Pasarelas (Pact/Mockery)
- [ ] [[TST-F-012]] Browser tests: Critical paths (Laravel Dusk) - 5 journeys
- [ ] [[TST-F-013]] Mutation testing: Infection (target >80% MSI)
- [ ] [[TST-F-014]] CI Pipeline: GitHub Actions (lint, phpstan, test, coverage)

## 🔗 Enlaces
- [[desarrollo]] — Índice maestro
- [[todo]] — Planificación completa