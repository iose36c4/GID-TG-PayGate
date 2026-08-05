---
tags:
  - kanban/area
  - type/index
  - domain/SEC
  - version/1.0
parent: "[[desarrollo]]"
children:
  - "[[SEC-001]]"
  - "[[SEC-002]]"
  - "[[SEC-003]]"
  - "[[SEC-004]]"
  - "[[SEC-005]]"
  - "[[SEC-006]]"
  - "[[SEC-007]]"
  - "[[SEC-008]]"
  - "[[SEC-009]]"
  - "[[SEC-010]]"
  - "[[SEC-011]]"
  - "[[SEC-012]]"
  - "[[SEC-013]]"
  - "[[SEC-014]]"
  - "[[SEC-015]]"
  - "[[SEC-016]]"
  - "[[SEC-017]]"
  - "[[SEC-018]]"
  - "[[SEC-019]]"
  - "[[SEC-020]]"
  - "[[SEC-021]]"
  - "[[SEC-022]]"
  - "[[SEC-023]]"
  - "[[SEC-024]]"
  - "[[SEC-025]]"
  - "[[SEC-026]]"
  - "[[SEC-027]]"
  - "[[SEC-028]]"
  - "[[SEC-029]]"
  - "[[SEC-030]]"
  - "[[SEC-031]]"
  - "[[SEC-032]]"
  - "[[SEC-033]]"
  - "[[SEC-034]]"
  - "[[SEC-035]]"
  - "[[SEC-036]]"
  - "[[SEC-037]]"
  - "[[SEC-038]]"
  - "[[SEC-039]]"
  - "[[SEC-040]]"
  - "[[SEC-041]]"
  - "[[SEC-042]]"
  - "[[SEC-043]]"
  - "[[SEC-044]]"
  - "[[SEC-045]]"
  - "[[SEC-046]]"
  - "[[SEC-047]]"
  - "[[SEC-048]]"
  - "[[SEC-049]]"
  - "[[SEC-050]]"
depends_on: []
blocks: []
status: active
assignee: "@dev"
created: 2026-08-05
updated: 2026-08-05
---

# 1️⃣7️⃣ SEC - Seguridad y Arquitectura del Dominio Financiero

**Objetivo**: Diseñar TG-PayGate como **sistema transaccional** antes que como aplicación: modelo de amenazas, núcleo de dominio financiero (Money, Ledger, máquinas de estado, idempotencia), autorización, seguridad de webhooks/Telegram, auditoría, observabilidad y pruebas ofensivas avanzadas. Este área **condiciona todas las demás** y debe completarse antes de implementar features de pago.

**Owner**: @dev | **Tareas**: 50 | **Progreso**: 0/50 (0%)

## 📋 Tareas

### Grupo A — Modelo de Amenazas y Baseline (Fase 0)
- [ ] [[SEC-001]] Threat Modeling STRIDE global (P0)
- [ ] [[SEC-002]] Trust Boundaries + DFD (P0)
- [ ] [[SEC-003]] Security Risk Register + mitigaciones (P0)
- [ ] [[SEC-004]] Security Baseline transversal (P0)

### Grupo B — Núcleo del Dominio Financiero
- [ ] [[SEC-005]] Money Value Object (integer cents, nunca float) (P0)
- [ ] [[SEC-006]] Currency + multi-moneda (P0)
- [ ] [[SEC-007]] Entidades dominio financiero (Invoice, Balance, Withdrawal, Refund, Settlement, Fee, Transfer) (P0)
- [ ] [[SEC-008]] Ledger de doble entrada inmutable (P0)
- [ ] [[SEC-009]] Ledger entries + reconstrucción de balances (P0)
- [ ] [[SEC-010]] Invariantes de balance + auditoría de consistencia (P0)
- [ ] [[SEC-011]] Máquina de estados del Payment (P0)
- [ ] [[SEC-012]] Máquina de estados del Refund (P1)
- [ ] [[SEC-013]] Máquina de estados del Withdrawal (P0)
- [ ] [[SEC-014]] Máquina de estados del Invoice (P0)
- [ ] [[SEC-015]] Disputas/Chargeback + congelamiento de fondos (P1)
- [ ] [[SEC-016]] Idempotencia Idempotency-Key (P0)
- [ ] [[SEC-017]] Eventos de dominio financieros (P1)
- [ ] [[SEC-018]] Event store ligero + reprocesamiento (P1)
- [ ] [[SEC-019]] Reconciliación sistema ↔ proveedor ↔ banco ↔ ledger (P1)

