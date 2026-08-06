---
tags:
  - "kanban/todo"
  - "type/epic"
  - "version/1.0"
  - "milestone/beta"
parent: "null"
children:
  - "[[CSS-019]]"
  - "[[DOC-017]]"
  - "[[DOC-018]]"
  - "[[DOC-019]]"
  - "[[DOC-020]]"
  - "[[DOC-021]]"
  - "[[PUB-003]]"
  - "[[PUB-004]]"
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
  - "[[UI-001]]"
  - "[[UI-002]]"
  - "[[UI-004]]"
  - "[[UI-005]]"
  - "[[UI-006]]"
  - "[[UI-007]]"
  - "[[UI-008]]"
  - "[[UI-009]]"
  - "[[UX-001]]"
  - "[[UX-002]]"
  - "[[UX-003]]"
  - "[[UX-004]]"
  - "[[UX-005]]"
  - "[[UX-006]]"
  - "[[UX-007]]"
  - "[[UX-008]]"
  - "[[WEB-001]]"
  - "[[WEB-002]]"
  - "[[WEB-003]]"
  - "[[WEB-004]]"
  - "[[WEB-005]]"
  - "[[WEB-006]]"
status: "todo"
created: "2026-08-04"
updated: "2026-08-06"
---

# TODO - TG-PayGate v1.0 "Fundación"

## 🎯 [[version-1.0]] Versión 1.0 - Fundación Completa
**Objetivo**: Sitio funcional en producción con 4 subdominios, instalador, auth, roles, framework CSS, docs y deploy automatizado.

### 📦 [[beta]] Beta - Release Candidate
**Criterio**: Todas las features core funcionando, testing E2E pasando, docs completas, deploy verificado.

#### 🔬 [[alfa]] Alfa - Feature Complete
**Criterio**: Todo el código escrito, migraciones, seeders, instalador, 4 dominios navegables, framework CSS funcional.

##### 🛠️ [[desarrollo]] Desarrollo - 17 Áreas Atómicas

###### 1️⃣ FUN - Fundación Laravel + Arquitectura
- [[FUN-001]] Inicializar proyecto Laravel 11 + dependencias core
- [[FUN-002]] Configurar estructura `app/Domains/{Public,Creadores,Staff}`
- [[FUN-003]] Configurar `RouteServiceProvider` para subdominios dinámicos
- [[FUN-004]] Crear middleware `EnsureCorrectSubdomain` (rol ↔ subdominio)
- [[FUN-005]] Instalar y configurar `spatie/laravel-permission`
- [[FUN-006]] Migración `users` + campos: `role` (enum), `telegram_id`, `email_verified_at`, `settings` (JSON)
- [[FUN-007]] Seeders: Roles (user, creador, staff, admin) + Permisos base
- [[FUN-008]] Configurar `.env.example` portable + `config/*` multi-dominio
- [[FUN-009]] BaseService, BaseController, ApiResponse trait, Exception Handler global

###### 2️⃣ UX - Diseño UX (Research + Flows)
- [[UX-001]] User research: proto-personas (creador, usuario, staff, admin)
- [[UX-002]] Journey maps: 4 journeys principales (compra, onboarding creador, ticket CRM, admin config)
- [[UX-003]] User flows: 12+ flows documentados (Mermaid en docu/)
- [[UX-004]] Wireframes low-fi: 20+ pantallas (Figma/Excalidraw exportado a docu/)
- [[UX-005]] Arquitectura de información + card sorting (nav, dashboard, settings)
- [[UX-006]] Accesibilidad: auditoría WCAG 2.1 AA plan + checklists
- [[UX-007]] Microcopy + tone of voice guide (español neutro)
- [[UX-008]] Usability testing plan (5 usuarios por rol)

