---
tags:
  - kanban/area
  - type/index
  - domain/INS
  - version/1.0
parent: "[[desarrollo]]"
children:
  - "[[INS-001]]"
  - "[[INS-002]]"
  - "[[INS-003]]"
  - "[[INS-004]]"
  - "[[INS-005]]"
  - "[[INS-006]]"
  - "[[INS-007]]"
  - "[[INS-008]]"
  - "[[INS-009]]"
  - "[[INS-010]]"
  - "[[INS-011]]"
  - "[[INS-012]]"
depends_on: []
blocks: []
status: active
assignee: "@devops"
created: 2026-08-04
updated: 2026-08-04
---

# 1️⃣1️⃣ INS - Instalador Portable

**Objetivo**: Middleware redirect, helper detección, rutas instalador, 5+ pasos (requisitos, DB, migraciones, admin, finalizar), seguridad, multi-idioma, config pasarelas, config fiscal AR.

**Owner**: @devops | **Tareas**: 12 | **Progreso**: 0/12 (0%)

## 📋 Tareas

- [ ] [[INS-001]] Middleware `RedirectIfNotInstalled` (global, excluye `/install/*`, assets)
- [ ] [[INS-002]] Helper `Installation::isInstalled()` (file + env + migrations + DB connectivity)
- [ ] [[INS-003]] Rutas `routes/install.php` (throttle, CSRF, sin auth, rate limit)
- [ ] [[INS-004]] Paso 1: Requisitos (PHP 8.2+, extensiones, permisos, functions)
- [ ] [[INS-005]] Paso 2: Base de Datos (form + AJAX test connection + driver check)
- [ ] [[INS-006]] Paso 3: Migraciones + Seeders (artisan migrate --force + roles/perms)
- [ ] [[INS-007]] Paso 4: Admin Inicial (nombre, email, pass confirm, role=admin, 2FA opcional)
- [ ] [[INS-008]] Paso 5: Finalizar (escribir .env, APP_KEY, storage/installed, optimize:clear)
- [ ] [[INS-009]] Seguridad: anti-reinstall, honeypot, CSP, HSTS en instalador
- [ ] [[INS-010]] Multi-idioma: es/en (fallback), RTL ready
- [ ] [[INS-011]] Paso 2.5: Configuración pasarelas de pago (MercadoPago, Stripe, transferencias, test mode)
- [ ] [[INS-012]] Paso 2.6: Configuración fiscal Argentina (IVA, Ganancias, IIBB, AFIP CAE, factura A/B/C)

## 🔗 Enlaces
- [[desarrollo]] — Índice maestro
- [[todo]] — Planificación completa