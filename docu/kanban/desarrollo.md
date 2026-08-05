---
tags:
  - kanban/root
  - type/index
  - version/1.0
parent: "[[version-1.0]]"
children:
  - "[[FUN]]"
  - "[[UX]]"
  - "[[UI]]"
  - "[[WEB]]"
  - "[[CSS]]"
  - "[[PUB]]"
  - "[[CLI]]"
  - "[[CRE]]"
  - "[[ADM]]"
  - "[[CRM]]"
  - "[[INS]]"
  - "[[DOC]]"
  - "[[KAN]]"
  - "[[TST-F]]"
  - "[[TST-P]]"
  - "[[TST-S]]"
depends_on: []
blocks: []
status: active
assignee: "@lead"
created: 2026-08-04
updated: 2026-08-04
---

# 🛠️ Desarrollo - TG-PayGate v1.0

**Índice maestro** de las 16 áreas atómicas de desarrollo. Cada área agrupa tareas técnicas atómicas con criterios de aceptación verificables.

> **Versión**: 1.0 "Fundación" | **Estado**: Planificación activa | **Owner**: @lead
> **Hito actual**: [[alfa]] → [[beta]] → Producción

## 📋 Tabla Resumen de Áreas (16 áreas, 213 tareas)

| # | Área | Código | Tareas | Estado | Progreso | Owner |
|---|------|--------|--------|--------|----------|-------|
| 1 | Fundación Laravel | `FUN` | 9 | 📋 Todo | 0% | @dev |
| 2 | Diseño UX | `UX` | 8 | 📋 Todo | 0% | @ux |
| 3 | Diseño UI | `UI` | 9 | 📋 Todo | 0% | @ui |
| 4 | Diseño Web | `WEB` | 6 | 📋 Todo | 0% | @ui |
| 5 | Framework CSS | `CSS` | 38 | 📋 Todo | 0% | @css |
| 6 | Web Público | `PUB` | 19 | 📋 Todo | 0% | @dev |
| 7 | Web Clientes | `CLI` | 7 | 📋 Todo | 0% | @dev |
| 8 | Web Creadores | `CRE` | 17 | 📋 Todo | 0% | @dev |
| 9 | Web Admin | `ADM` | 13 | 📋 Todo | 0% | @admin |
| 10 | Web CRM | `CRM` | 13 | 📋 Todo | 0% | @support |
| 11 | Instalador | `INS` | 12 | 📋 Todo | 0% | @devops |
| 12 | Documentación | `DOC` | 16 | 📋 Todo | 0% | @docs |
| 13 | Kanban | `KAN` | 9 | 📋 Todo | 0% | @lead |
| 14 | Tests Funcionales | `TST-F` | 14 | 📋 Todo | 0% | @qa |
| 15 | Tests Performance | `TST-P` | 11 | 📋 Todo | 0% | @qa |
| 16 | Tests Seguridad | `TST-S` | 12 | 📋 Todo | 0% | @sec |

**Total**: 213 tareas atómicas

## 📂 Detalle por Área

### 1️⃣ [[FUN]] Fundación Laravel + Arquitectura — 9 tareas
**Objetivo**: Base técnica sólida: Laravel 11, arquitectura Domain-Driven, subdominios dinámicos, auth/permisos, seeders, config multi-entorno.

#### Tareas
- [[FUN-001]] Inicializar proyecto Laravel 11 + dependencias core — `todo`
- [[FUN-002]] Configurar estructura `app/Domains/{Public,Creadores,Staff}` — `todo`
- [[FUN-003]] Configurar `RouteServiceProvider` para subdominios dinámicos — `todo`
- [[FUN-004]] Crear middleware `EnsureCorrectSubdomain` (rol ↔ subdominio) — `todo`
- [[FUN-005]] Instalar y configurar `spatie/laravel-permission` — `todo`
- [[FUN-006]] Migración `users` + campos: `role` (enum), `telegram_id`, `email_verified_at`, `settings` (JSON) — `todo`
- [[FUN-007]] Seeders: Roles (user, creador, staff, admin) + Permisos base — `todo`
- [[FUN-008]] Configurar `.env.example` portable + `config/*` multi-dominio — `todo`
- [[FUN-009]] BaseService, BaseController, ApiResponse trait, Exception Handler global — `todo`

> **Progreso**: 0/9 (0%) | **Bloqueadores**: Ninguno | **PRs**: -

---

### 2️⃣ [[UX]] Diseño UX (Research + Flows) — 8 tareas
**Objetivo**: Entender usuarios, mapear journeys, documentar flows, wireframes, accesibilidad, microcopy, testing plan.