###### 3️⃣ UI - Diseño UI (Design System + Componentes)
- [[UI-001]] Design tokens: colores, spacing, tipografía, shadows, border-radius, z-index
- [[UI-002]] Component library: Button, Input, Select, Modal, Table, Card, Badge, Avatar, Dropdown, Toast, Tooltip, Tabs, Accordion, Pagination, FormLayout
- [[UI-003]] Layouts base: PublicLayout, AuthLayout, DashboardLayout (Sidebar + Topbar), CRMLayout, AdminLayout
- [[UI-004]] Responsive breakpoints: mobile-first (320, 640, 768, 1024, 1280, 1536)
- [[UI-005]] Dark mode: strategy (class en html), tokens duales, toggle persistido
- [[UI-006]] Iconografía: set consistente (Heroicons/Lucide) + custom SVG
- [[UI-007]] Ilustraciones/Empty states: 8+ estados vacíos ilustrados
- [[UI-008]] Motion/Transitions: easing, duration, reduced-motion support
- [[UI-009]] Storybook/Documentación componentes viva (opcional v1.1)

###### 4️⃣ WEB - Diseño Web General (Branding + Assets)
- [[WEB-001]] Brand guidelines: logo (variantes), paleta, tipografía, voz, do/don't
- [[WEB-002]] Favicon set + PWA manifest + apple-touch-icons + OG image template
- [[WEB-003]] Email templates: base transactional (MJML/Blade), 6+ templates
- [[WEB-004]] Landing page assets: hero, features, testimonials, pricing, FAQ, footer
- [[WEB-005]] Ilustraciones custom: onboarding, empty states, error pages (404, 500, 403)
- [[WEB-006]] Style guide vivo en `/styleguide` (opcional)

###### 5️⃣ CSS - Framework CSS Propio (38 Tareas)
- [[CSS-001]] Arquitectura del Framework: Decisiones técnicas, estructura, build tool (Vite)
- [[CSS-002]] Design Tokens: Colores (escalas 50-950), spacing, tipografía, shadows, radii, z-index, breakpoints
- [[CSS-003]] Sistema de Tipografía: Font families, escalas fluidas (clamp), pesos, line-height, responsive
- [[CSS-004]] CSS Custom Properties: Estrategia naming (`--color-primary-600`), fallback, dark mode via `[data-theme]`
- [[CSS-005]] Reset + Normalize: Reset moderno, box-sizing border-box, base styles, focus-visible
- [[CSS-006]] Layout Primitives: Container, Grid (12-col), Flex utilities, Gap, Aspect-ratio
- [[CSS-007]] Componente Button: Variantes (primary, secondary, ghost, danger), tamaños, estados, loading, icon-only
- [[CSS-008]] Componente Form: Input, Textarea, Select, Checkbox, Radio, Switch, File, Label, Error, Hint
- [[CSS-009]] Componente Card: Base, Header/Body/Footer, Image, Action, variantes (elevated, outlined, filled)
- [[CSS-010]] Componente Modal/Dialog: Portal, backdrop, focus trap, ESC close, animaciones, responsive
- [[CSS-011]] Componente Table: Sortable, striped, hover, responsive (scroll horizontal / card en móvil)
- [[CSS-012]] Componente Dropdown/Select: Popper positioning, keyboard nav, grupos, búsqueda, multi-select
- [[CSS-013]] Componente Tabs/Accordion: ARIA, keyboard, animaciones, lazy panels
- [[CSS-014]] Componente Toast/Notification: Stack, auto-dismiss, action buttons, tipos (success, error, warning, info)
- [[CSS-015]] Componente Tooltip/Popover: Posicionamiento (Floating UI), delay, interactive, arrow
- [[CSS-016]] Componente Avatar: Imagen, fallback (iniciales), tamaños, grupo, badge de estado
- [[CSS-017]] Componente Badge/Tag: Variantes, tamaños, dot, dismissible, contador
- [[CSS-018]] Componente Pagination: Simple, con ellipsis, page size selector, ARIA
- [[CSS-019]] Componente Breadcrumb: Separadores, truncado, current page aria
- [[CSS-020]] Componente Sidebar/Navigation: Collapsible, nested, active state, mobile drawer
- [[CSS-021]] Componente Data Display: Stat card, Progress bar, Skeleton loader, Empty state, Divider
- [[CSS-022]] Utilidades de Espaciado: Margin, padding, gap (responsive: `p-4 md:p-6 lg:p-8`)
- [[CSS-023]] Utilidades de Display/Visibility: Block, flex, grid, hidden, invisible, sr-only
- [[CSS-024]] Utilidades de Flexbox/Grid: Direction, wrap, justify, align, gap, order, basis
- [[CSS-025]] Utilidades de Tipografía: Font family, size, weight, color, alignment, truncate, decoration
- [[CSS-026]] Utilidades de Color: Text, bg, border, placeholder, accent, gradient
- [[CSS-027]] Utilidades de Border/Radius/Shadow: Width, color, radius, shadow, ring
- [[CSS-028]] Utilidades de Sizing/Spacing: Width, height, min/max, space-x/y, inset
- [[CSS-029]] Utilidades de Interacción: Cursor, pointer-events, select, resize, touch-action
- [[CSS-030]] Utilidades de Transición/Animación: Duration, easing, delay, keyframes, reduce-motion
- [[CSS-031]] Dark Mode Strategy: `prefers-color-scheme`, `[data-theme="dark"]`, toggle JS, persist localStorage
- [[CSS-032]] RTL Support: Logical properties, direction, mirroring automático
- [[CSS-033]] Accesibilidad: Focus visible, skip links, reduced motion, high contrast, ARIA patterns
- [[CSS-034]] Build System: Vite config, postcss (autoprefixer, cssnano), purgecss, sourcemaps, hash filenames
- [[CSS-035]] Tree Shaking / Modular Import: `@import 'framework/components/button'`, unused CSS elimination
- [[CSS-036]] Documentación Viva: Styleguide con ejemplos interactivos
- [[CSS-037]] Testing Visual: Regression testing (Playwright), snapshot CSS, a11y audit
- [[CSS-038]] Publicación: Package.json, README, changelog, versionado semver, npm publish (opcional)

