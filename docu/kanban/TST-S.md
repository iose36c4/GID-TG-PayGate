---
tags:
  - kanban/area
  - type/index
  - domain/TST-S
  - version/1.0
parent: "[[desarrollo]]"
children:
  - "[[TST-S-001]]"
  - "[[TST-S-002]]"
  - "[[TST-S-003]]"
  - "[[TST-S-004]]"
  - "[[TST-S-005]]"
  - "[[TST-S-006]]"
  - "[[TST-S-007]]"
  - "[[TST-S-008]]"
  - "[[TST-S-009]]"
  - "[[TST-S-010]]"
  - "[[TST-S-011]]"
  - "[[TST-S-012]]"
depends_on: []
blocks: []
status: active
assignee: "@sec"
created: 2026-08-04
updated: 2026-08-04
---

# 1️⃣6️⃣ TST-S - Pruebas Seguridad

**Objetivo**: SAST (PHPStan 5 + Psalm), dependency scan, secrets audit, DAST (ZAP), pentest checklist OWASP Top 10, auth security, API security, file upload, encryption, headers, logging, compliance GDPR/PCI.

**Owner**: @sec | **Tareas**: 12 | **Progreso**: 0/12 (0%)

## 📋 Tareas

- [ ] [[TST-S-001]] SAST: PHPStan nivel 5 + Psalm (security rulesets)
- [ ] [[TST-S-002]] Dependency scan: Composer audit + GitHub Dependabot + OWASP Dependency Check
- [ ] [[TST-S-003]] Secrets audit: TruffleHog/GitLeaks en CI + pre-commit hook
- [ ] [[TST-S-004]] DAST: OWASP ZAP scan staging (authenticated + unauthenticated)
- [ ] [[TST-S-005]] Pentest checklist: OWASP Top 10 + Laravel specific (mass assignment, SQLi, XSS, CSRF)
- [ ] [[TST-S-006]] Auth security: Rate limiting, brute force, session fixation, 2FA bypass
- [ ] [[TST-S-007]] API security: Token scopes, rate limits, CORS, signed URLs
- [ ] [[TST-S-008]] File upload: Validación MIME, size, storage isolation, antivirus scan
- [ ] [[TST-S-009]] Encryption: Verificar AES-256 tokens Telegram, rotación claves, KMS ready
- [ ] [[TST-S-010]] Headers: CSP, HSTS, X-Frame-Options, Referrer-Policy, Permissions-Policy
- [ ] [[TST-S-011]] Logging: No PII/secrets en logs, structured JSON, retention, alerting
- [ ] [[TST-S-012]] Compliance: GDPR (right to delete, export, consent), PCI-DSS (no card storage)

## 🔗 Enlaces
- [[desarrollo]] — Índice maestro
- [[todo]] — Planificación completa