#### Tareas
- [[UX-001]] User research: proto-personas (creador, usuario, staff, admin) — `todo`
- [[UX-002]] Journey maps: 4 journeys principales (compra, onboarding creador, ticket CRM, admin config) — `todo`
- [[UX-003]] User flows: 12+ flows documentados (Mermaid en docu/) — `todo`
- [[UX-004]] Wireframes low-fi: 20+ pantallas (Figma/Excalidraw exportado a docu/) — `todo`
- [[UX-005]] Arquitectura de información + card sorting (nav, dashboard, settings) — `todo`
- [[UX-006]] Accesibilidad: auditoría WCAG 2.1 AA plan + checklists — `todo`
- [[UX-007]] Microcopy + tone of voice guide (español neutro) — `todo`
- [[UX-008]] Usability testing plan (5 usuarios por rol) — `todo`

> **Progreso**: 0/8 (0%) | **Bloqueadores**: Ninguno | **PRs**: -

---

### 3️⃣ [[UI]] Diseño UI (Design System + Componentes) — 9 tareas
**Objetivo**: Design tokens, librería de componentes, layouts base, responsive, dark mode, iconografía, ilustraciones, motion, Storybook.

#### Tareas
- [[UI-001]] Design tokens: colores, spacing, tipografía, shadows, border-radius, z-index — `todo`
- [[UI-002]] Component library: Button, Input, Select, Modal, Table, Card, Badge, Avatar, Dropdown, Toast, Tooltip, Tabs, Accordion, Pagination, FormLayout — `todo`
- [[UI-003]] Layouts base: PublicLayout, AuthLayout, DashboardLayout (Sidebar + Topbar), CRMLayout, AdminLayout — `todo`
- [[UI-004]] Responsive breakpoints: mobile-first (320, 640, 768, 1024, 1280, 1536) — `todo`
- [[UI-005]] Dark mode: strategy (class en html), tokens duales, toggle persistido — `todo`
- [[UI-006]] Iconografía: set consistente (Heroicons/Lucide) + custom SVG — `todo`
- [[UI-007]] Ilustraciones/Empty states: 8+ estados vacíos ilustrados — `todo`
- [[UI-008]] Motion/Transitions: easing, duration, reduced-motion support — `todo`
- [[UI-009]] Storybook/Documentación componentes viva (opcional v1.1) — `todo`

> **Progreso**: 0/9 (0%) | **Bloqueadores**: Ninguno | **PRs**: -

---

### 4️⃣ [[WEB]] Diseño Web General (Branding + Assets) — 6 tareas
**Objetivo**: Brand guidelines, favicons/PWA, email templates, landing assets, ilustraciones custom, styleguide vivo.

#### Tareas
- [[WEB-001]] Brand guidelines: logo (variantes), paleta, tipografía, voz, do/don't — `todo`
- [[WEB-002]] Favicon set + PWA manifest + apple-touch-icons + OG image template — `todo`
- [[WEB-003]] Email templates: base transactional (MJML/Blade), 6+ templates — `todo`
- [[WEB-004]] Landing page assets: hero, features, testimonials, pricing, FAQ, footer — `todo`
- [[WEB-005]] Ilustraciones custom: onboarding, empty states, error pages (404, 500, 403) — `todo`
- [[WEB-006]] Style guide vivo en `/styleguide` (opcional) — `todo`

> **Progreso**: 0/6 (0%) | **Bloqueadores**: Ninguno | **PRs**: -

---

### 5️⃣ [[CSS]] Framework CSS Propio — 38 tareas
**Objetivo**: Sistema de diseño completo, tree-shakeable, accesible, dark-mode ready, RTL, documentado, testeado, publicable.