###### 6️⃣ PUB - Web Principal (Público)
- [[PUB-001]] Landing page SSR: Hero, Features, Social Proof, Pricing, CTA, Footer
- [[PUB-002]] Listado canales: filtros, búsqueda, paginación, SEO (slug, meta, OG, JSON-LD)
- [[PUB-003]] Detalle canal: preview, beneficios, precio, botón compra, trust signals
- [[PUB-004]] Checkout flow: Step 1 Email → Step 2 Pago → Step 3 Éxito + Invite Link
- [[PUB-005]] Registro usuario: email verification, password setup, profile completion
- [[PUB-006]] Pasarela pago integration: Stripe/MercadoPago/PayPal (abstracción + webhooks)
- [[PUB-007]] Webhook handler: verified → crear suscripción → generate invite link → email + telegram notify
- [[PUB-008]] Telegram Bot API: `createChatInviteLink` (único, temporal, member_limit=1)
- [[PUB-009]] Mis accesos (usuario logueado): canales activos, expirados, renovaciones
- [[PUB-010]] Sitemap dinámico diario + `robots.txt` + RSS feed canales nuevos
- [[PUB-011]] Páginas legales: Términos, Privacidad, Cookies, Aviso Legal (CMS simple)
- [[PUB-012]] Error pages: 404, 500, 403, 503 (branded, friendly, search link)
- [[PUB-013]] Performance: critical CSS, lazy images, preconnect, font-display: swap
- [[PUB-014]] Pasarela MercadoPago Argentina: SDK, webhooks, IPN, pagos en efectivo (PagoFácil/Rapipago), cuotas sin interés
- [[PUB-015]] Pasarela transferencias bancarias: CBU/CVU, verificación manual/automática, comprobantes
- [[PUB-016]] Pasarela de prueba (sandbox): mock payments, testing E2E, webhooks simulados
- [[PUB-017]] Facturación clientes: factura A/B/C, PDF, envío email, AFIP CAE (Argentina), descarga
- [[PUB-018]] Configuración pasarelas en instalador: credenciales MP, Stripe, banco, test mode
- [[PUB-019]] Legislación impositiva Argentina: AFIP, Factura A/B/C, IVA 21%/10.5%/27%, Ganancias, IIBB, Monotributo, CAE