### Grupo C — Concurrencia y Procesos Programados
- [ ] [[SEC-020]] Concurrencia: SELECT FOR UPDATE + optimistic locking (P0)
- [ ] [[SEC-021]] Distributed locks + deadlock retry + updates atómicos (P1)
- [ ] [[SEC-034]] Scheduler: expirar invoices, retry webhooks, orphans (P0)
- [ ] [[SEC-035]] Job retry pipeline + dead letter queue (P1)

### Grupo D — Autorización
- [ ] [[SEC-022]] Arquitectura de autorización (separada de auth) (P0)
- [ ] [[SEC-023]] Laravel Policies por entidad financiera (P0)
- [ ] [[SEC-024]] RBAC escalable: roles + permisos + contextos (P1)
- [ ] [[SEC-025]] ABAC + tenant scoping creador→recursos propios (P1)
- [ ] [[SEC-026]] Scopes API + service tokens (P1)
- [ ] [[SEC-027]] Matriz de acceso + tests de autorización (P1)

### Grupo E — Webhooks, Telegram y Rate Limiting
- [ ] [[SEC-028]] Webhook verification: firma, timestamp, nonce, replay (P0)
- [ ] [[SEC-029]] Webhook retry + backoff + DLQ (P0)
- [ ] [[SEC-030]] Webhook delivery log + rotación de claves de firma (P1)
- [ ] [[SEC-031]] Seguridad Telegram: firma, replay, origen (P0)
- [ ] [[SEC-032]] Telegram flood control + rate limit + expiración (P1)
- [ ] [[SEC-033]] Rate limiting por área (P0)

### Grupo F — Auditoría, Observabilidad y Secretos
- [ ] [[SEC-036]] Audit log completo (actor, IP, payload hash, correlation id) (P0)
- [ ] [[SEC-037]] Correlation IDs X-Correlation-ID (P0)
- [ ] [[SEC-038]] Observabilidad: OpenTelemetry, metrics, alerting (P1)
- [ ] [[SEC-039]] Structured logging sin PII/secretos (P0)
- [ ] [[SEC-040]] Secret Management: rotación + key versioning (P0)
- [ ] [[SEC-041]] Sesiones: fixation, rotation, refresh, revocación (P1)
- [ ] [[SEC-042]] Backups, DR, PITR y restore tests (P1)

### Grupo G — Pruebas Avanzadas de Seguridad
- [ ] [[SEC-043]] Tests de concurrencia y race conditions (P1)
- [ ] [[SEC-044]] Fault injection + chaos testing en pagos (P2)
- [ ] [[SEC-045]] Replay testing + fuzzing (P1)
- [ ] [[SEC-046]] Property-based testing del dominio financiero (P2)
- [ ] [[SEC-047]] Pentest ofensivo I: SSRF, XXE, IDOR, Mass Assignment, Host Header (P0)
- [ ] [[SEC-048]] Pentest ofensivo II: Smuggling, Cache Poisoning, Zip Bomb, Timing (P1)
- [ ] [[SEC-049]] Pentest ofensivo III: JWT/OAuth, CSRF/CSP bypass, Unicode, Prototype Pollution (P1)
- [ ] [[SEC-050]] Cadencia de revisión de seguridad (Security Review) (P1)

## 🔗 Enlaces
- [[desarrollo]] — Índice maestro
- [[todo]] — Planificación completa
- [[DOC-002]] ADR DDD
- [[DOC-008]] Spec pasarelas de pago
- [[TST-S-001]] SAST
- [[TST-S-005]] Pentest checklist