#### Tareas
- [[CSS-001]] Arquitectura del Framework: Decisiones técnicas, estructura, build tool (Vite) — `todo`
- [[CSS-002]] Design Tokens: Colores (escalas 50-950), spacing, tipografía, shadows, radii, z-index, breakpoints — `todo`
- [[CSS-003]] Sistema de Tipografía: Font families, escalas fluidas (clamp), pesos, line-height, responsive — `todo`
- [[CSS-004]] CSS Custom Properties: Estrategia naming (`--color-primary-600`), fallback, dark mode via `[data-theme]` — `todo`
- [[CSS-005]] Reset + Normalize: Reset moderno, box-sizing border-box, base styles, focus-visible — `todo`
- [[CSS-006]] Layout Primitives: Container, Grid (12-col), Flex utilities, Gap, Aspect-ratio — `todo`
- [[CSS-007]] Componente Button: Variantes (primary, secondary, ghost, danger), tamaños, estados, loading, icon-only — `todo`
- [[CSS-008]] Componente Form: Input, Textarea, Select, Checkbox, Radio, Switch, File, Label, Error, Hint — `todo`
- [[CSS-009]] Componente Card: Base, Header/Body/Footer, Image, Action, variantes (elevated, outlined, filled) — `todo`
- [[CSS-010]] Componente Modal/Dialog: Portal, backdrop, focus trap, ESC close, animaciones, responsive — `todo`
- [[CSS-011]] Componente Table: Sortable, striped, hover, responsive (scroll horizontal / card en móvil) — `todo`
- [[CSS-012]] Componente Dropdown/Select: Popper positioning, keyboard nav, grupos, búsqueda, multi-select — `todo`
- [[CSS-013]] Componente Tabs/Accordion: ARIA, keyboard, animaciones, lazy panels — `todo`
- [[CSS-014]] Componente Toast/Notification: Stack, auto-dismiss, action buttons, tipos (success, error, warning, info) — `todo`
- [[CSS-015]] Componente Tooltip/Popover: Posicionamiento (Floating UI), delay, interactive, arrow — `todo`
- [[CSS-016]] Componente Avatar: Imagen, fallback (iniciales), tamaños, grupo, badge de estado — `todo`
- [[CSS-017]] Componente Badge/Tag: Variantes, tamaños, dot, dismissible, contador — `todo`
- [[CSS-018]] Componente Pagination: Simple, con ellipsis, page size selector, ARIA — `todo`
- [[CSS-019]] Componente Breadcrumb: Separadores, truncado, current page aria — `todo`
- [[CSS-020]] Componente Sidebar/Navigation: Collapsible, nested, active state, mobile drawer — `todo`
- [[CSS-021]] Componente Data Display: Stat card, Progress bar, Skeleton loader, Empty state, Divider — `todo`
- [[CSS-022]] Utilidades de Espaciado: Margin, padding, gap (responsive: `p-4 md:p-6 lg:p-8`) — `todo`
- [[CSS-023]] Utilidades de Display/Visibility: Block, flex, grid, hidden, invisible, sr-only — `todo`
- [[CSS-024]] Utilidades de Flexbox/Grid: Direction, wrap, justify, align, gap, order, basis — `todo`
- [[CSS-025]] Utilidades de Tipografía: Font family, size, weight, color, alignment, truncate, decoration — `todo`
- [[CSS-026]] Utilidades de Color: Text, bg, border, placeholder, accent, gradient — `todo`
- [[CSS-027]] Utilidades de Border/Radius/Shadow: Width, color, radius, shadow, ring — `todo`
- [[CSS-028]] Utilidades de Sizing/Spacing: Width, height, min/max, space-x/y, inset — `todo`
- [[CSS-029]] Utilidades de Interacción: Cursor, pointer-events, select, resize, touch-action — `todo`
- [[CSS-030]] Utilidades de Transición/Animación: Duration, easing, delay, keyframes, reduce-motion — `todo`
- [[CSS-031]] Dark Mode Strategy: `prefers-color-scheme`, `[data-theme="dark"]`, toggle JS, persist localStorage — `todo`
- [[CSS-032]] RTL Support: Logical properties, direction, mirroring automático — `todo`
- [[CSS-033]] Accesibilidad: Focus visible, skip links, reduced motion, high contrast, ARIA patterns — `todo`
- [[CSS-034]] Build System: Vite config, postcss (autoprefixer, cssnano), purgecss, sourcemaps, hash filenames — `todo`
- [[CSS-035]] Tree Shaking / Modular Import: `@import 'framework/components/button'`, unused CSS elimination — `todo`
- [[CSS-036]] Documentación Viva: Styleguide con ejemplos interactivos — `todo`
- [[CSS-037]] Testing Visual: Regression testing (Playwright), snapshot CSS, a11y audit — `todo`
- [[CSS-038]] Publicación: Package.json, README, changelog, versionado semver, npm publish (opcional) — `todo`

> **Progreso**: 0/38 (0%) | **Bloqueadores**: Ninguno | **PRs**: -

---

### 6️⃣ [[PUB]] Web Principal (Público) — 19 tareas
**Objetivo**: Landing, listado/detalle canales, checkout, registro, pasarelas pago, webhooks, Telegram bot, mis accesos, SEO, legales, error pages, performance, facturación AR.