###### 7️⃣ CLI - Web Clientes (Área Usuario)
- [[CLI-001]] Dashboard usuario: resumen accesos, próximas renovaciones, gasto total
- [[CLI-002]] Mis canales: activos (con invite link), historial, cancelados
- [[CLI-003]] Perfil: datos personales, email, password, 2FA (opcional), notificaciones
- [[CLI-004]] Facturación: historial pagos, descargar facturas PDF, método pago guardado (tokenizado)
- [[CLI-005]] Soporte: crear ticket, ver mis tickets, FAQ integrada
- [[CLI-006]] Notificaciones: centro notificaciones (in-app + email + telegram opt-in)
- [[CLI-007]] Referidos/affiliate (opcional v1.1): link, stats, pagos

###### 8️⃣ CRE - Web Creadores (Panel Creadores)
- [[CRE-001]] Onboarding creador: wizard 4 pasos (datos, canal, bot, precios)
- [[CRE-002]] Dashboard: MRR, suscriptores activos, churn, LTV, gráficos (Chart.js/ApexCharts)
- [[CRE-003]] Canales CRUD: vincular bot (token encrypted), canal/grupo ID, precios, moneda, trial
- [[CRE-004]] Gestión suscripciones: lista, buscar, filtrar, ver detalle, cancelar manual, renovar
- [[CRE-005]] Analytics canal: cohort retention, revenue per user, funnel conversión
- [[CRE-006]] Retiros: configurar cuenta (tokenizado Stripe Connect/MercadoPago), solicitar, historial
- [[CRE-007]] Webhooks entrantes: logs, reintentar, debugging, firma verificación
- [[CRE-008]] API Tokens: crear, rotar, scopes (read:channels, write:webhooks), expiración
- [[CRE-009]] Configuración: marca blanca (logo, colores, dominio personalizado v1.1), notificaciones
- [[CRE-010]] Equipo: invitar colaboradores (roles: owner, admin, analytics, support)
- [[CRE-011]] Configuración pasarelas de pago: MercadoPago (credenciales, webhook URL), Stripe Connect, transferencias bancarias
- [[CRE-012]] Ciclos de cobro: configurar frecuencia (5 días, 15 días, mensual), mínimo retiro, comisiones
- [[CRE-013]] Facturación creadores: factura A/B/C, PDF, envío email, AFIP CAE, descarga, historial
- [[CRE-014]] Configuración MercadoPago Argentina: SDK, credenciales, pagos efectivo (PagoFácil/Rapipago), cuotas sin interés
- [[CRE-015]] Configuración fiscal creador: tipo contribuyente (Monotributo/RI/Exento), IVA, Ganancias, IIBB, domicilio fiscal
- [[CRE-016]] Ciclos de cobro creador: frecuencia (5 días, 15 días, mensual), mínimo retiro, retenciones automáticas
- [[CRE-017]] Facturación creador: factura A/B/C según categoría, PDF, AFIP CAE, envío email, descarga

