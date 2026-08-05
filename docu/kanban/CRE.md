---
tags:
  - kanban/area
  - type/index
  - domain/CRE
  - version/1.0
parent: "[[desarrollo]]"
children:
  - "[[CRE-001]]"
  - "[[CRE-002]]"
  - "[[CRE-003]]"
  - "[[CRE-004]]"
  - "[[CRE-005]]"
  - "[[CRE-006]]"
  - "[[CRE-007]]"
  - "[[CRE-008]]"
  - "[[CRE-009]]"
  - "[[CRE-010]]"
  - "[[CRE-011]]"
  - "[[CRE-012]]"
  - "[[CRE-013]]"
  - "[[CRE-014]]"
  - "[[CRE-015]]"
  - "[[CRE-016]]"
  - "[[CRE-017]]"
depends_on: []
blocks: []
status: active
assignee: "@dev"
created: 2026-08-04
updated: 2026-08-04
---

# 8️⃣ CRE - Web Creadores (Panel Creadores)

**Objetivo**: Onboarding, dashboard métricas, CRUD canales, gestión suscripciones, analytics, retiros, webhooks, API tokens, config, equipo, pasarelas, fiscal, ciclos cobro, facturación.

**Owner**: @dev | **Tareas**: 17 | **Progreso**: 0/17 (0%)

## 📋 Tareas

- [ ] [[CRE-001]] Onboarding creador: wizard 4 pasos (datos, canal, bot, precios)
- [ ] [[CRE-002]] Dashboard: MRR, suscriptores activos, churn, LTV, gráficos (Chart.js/ApexCharts)
- [ ] [[CRE-003]] Canales CRUD: vincular bot (token encrypted), canal/grupo ID, precios, moneda, trial
- [ ] [[CRE-004]] Gestión suscripciones: lista, buscar, filtrar, ver detalle, cancelar manual, renovar
- [ ] [[CRE-005]] Analytics canal: cohort retention, revenue per user, funnel conversión
- [ ] [[CRE-006]] Retiros: configurar cuenta (tokenizado Stripe Connect/MercadoPago), solicitar, historial
- [ ] [[CRE-007]] Webhooks entrantes: logs, reintentar, debugging, firma verificación
- [ ] [[CRE-008]] API Tokens: crear, rotar, scopes (read:channels, write:webhooks), expiración
- [ ] [[CRE-009]] Configuración: marca blanca (logo, colores, dominio personalizado v1.1), notificaciones
- [ ] [[CRE-010]] Equipo: invitar colaboradores (roles: owner, admin, analytics, support)
- [ ] [[CRE-011]] Configuración pasarelas de pago: MercadoPago (credenciales, webhook URL), Stripe Connect, transferencias bancarias
- [ ] [[CRE-012]] Ciclos de cobro: configurar frecuencia (5 días, 15 días, mensual), mínimo retiro, comisiones
- [ ] [[CRE-013]] Facturación creadores: factura A/B/C, PDF, envío email, AFIP CAE, descarga, historial
- [ ] [[CRE-014]] Configuración MercadoPago Argentina: SDK, credenciales, pagos efectivo (PagoFácil/Rapipago), cuotas sin interés
- [ ] [[CRE-015]] Configuración fiscal creador: tipo contribuyente (Monotributo/RI/Exento), IVA, Ganancias, IIBB, domicilio fiscal
- [ ] [[CRE-016]] Ciclos de cobro creador: frecuencia (5 días, 15 días, mensual), mínimo retiro, retenciones automáticas
- [ ] [[CRE-017]] Facturación creador: factura A/B/C según categoría, PDF, AFIP CAE, envío email, descarga

## 🔗 Enlaces
- [[desarrollo]] — Índice maestro
- [[todo]] — Planificación completa