#### Tareas
- [[PUB-001]] Landing page SSR: Hero, Features, Social Proof, Pricing, CTA, Footer — `todo`
- [[PUB-002]] Listado canales: filtros, búsqueda, paginación, SEO (slug, meta, OG, JSON-LD) — `todo`
- [[PUB-003]] Detalle canal: preview, beneficios, precio, botón compra, trust signals — `todo`
- [[PUB-004]] Checkout flow: Step 1 Email → Step 2 Pago → Step 3 Éxito + Invite Link — `todo`
- [[PUB-005]] Registro usuario: email verification, password setup, profile completion — `todo`
- [[PUB-006]] Pasarela pago integration: Stripe/MercadoPago/PayPal (abstracción + webhooks) — `todo`
- [[PUB-007]] Webhook handler: verified → crear suscripción → generate invite link → email + telegram notify — `todo`
- [[PUB-008]] Telegram Bot API: `createChatInviteLink` (único, temporal, member_limit=1) — `todo`
- [[PUB-009]] Mis accesos (usuario logueado): canales activos, expirados, renovaciones — `todo`
- [[PUB-010]] Sitemap dinámico diario + `robots.txt` + RSS feed canales nuevos — `todo`
- [[PUB-011]] Páginas legales: Términos, Privacidad, Cookies, Aviso Legal (CMS simple) — `todo`
- [[PUB-012]] Error pages: 404, 500, 403, 503 (branded, friendly, search link) — `todo`
- [[PUB-013]] Performance: critical CSS, lazy images, preconnect, font-display: swap — `todo`
- [[PUB-014]] Pasarela MercadoPago Argentina: SDK, webhooks, IPN, pagos en efectivo (PagoFácil/Rapipago), cuotas sin interés — `todo`
- [[PUB-015]] Pasarela transferencias bancarias: CBU/CVU, verificación manual/automática, comprobantes — `todo`
- [[PUB-016]] Pasarela de prueba (sandbox): mock payments, testing E2E, webhooks simulados — `todo`
- [[PUB-017]] Facturación clientes: factura A/B/C, PDF, envío email, AFIP CAE (Argentina), descarga — `todo`
- [[PUB-018]] Configuración pasarelas en instalador: credenciales MP, Stripe, banco, test mode — `todo`
- [[PUB-019]] Legislación impositiva Argentina: AFIP, Factura A/B/C, IVA 21%/10.5%/27%, Ganancias, IIBB, Monotributo, CAE — `todo`

> **Progreso**: 0/19 (0%) | **Bloqueadores**: Ninguno | **PRs**: -

---

### 7️⃣ [[CLI]] Web Clientes (Área Usuario) — 7 tareas
**Objetivo**: Dashboard, mis canales, perfil, facturación, soporte, notificaciones, referidos (v1.1).

#### Tareas
- [[CLI-001]] Dashboard usuario: resumen accesos, próximas renovaciones, gasto total — `todo`
- [[CLI-002]] Mis canales: activos (con invite link), historial, cancelados — `todo`
- [[CLI-003]] Perfil: datos personales, email, password, 2FA (opcional), notificaciones — `todo`
- [[CLI-004]] Facturación: historial pagos, descargar facturas PDF, método pago guardado (tokenizado) — `todo`
- [[CLI-005]] Soporte: crear ticket, ver mis tickets, FAQ integrada — `todo`
- [[CLI-006]] Notificaciones: centro notificaciones (in-app + email + telegram opt-in) — `todo`
- [[CLI-007]] Referidos/affiliate (opcional v1.1): link, stats, pagos — `todo`

> **Progreso**: 0/7 (0%) | **Bloqueadores**: Ninguno | **PRs**: -

---

### 8️⃣ [[CRE]] Web Creadores (Panel Creadores) — 17 tareas
**Objetivo**: Onboarding, dashboard métricas, CRUD canales, gestión suscripciones, analytics, retiros, webhooks, API tokens, config, equipo, pasarelas, fiscal, ciclos cobro, facturación.