###### 9️⃣ ADM - Web Administración
- [[ADM-001]] Dashboard global: MRR, ARR, churn, CAC, LTV, NPS, funnel adquisición
- [[ADM-002]] Configuración global: fees %, límites, maintenance mode, feature flags
- [[ADM-003]] Gestión staff: CRUD usuarios staff, roles, permisos, auditoría acciones
- [[ADM-004]] Gestión creadores: ver, suspender, métricas, soporte, KYC básico
- [[ADM-005]] Gestión canales: auditar, suspender, forzar renovación, métricas agregadas
- [[ADM-006]] Transacciones: lista, filtros, reembolsos, disputas, conciliación
- [[ADM-007]] Logs seguridad: login attempts, permission changes, critical actions (SIEM lite)
- [[ADM-008]] Feature flags: rollout gradual, kill switches, A/B testing infra
- [[ADM-009]] Backup/Restore: trigger manual, ver status, download (solo superadmin)
- [[ADM-010]] Configuración fiscal global: IVA 21%/10.5%/27%, Ganancias, IIBB por provincia, retenciones
- [[ADM-011]] Compliance AFIP: CAE, factura electrónica, RG 4367/4368/4369, ARCA web services
- [[ADM-012]] Reportes fiscales: libro IVA ventas/compras, ganancias, IIBB, retenciones
- [[ADM-013]] Configuración retenciones: Ganancias, IVA, IIBB por jurisdicción, alícuotas

###### 🔟 CRM - Web CRM (Soporte)
- [[CRM-001]] Ticketing: crear, asignar, estados (open, pending, waiting, closed), SLA timers
- [[CRM-002]] Colas: sin asignar, mis tickets, equipo, escalados, vencidos
- [[CRM-003]] Respuestas: macros/canned replies, adjuntos, internal notes, time tracking
- [[CRM-004]] Cliente 360: perfil, accesos, pagos, tickets previos, notas, tags, health score
- [[CRM-005]] Canales en CRM: vincular ticket a canal, acciones rápidas (suspender, extender)
- [[CRM-006]] Base de conocimiento: artículos, categorías, búsqueda, feedback (útil/no útil)
- [[CRM-007]] Reportes: volumen, tiempo respuesta, resolución, CSAT, backlog aging
- [[CRM-008]] Automatizaciones: reglas (auto-assign, SLA breach, tags, macros)
- [[CRM-009]] Integración Telegram: notificaciones ticket en grupo staff, comandos bot
- [[CRM-010]] Satisfacción: CSAT survey post-cierre, NPS trimestral
- [[CRM-011]] Gestión fiscal clientes: tipo contribuyente, Factura A/B/C, IVA, retenciones aplicadas
- [[CRM-012]] Facturación desde CRM: generar factura A/B/C, CAE, envío email, descarga PDF
- [[CRM-013]] Conciliación fiscal: matching pagos vs facturas, reporte IVA, ganancias, IIBB

###### 1️⃣1️⃣ INS - Instalador Portable
- [[INS-001]] Middleware `RedirectIfNotInstalled` (global, excluye `/install/*`, assets)
- [[INS-002]] Helper `Installation::isInstalled()` (file + env + migrations + DB connectivity)
- [[INS-003]] Rutas `routes/install.php` (throttle, CSRF, sin auth, rate limit)
- [[INS-004]] Paso 1: Requisitos (PHP 8.2+, extensiones, permisos, functions)
- [[INS-005]] Paso 2: Base de Datos (form + AJAX test connection + driver check)
- [[INS-006]] Paso 3: Migraciones + Seeders (artisan migrate --force + roles/perms)
- [[INS-007]] Paso 4: Admin Inicial (nombre, email, pass confirm, role=admin, 2FA opcional)
- [[INS-008]] Paso 5: Finalizar (escribir .env, APP_KEY, storage/installed, optimize:clear)
- [[INS-009]] Seguridad: anti-reinstall, honeypot, CSP, HSTS en instalador
- [[INS-010]] Multi-idioma: es/en (fallback), RTL ready
- [[INS-011]] Paso 2.5: Configuración pasarelas de pago (MercadoPago, Stripe, transferencias, test mode)
- [[INS-012]] Paso 2.6: Configuración fiscal Argentina (IVA, Ganancias, IIBB, AFIP CAE, factura A/B/C)

