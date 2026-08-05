---
tags:
  - kanban/area
  - type/index
  - domain/PUB
  - version/1.0
parent: "[[desarrollo]]"
children:
  - "[[PUB-001]]"
  - "[[PUB-002]]"
  - "[[PUB-003]]"
  - "[[PUB-004]]"
  - "[[PUB-005]]"
  - "[[PUB-006]]"
  - "[[PUB-007]]"
  - "[[PUB-008]]"
  - "[[PUB-009]]"
  - "[[PUB-010]]"
  - "[[PUB-011]]"
  - "[[PUB-012]]"
  - "[[PUB-013]]"
  - "[[PUB-014]]"
  - "[[PUB-015]]"
  - "[[PUB-016]]"
  - "[[PUB-017]]"
  - "[[PUB-018]]"
  - "[[PUB-019]]"
depends_on: []
blocks: []
status: active
assignee: "@dev"
created: 2026-08-04
updated: 2026-08-04
---

# 6️⃣ PUB - Web Principal (Público)

**Objetivo**: Landing, listado/detalle canales, checkout, registro, pasarelas pago, webhooks, Telegram bot, mis accesos, SEO, legales, error pages, performance, facturación AR.

**Owner**: @dev | **Tareas**: 19 | **Progreso**: 0/19 (0%)

## 📋 Tareas

- [ ] [[PUB-001]] Landing page SSR: Hero, Features, Social Proof, Pricing, CTA, Footer
- [ ] [[PUB-002]] Listado canales: filtros, búsqueda, paginación, SEO (slug, meta, OG, JSON-LD)
- [ ] [[PUB-003]] Detalle canal: preview, beneficios, precio, botón compra, trust signals
- [ ] [[PUB-004]] Checkout flow: Step 1 Email → Step 2 Pago → Step 3 Éxito + Invite Link
- [ ] [[PUB-005]] Registro usuario: email verification, password setup, profile completion
- [ ] [[PUB-006]] Pasarela pago integration: Stripe/MercadoPago/PayPal (abstracción + webhooks)
- [ ] [[PUB-007]] Webhook handler: verified → crear suscripción → generate invite link → email + telegram notify
- [ ] [[PUB-008]] Telegram Bot API: `createChatInviteLink` (único, temporal, member_limit=1)
- [ ] [[PUB-009]] Mis accesos (usuario logueado): canales activos, expirados, renovaciones
- [ ] [[PUB-010]] Sitemap dinámico diario + `robots.txt` + RSS feed canales nuevos
- [ ] [[PUB-011]] Páginas legales: Términos, Privacidad, Cookies, Aviso Legal (CMS simple)
- [ ] [[PUB-012]] Error pages: 404, 500, 403, 503 (branded, friendly, search link)
- [ ] [[PUB-013]] Performance: critical CSS, lazy images, preconnect, font-display: swap
- [ ] [[PUB-014]] Pasarela MercadoPago Argentina: SDK, webhooks, IPN, pagos en efectivo (PagoFácil/Rapipago), cuotas sin interés
- [ ] [[PUB-015]] Pasarela transferencias bancarias: CBU/CVU, verificación manual/automática, comprobantes
- [ ] [[PUB-016]] Pasarela de prueba (sandbox): mock payments, testing E2E, webhooks simulados
- [ ] [[PUB-017]] Facturación clientes: factura A/B/C, PDF, envío email, AFIP CAE (Argentina), descarga
- [ ] [[PUB-018]] Configuración pasarelas en instalador: credenciales MP, Stripe, banco, test mode
- [ ] [[PUB-019]] Legislación impositiva Argentina: AFIP, Factura A/B/C, IVA 21%/10.5%/27%, Ganancias, IIBB, Monotributo, CAE

## 🔗 Enlaces
- [[desarrollo]] — Índice maestro
- [[todo]] — Planificación completa