#### Tareas
- [[CRE-001]] Onboarding creador: wizard 4 pasos (datos, canal, bot, precios) — `todo`
- [[CRE-002]] Dashboard: MRR, suscriptores activos, churn, LTV, gráficos (Chart.js/ApexCharts) — `todo`
- [[CRE-003]] Canales CRUD: vincular bot (token encrypted), canal/grupo ID, precios, moneda, trial — `todo`
- [[CRE-004]] Gestión suscripciones: lista, buscar, filtrar, ver detalle, cancelar manual, renovar — `todo`
- [[CRE-005]] Analytics canal: cohort retention, revenue per user, funnel conversión — `todo`
- [[CRE-006]] Retiros: configurar cuenta (tokenizado Stripe Connect/MercadoPago), solicitar, historial — `todo`
- [[CRE-007]] Webhooks entrantes: logs, reintentar, debugging, firma verificación — `todo`
- [[CRE-008]] API Tokens: crear, rotar, scopes (read:channels, write:webhooks), expiración — `todo`
- [[CRE-009]] Configuración: marca blanca (logo, colores, dominio personalizado v1.1), notificaciones — `todo`
- [[CRE-010]] Equipo: invitar colaboradores (roles: owner, admin, analytics, support) — `todo`
- [[CRE-011]] Configuración pasarelas de pago: MercadoPago (credenciales, webhook URL), Stripe Connect, transferencias bancarias — `todo`
- [[CRE-012]] Ciclos de cobro: configurar frecuencia (5 días, 15 días, mensual), mínimo retiro, comisiones — `todo`
- [[CRE-013]] Facturación creadores: factura A/B/C, PDF, envío email, AFIP CAE, descarga, historial — `todo`
- [[CRE-014]] Configuración MercadoPago Argentina: SDK, credenciales, pagos efectivo (PagoFácil/Rapipago), cuotas sin interés — `todo`
- [[CRE-015]] Configuración fiscal creador: tipo contribuyente (Monotributo/RI/Exento), IVA, Ganancias, IIBB, domicilio fiscal — `todo`
- [[CRE-016]] Ciclos de cobro creador: frecuencia (5 días, 15 días, mensual), mínimo retiro, retenciones automáticas — `todo`
- [[CRE-017]] Facturación creador: factura A/B/C según categoría, PDF, AFIP CAE, envío email, descarga — `todo`

> **Progreso**: 0/17 (0%) | **Bloqueadores**: Ninguno | **PRs**: -

---

### 9️⃣ [[ADM]] Web Administración — 13 tareas
**Objetivo**: Dashboard global, config global, gestión staff/creadores/canales, transacciones, logs seguridad, feature flags, backup, fiscal global, compliance AFIP, reportes, retenciones.

#### Tareas
- [[ADM-001]] Dashboard global: MRR, ARR, churn, CAC, LTV, NPS, funnel adquisición — `todo`
- [[ADM-002]] Configuración global: fees %, límites, maintenance mode, feature flags — `todo`
- [[ADM-003]] Gestión staff: CRUD usuarios staff, roles, permisos, auditoría acciones — `todo`
- [[ADM-004]] Gestión creadores: ver, suspender, métricas, soporte, KYC básico — `todo`
- [[ADM-005]] Gestión canales: auditar, suspender, forzar renovación, métricas agregadas — `todo`
- [[ADM-006]] Transacciones: lista, filtros, reembolsos, disputas, conciliación — `todo`
- [[ADM-007]] Logs seguridad: login attempts, permission changes, critical actions (SIEM lite) — `todo`
- [[ADM-008]] Feature flags: rollout gradual, kill switches, A/B testing infra — `todo`
- [[ADM-009]] Backup/Restore: trigger manual, ver status, download (solo superadmin) — `todo`
- [[ADM-010]] Configuración fiscal global: IVA 21%/10.5%/27%, Ganancias, IIBB por provincia, retenciones — `todo`
- [[ADM-011]] Compliance AFIP: CAE, factura electrónica, RG 4367/4368/4369, ARCA web services — `todo`
- [[ADM-012]] Reportes fiscales: libro IVA ventas/compras, ganancias, IIBB, retenciones — `todo`
- [[ADM-013]] Configuración retenciones: Ganancias, IVA, IIBB por jurisdicción, alícuotas — `todo`

> **Progreso**: 0/13 (0%) | **Bloqueadores**: Ninguno | **PRs**: -

---

### 🔟 [[CRM]] Web CRM (Soporte) — 13 tareas
**Objetivo**: Ticketing, colas, respuestas, cliente 360, canales en CRM, knowledge base, reportes, automatizaciones, Telegram, satisfacción, fiscal clientes, facturación CRM, conciliación.