###### 1️⃣2️⃣ DOC - Documentación
- [[DOC-001]] Estructura `docu/{kanban,arquitectura,decisiones,especificaciones,guias,runbooks}`
- [[DOC-002]] ADR-001: Arquitectura Domain-Driven + Subdominios
- [[DOC-003]] ADR-002: Tabla users única + spatie/permission
- [[DOC-004]] ADR-003: Instalador portable tipo WordPress
- [[DOC-005]] ADR-004: Deploy FTP compartido + symlinks
- [[DOC-006]] ADR-005: Queue driver database (portable) vs Redis
- [[DOC-007]] Spec: API Telegram (webhooks, invite links, ban, rate limits)
- [[DOC-008]] Spec: Pasarelas Pago (webhooks, tokenización, payouts, refunds)
- [[DOC-009]] Spec: Email templates + notification channels
- [[DOC-010]] Guía: Deployment InfinityFree (subdominios, SSL, cron, queue worker)
- [[DOC-011]] Guía: Deployment genérico (VPS, Docker, Laravel Forge, Ploi)
- [[DOC-012]] Guía usuario: Creadores (onboarding, canales, retiros)
- [[DOC-013]] Guía usuario: Staff CRM (tickets, SLA, macros, KB)
- [[DOC-014]] Guía usuario: Admin (config, staff, métricas, feature flags)
- [[DOC-015]] Runbook: Incident response, rollback, scaling, backup/restore
- [[DOC-016]] Changelog + Versioning (SemVer + Conventional Commits)
- [[DOC-017]] ADR-006: Núcleo Transaccional — Money (integer cents) + Ledger doble entrada
- [[DOC-018]] ADR-007: Máquinas de estado de Pagos, Reembolsos y Retiros
- [[DOC-019]] ADR-008: Idempotencia + Eventos de Dominio
- [[DOC-020]] ADR-009: Autorización — RBAC + Policies + ABAC/Tenancy
- [[DOC-021]] ADR-010: Seguridad de Webhooks y Telegram (firma, replay, DLQ)

###### 1️⃣3️⃣ KAN - Mantenimiento Kanban
- [[KAN-001]] Setup inicial: crear 5 columnas + templates + convención frontmatter
- [[KAN-002]] Poblar todo.md con jerarquía completa (esta planificación)
- [[KAN-003]] Daily standup sync: mover tareas, actualizar status, blockers
- [[KAN-004]] Weekly refinement: groom backlog, estimar, dividir tareas >8pts
- [[KAN-005]] Sprint planning (si aplica): seleccionar, commit, capacity
- [[KAN-006]] Retrospectiva: métricas (lead time, cycle time, throughput, WIP)
- [[KAN-007]] Métricas kanban: CFD, aging WIP, blocked time, rework rate
- [[KAN-008]] Archive done: mover a done.md semanal, limpiar in-progress/review
- [[KAN-009]] Automation: Git hooks (commit msg → mover tarea), GitHub Actions (PR → review)

###### 1️⃣4️⃣ TST-F - Pruebas Funcionalidad
- [[TST-F-001]] Config Pest + Pest Plugin Laravel + Parallel testing
- [[TST-F-002]] Unit tests: Services (100% coverage target), Policies, Helpers, Casts
- [[TST-F-003]] Feature tests: Auth (login, register, verification, reset, 2FA)
- [[TST-F-004]] Feature tests: Roles + Middleware subdominio (matrix 4 roles × 4 dominios)
- [[TST-F-005]] Feature tests: Public (landing, listado, detalle, checkout, webhook)
- [[TST-F-006]] Feature tests: Clientes (dashboard, accesos, perfil, facturas, tickets)
- [[TST-F-007]] Feature tests: Creadores (onboarding, CRUD canales, stats, retiros, API)
- [[TST-F-008]] Feature tests: Admin (config, staff, transacciones, logs, flags)
- [[TST-F-009]] Feature tests: CRM (tickets, cliente360, KB, reportes, automatizaciones)
- [[TST-F-010]] Feature tests: Instalador (E2E 5 pasos, edge cases, rollback)
- [[TST-F-011]] Contract tests: Webhooks Telegram + Pasarelas (Pact/Mockery)
- [[TST-F-012]] Browser tests: Critical paths (Laravel Dusk) - 5 journeys
- [[TST-F-013]] Mutation testing: Infection (target >80% MSI)
- [[TST-F-014]] CI Pipeline: GitHub Actions (lint, phpstan, test, coverage)

