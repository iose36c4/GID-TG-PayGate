---
tags:
  - kanban/area
  - type/index
  - domain/TST-P
  - version/1.0
parent: "[[desarrollo]]"
children:
  - "[[TST-P-001]]"
  - "[[TST-P-002]]"
  - "[[TST-P-003]]"
  - "[[TST-P-004]]"
  - "[[TST-P-005]]"
  - "[[TST-P-006]]"
  - "[[TST-P-007]]"
  - "[[TST-P-008]]"
  - "[[TST-P-009]]"
  - "[[TST-P-010]]"
  - "[[TST-P-011]]"
depends_on: []
blocks: []
status: active
assignee: "@qa"
created: 2026-08-04
updated: 2026-08-04
---

# 1️⃣5️⃣ TST-P - Pruebas Rendimiento

**Objetivo**: Baseline Octane, load test (100 VU <500ms p95), stress, soak, spike, DB optimization, queue, cache, frontend Lighthouse, profiling, benchmarks.

**Owner**: @qa | **Tareas**: 11 | **Progreso**: 0/11 (0%)

## 📋 Tareas

- [ ] [[TST-P-001]] Baseline: Laravel Octane (Swoole/RoadRunner) eval + config
- [ ] [[TST-P-002]] Load test: k6/Gatling - 100 VU checkout + webhook (target <500ms p95)
- [ ] [[TST-P-003]] Stress test: Ramp to breaking point (identificar bottlenecks)
- [ ] [[TST-P-004]] Soak test: 2h sustained load (memory leaks, queue backlog)
- [ ] [[TST-P-005]] Spike test: Sudden 10x traffic (cache warming, queue scaling)
- [ ] [[TST-P-006]] Database: Query optimization (EXPLAIN, indexes, n+1 detection)
- [ ] [[TST-P-007]] Queue: Job throughput, retry logic, dead letter handling
- [ ] [[TST-P-008]] Cache: Hit ratios, Redis/Database driver comparison
- [ ] [[TST-P-009]] Frontend: Lighthouse CI (Performance >90, Accessibility >95)
- [ ] [[TST-P-010]] Profiling: Blackfire/Xdebug en staging (hot paths)
- [ ] [[TST-P-011]] Benchmarks: Documentar baseline v1.0 para regresión futura

## 🔗 Enlaces
- [[desarrollo]] — Índice maestro
- [[todo]] — Planificación completa