#### Tareas
- [[CRM-001]] Ticketing: crear, asignar, estados (open, pending, waiting, closed), SLA timers — `todo`
- [[CRM-002]] Colas: sin asignar, mis tickets, equipo, escalados, vencidos — `todo`
- [[CRM-003]] Respuestas: macros/canned replies, adjuntos, internal notes, time tracking — `todo`
- [[CRM-004]] Cliente 360: perfil, accesos, pagos, tickets previos, notas, tags, health score — `todo`
- [[CRM-005]] Canales en CRM: vincular ticket a canal, acciones rápidas (suspender, extender) — `todo`
- [[CRM-006]] Base de conocimiento: artículos, categorías, búsqueda, feedback (útil/no útil) — `todo`
- [[CRM-007]] Reportes: volumen, tiempo respuesta, resolución, CSAT, backlog aging — `todo`
- [[CRM-008]] Automatizaciones: reglas (auto-assign, SLA breach, tags, macros) — `todo`
- [[CRM-009]] Integración Telegram: notificaciones ticket en grupo staff, comandos bot — `todo`
- [[CRM-010]] Satisfacción: CSAT survey post-cierre, NPS trimestral — `todo`
- [[CRM-011]] Gestión fiscal clientes: tipo contribuyente, Factura A/B/C, IVA, retenciones aplicadas — `todo`
- [[CRM-012]] Facturación desde CRM: generar factura A/B/C, CAE, envío email, descarga PDF — `todo`
- [[CRM-013]] Conciliación fiscal: matching pagos vs facturas, reporte IVA, ganancias, IIBB — `todo`

> **Progreso**: 0/13 (0%) | **Bloqueadores**: Ninguno | **PRs**: -

---

### 1️⃣1️⃣ [[INS]] Instalador Portable — 12 tareas
**Objetivo**: Middleware redirect, helper detección, rutas instalador, 5+ pasos (requisitos, DB, migraciones, admin, finalizar), seguridad, multi-idioma, config pasarelas, config fiscal AR.

#### Tareas
- [[INS-001]] Middleware `RedirectIfNotInstalled` (global, excluye `/install/*`, assets) — `todo`
- [[INS-002]] Helper `Installation::isInstalled()` (file + env + migrations + DB connectivity) — `todo`
- [[INS-003]] Rutas `routes/install.php` (throttle, CSRF, sin auth, rate limit) — `todo`
- [[INS-004]] Paso 1: Requisitos (PHP 8.2+, extensiones, permisos, functions) — `todo`
- [[INS-005]] Paso 2: Base de Datos (form + AJAX test connection + driver check) — `todo`
- [[INS-006]] Paso 3: Migraciones + Seeders (artisan migrate --force + roles/perms) — `todo`
- [[INS-007]] Paso 4: Admin Inicial (nombre, email, pass confirm, role=admin, 2FA opcional) — `todo`
- [[INS-008]] Paso 5: Finalizar (escribir .env, APP_KEY, storage/installed, optimize:clear) — `todo`
- [[INS-009]] Seguridad: anti-reinstall, honeypot, CSP, HSTS en instalador — `todo`
- [[INS-010]] Multi-idioma: es/en (fallback), RTL ready — `todo`
- [[INS-011]] Paso 2.5: Configuración pasarelas de pago (MercadoPago, Stripe, transferencias, test mode) — `todo`
- [[INS-012]] Paso 2.6: Configuración fiscal Argentina (IVA, Ganancias, IIBB, AFIP CAE, factura A/B/C) — `todo`

> **Progreso**: 0/12 (0%) | **Bloqueadores**: Ninguno | **PRs**: -

---

### 1️⃣2️⃣ [[DOC]] Documentación — 16 tareas
**Objetivo**: Estructura docu/, ADRs (5), Specs (3), Guías deployment (3), Guías usuario (3), Runbook, Changelog.

#### Tareas
- [[DOC-001]] Estructura `docu/{kanban,arquitectura,decisiones,especificaciones,guias,runbooks}` — `todo`
- [[DOC-002]] ADR-001: Arquitectura Domain-Driven + Subdominios — `todo`
- [[DOC-003]] ADR-002: Tabla users única + spatie/permission — `todo`
- [[DOC-004]] ADR-003: Instalador portable tipo WordPress — `todo`
- [[DOC-005]] ADR-004: Deploy FTP compartido + symlinks — `todo`
- [[DOC-006]] ADR-005: Queue driver database (portable) vs Redis — `todo`
- [[DOC-007]] Spec: API Telegram (webhooks, invite links, ban, rate limits) — `todo`
- [[DOC-008]] Spec: Pasarelas Pago (webhooks, tokenización, payouts, refunds) — `todo`
- [[DOC-009]] Spec: Email templates + notification channels — `todo`
- [[DOC-010]] Guía: Deployment InfinityFree (subdominios, SSL, cron, queue worker) — `todo`
- [[DOC-011]] Guía: Deployment genérico (VPS, Docker, Laravel Forge, Ploi) — `todo`
- [[DOC-012]] Guía usuario: Creadores (onboarding, canales, retiros) — `todo`
- [[DOC-013]] Guía usuario: Staff CRM (tickets, SLA, macros, KB) — `todo`
- [[DOC-014]] Guía usuario: Admin (config, staff, métricas, feature flags) — `todo`
- [[DOC-015]] Runbook: Incident response, rollback, scaling, backup/restore — `todo`
- [[DOC-016]] Changelog + Versioning (SemVer + Conventional Commits) — `todo`