###### 1️⃣5️⃣ TST-P - Pruebas Rendimiento
- [[TST-P-001]] Baseline: Laravel Octane (Swoole/RoadRunner) eval + config
- [[TST-P-002]] Load test: k6/Gatling - 100 VU checkout + webhook (target <500ms p95)
- [[TST-P-003]] Stress test: Ramp to breaking point (identificar bottlenecks)
- [[TST-P-004]] Soak test: 2h sustained load (memory leaks, queue backlog)
- [[TST-P-005]] Spike test: Sudden 10x traffic (cache warming, queue scaling)
- [[TST-P-006]] Database: Query optimization (EXPLAIN, indexes, n+1 detection)
- [[TST-P-007]] Queue: Job throughput, retry logic, dead letter handling
- [[TST-P-008]] Cache: Hit ratios, Redis/Database driver comparison
- [[TST-P-009]] Frontend: Lighthouse CI (Performance >90, Accessibility >95)
- [[TST-P-010]] Profiling: Blackfire/Xdebug en staging (hot paths)
- [[TST-P-011]] Benchmarks: Documentar baseline v1.0 para regresión futura

###### 1️⃣6️⃣ TST-S - Pruebas Seguridad
- [[TST-S-001]] SAST: PHPStan nivel 5 + Psalm (security rulesets)
- [[TST-S-002]] Dependency scan: Composer audit + GitHub Dependabot + OWASP Dependency Check
- [[TST-S-003]] Secrets audit: TruffleHog/GitLeaks en CI + pre-commit hook
- [[TST-S-004]] DAST: OWASP ZAP scan staging (authenticated + unauthenticated)
- [[TST-S-005]] Pentest checklist: OWASP Top 10 + Laravel specific (mass assignment, SQLi, XSS, CSRF)
- [[TST-S-006]] Auth security: Rate limiting, brute force, session fixation, 2FA bypass
- [[TST-S-007]] API security: Token scopes, rate limits, CORS, signed URLs
- [[TST-S-008]] File upload: Validación MIME, size, storage isolation, antivirus scan
- [[TST-S-009]] Encryption: Verificar AES-256 tokens Telegram, rotación claves, KMS ready
- [[TST-S-010]] Headers: CSP, HSTS, X-Frame-Options, Referrer-Policy, Permissions-Policy
- [[TST-S-011]] Logging: No PII/secrets en logs, structured JSON, retention, alerting
- [[TST-S-012]] Compliance: GDPR (right to delete, export, consent), PCI-DSS (no card storage)