> **Progreso**: 0/16 (0%) | **Bloqueadores**: Ninguno | **PRs**: -

---

### 1️⃣3️⃣ [[KAN]] Mantenimiento Kanban — 9 tareas
**Objetivo**: Setup inicial, poblar todo.md, daily standup, weekly refinement, sprint planning, retrospectiva, métricas, archive, automation.

#### Tareas
- [[KAN-001]] Setup inicial: crear 5 columnas + templates + convención frontmatter — `todo`
- [[KAN-002]] Poblar todo.md con jerarquía completa (esta planificación) — `todo`
- [[KAN-003]] Daily standup sync: mover tareas, actualizar status, blockers — `todo`
- [[KAN-004]] Weekly refinement: groom backlog, estimar, dividir tareas >8pts — `todo`
- [[KAN-005]] Sprint planning (si aplica): seleccionar, commit, capacity — `todo`
- [[KAN-006]] Retrospectiva: métricas (lead time, cycle time, throughput, WIP) — `todo`
- [[KAN-007]] Métricas kanban: CFD, aging WIP, blocked time, rework rate — `todo`
- [[KAN-008]] Archive done: mover a done.md semanal, limpiar in-progress/review — `todo`
- [[KAN-009]] Automation: Git hooks (commit msg → mover tarea), GitHub Actions (PR → review) — `todo`

> **Progreso**: 0/9 (0%) | **Bloqueadores**: Ninguno | **PRs**: -

---

### 1️⃣4️⃣ [[TST-F]] Pruebas Funcionalidad — 14 tareas
**Objetivo**: Pest config, unit tests (100% services), feature tests (auth, roles, 4 dominios), installer E2E, contract tests, browser tests, mutation testing, CI pipeline.

#### Tareas
- [[TST-F-001]] Config Pest + Pest Plugin Laravel + Parallel testing — `todo`
- [[TST-F-002]] Unit tests: Services (100% coverage target), Policies, Helpers, Casts — `todo`
- [[TST-F-003]] Feature tests: Auth (login, register, verification, reset, 2FA) — `todo`
- [[TST-F-004]] Feature tests: Roles + Middleware subdominio (matrix 4 roles × 4 dominios) — `todo`
- [[TST-F-005]] Feature tests: Public (landing, listado, detalle, checkout, webhook) — `todo`
- [[TST-F-006]] Feature tests: Clientes (dashboard, accesos, perfil, facturas, tickets) — `todo`
- [[TST-F-007]] Feature tests: Creadores (onboarding, CRUD canales, stats, retiros, API) — `todo`
- [[TST-F-008]] Feature tests: Admin (config, staff, transacciones, logs, flags) — `todo`
- [[TST-F-009]] Feature tests: CRM (tickets, cliente360, KB, reportes, automatizaciones) — `todo`
- [[TST-F-010]] Feature tests: Instalador (E2E 5 pasos, edge cases, rollback) — `todo`
- [[TST-F-011]] Contract tests: Webhooks Telegram + Pasarelas (Pact/Mockery) — `todo`
- [[TST-F-012]] Browser tests: Critical paths (Laravel Dusk) - 5 journeys — `todo`
- [[TST-F-013]] Mutation testing: Infection (target >80% MSI) — `todo`
- [[TST-F-014]] CI Pipeline: GitHub Actions (lint, phpstan, test, coverage) — `todo`

> **Progreso**: 0/14 (0%) | **Bloqueadores**: Ninguno | **PRs**: -

---

### 1️⃣5️⃣ [[TST-P]] Pruebas Rendimiento — 11 tareas
**Objetivo**: Baseline Octane, load test (100 VU <500ms p95), stress, soak, spike, DB optimization, queue, cache, frontend Lighthouse, profiling, benchmarks.