###### 1️⃣7️⃣ SEC - Seguridad y Arquitectura del Dominio (50 Tareas - Fase 0)
- [[SEC-001]] Threat Modeling STRIDE global (P0)
- [[SEC-002]] Trust Boundaries + Data Flow Diagrams (P0)
- [[SEC-003]] Security Risk Register + mitigaciones (P0)
- [[SEC-004]] Security Baseline transversal (P0)
- [[SEC-005]] Money Value Object (integer cents, nunca float) (P0)
- [[SEC-006]] Currency + multi-moneda ISO 4217 (P0)
- [[SEC-007]] Entidades dominio financiero: Invoice, Balance, Withdrawal, Refund, Settlement, Fee, Transfer (P0)
- [[SEC-008]] Ledger de doble entrada inmutable (P0)
- [[SEC-009]] Ledger entries + reconstrucción de balances (P0)
- [[SEC-010]] Invariantes de balance + auditoría de consistencia (P0)
- [[SEC-011]] Máquina de estados del Payment (P0)
- [[SEC-012]] Máquina de estados del Refund (P1)
- [[SEC-013]] Máquina de estados del Withdrawal (P0)
- [[SEC-014]] Máquina de estados del Invoice (P0)
- [[SEC-015]] Disputas/Chargeback + congelamiento de fondos (P1)
- [[SEC-016]] Idempotencia con Idempotency-Key (P0)
- [[SEC-017]] Eventos de dominio financieros (P1)
- [[SEC-018]] Event store ligero + reprocesamiento (P1)
- [[SEC-019]] Reconciliación sistema ↔ proveedor ↔ banco ↔ ledger (P1)
- [[SEC-020]] Concurrencia: SELECT FOR UPDATE + optimistic locking (P0)
- [[SEC-021]] Distributed locks + deadlock retry + updates atómicos (P1)
- [[SEC-022]] Arquitectura de autorización (separada de auth) (P0)
- [[SEC-023]] Laravel Policies por entidad financiera (P0)
- [[SEC-024]] RBAC escalable: roles + permisos + contextos (P1)
- [[SEC-025]] ABAC + tenant scoping creador→recursos propios (P1)
- [[SEC-026]] Scopes API + service tokens (P1)
- [[SEC-027]] Matriz de acceso + tests de autorización (P1)
- [[SEC-028]] Webhook verification: firma, timestamp, nonce, replay (P0)
- [[SEC-029]] Webhook retry + backoff + dead letter queue (P0)
- [[SEC-030]] Webhook delivery log + rotación de claves de firma (P1)
- [[SEC-031]] Seguridad Telegram: firma, replay, origen (P0)
- [[SEC-032]] Telegram flood control + rate limit + expiración (P1)
- [[SEC-033]] Rate limiting por área (P0)
- [[SEC-034]] Scheduler: expirar invoices, retry webhooks, orphans (P0)
- [[SEC-035]] Job retry pipeline + dead letter queue (P1)
- [[SEC-036]] Audit log completo (actor, IP, payload hash, correlation id) (P0)
- [[SEC-037]] Correlation IDs X-Correlation-ID (P0)
- [[SEC-038]] Observabilidad: OpenTelemetry, metrics, alerting (P1)
- [[SEC-039]] Structured logging sin PII/secretos (P0)
- [[SEC-040]] Secret Management: rotación + key versioning (P0)
- [[SEC-041]] Sesiones: fixation, rotation, refresh, revocación (P1)
- [[SEC-042]] Backups, DR, PITR y restore tests (P1)
- [[SEC-043]] Tests de concurrencia y race conditions (P1)
- [[SEC-044]] Fault injection + chaos testing en pagos (P2)
- [[SEC-045]] Replay testing + fuzzing de inputs (P1)
- [[SEC-046]] Property-based testing del dominio financiero (P2)
- [[SEC-047]] Pentest ofensivo I: SSRF, XXE, IDOR, Mass Assignment, Host Header (P0)
- [[SEC-048]] Pentest ofensivo II: Smuggling, Cache Poisoning, Zip Bomb, Timing (P1)
- [[SEC-049]] Pentest ofensivo III: JWT/OAuth, CSRF/CSP bypass, Unicode, Prototype Pollution (P1)
- [[SEC-050]] Cadencia de revisión de seguridad (Security Review) (P1)

---

### 🔗 Enlaces Relacionados
- [[backlog]] - Épicas futuras (v1.1, v2.0)
- [[in-progress]] - Tareas en curso
- [[review]] - En revisión
- [[done]] - Completadas[[FUN-004]][[FUN-004]]