#### Tareas
- [[TST-P-001]] Baseline: Laravel Octane (Swoole/RoadRunner) eval + config — `todo`
- [[TST-P-002]] Load test: k6/Gatling - 100 VU checkout + webhook (target <500ms p95) — `todo`
- [[TST-P-003]] Stress test: Ramp to breaking point (identificar bottlenecks) — `todo`
- [[TST-P-004]] Soak test: 2h sustained load (memory leaks, queue backlog) — `todo`
- [[TST-P-005]] Spike test: Sudden 10x traffic (cache warming, queue scaling) — `todo`
- [[TST-P-006]] Database: Query optimization (EXPLAIN, indexes, n+1 detection) — `todo`
- [[TST-P-007]] Queue: Job throughput, retry logic, dead letter handling — `todo`
- [[TST-P-008]] Cache: Hit ratios, Redis/Database driver comparison — `todo`
- [[TST-P-009]] Frontend: Lighthouse CI (Performance >90, Accessibility >95) — `todo`
- [[TST-P-010]] Profiling: Blackfire/Xdebug en staging (hot paths) — `todo`
- [[TST-P-011]] Benchmarks: Documentar baseline v1.0 para regresión futura — `todo`

> **Progreso**: 0/11 (0%) | **Bloqueadores**: Ninguno | **PRs**: -

---

### 1️⃣6️⃣ [[TST-S]] Pruebas Seguridad — 12 tareas
**Objetivo**: SAST (PHPStan 5 + Psalm), dependency scan, secrets audit, DAST (ZAP), pentest checklist OWASP Top 10, auth security, API security, file upload, encryption, headers, logging, compliance GDPR/PCI.

#### Tareas
- [[TST-S-001]] SAST: PHPStan nivel 5 + Psalm (security rulesets) — `todo`
- [[TST-S-002]] Dependency scan: Composer audit + GitHub Dependabot + OWASP Dependency Check — `todo`
- [[TST-S-003]] Secrets audit: TruffleHog/GitLeaks en CI + pre-commit hook — `todo`
- [[TST-S-004]] DAST: OWASP ZAP scan staging (authenticated + unauthenticated) — `todo`
- [[TST-S-005]] Pentest checklist: OWASP Top 10 + Laravel specific (mass assignment, SQLi, XSS, CSRF) — `todo`
- [[TST-S-006]] Auth security: Rate limiting, brute force, session fixation, 2FA bypass — `todo`
- [[TST-S-007]] API security: Token scopes, rate limits, CORS, signed URLs — `todo`
- [[TST-S-008]] File upload: Validación MIME, size, storage isolation, antivirus scan — `todo`
- [[TST-S-009]] Encryption: Verificar AES-256 tokens Telegram, rotación claves, KMS ready — `todo`
- [[TST-S-010]] Headers: CSP, HSTS, X-Frame-Options, Referrer-Policy, Permissions-Policy — `todo`
- [[TST-S-011]] Logging: No PII/secrets en logs, structured JSON, retention, alerting — `todo`
- [[TST-S-012]] Compliance: GDPR (right to delete, export, consent), PCI-DSS (no card storage) — `todo`

> **Progreso**: 0/12 (0%) | **Bloqueadores**: Ninguno | **PRs**: -

---

## 📊 Métricas Globales

| Métrica | Valor | Target |
|---------|-------|--------|
| Tareas totales | 213 | - |
| Completadas | 0 | 213 |
| En progreso | 0 | ≤4 (WIP limit) |
| En revisión | 0 | - |
| Bloqueadas | 0 | 0 |
| **Progreso global** | **0%** | **100%** |

### Por Columna Kanban
- `todo`: 213
- `in-progress`: 0
- `review`: 0
- `done`: 0

### Por Prioridad (estimada)
- P0 (Crítico): ~45
- P1 (Alto): ~85
- P2 (Medio): ~60
- P3 (Bajo): ~23

---

## 🔗 Navegación Rápida

### Kanban
- [[todo]] — Planificación completa (esta jerarquía)
- [[in-progress]] — Trabajo activo (WIP ≤ 2)
- [[review]] — En revisión / PRs abiertos
- [[done]] — Completado + métricas
- [[backlog]] — v1.1 / v2.0

### Hitos
- [[version-1.0]] → [[alfa]] → [[beta]] → Producción

### Documentación clave
- [[ADR-001]] Arquitectura DDD + Subdominios
- [[ADR-003]] Instalador portable
- [[ADR-004]] Deploy FTP + symlinks
- Spec: [[Telegram API]] | [[Pasarelas Pago]] | [[Email Templates]]

### Utilidades
- `docu/kanban/templates/` — Templates tarea/bug/epic/milestone
- `docu/kanban/tasks/` — 213 archivos tarea individuales