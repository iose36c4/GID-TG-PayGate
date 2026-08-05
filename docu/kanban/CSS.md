---
tags:
  - kanban/area
  - type/index
  - domain/CSS
  - version/1.0
parent: "[[desarrollo]]"
children:
  - "[[CSS-001]]"
  - "[[CSS-002]]"
  - "[[CSS-003]]"
  - "[[CSS-004]]"
  - "[[CSS-005]]"
  - "[[CSS-006]]"
  - "[[CSS-007]]"
  - "[[CSS-008]]"
  - "[[CSS-009]]"
  - "[[CSS-010]]"
  - "[[CSS-011]]"
  - "[[CSS-012]]"
  - "[[CSS-013]]"
  - "[[CSS-014]]"
  - "[[CSS-015]]"
  - "[[CSS-016]]"
  - "[[CSS-017]]"
  - "[[CSS-018]]"
  - "[[CSS-019]]"
  - "[[CSS-020]]"
  - "[[CSS-021]]"
  - "[[CSS-022]]"
  - "[[CSS-023]]"
  - "[[CSS-024]]"
  - "[[CSS-025]]"
  - "[[CSS-026]]"
  - "[[CSS-027]]"
  - "[[CSS-028]]"
  - "[[CSS-029]]"
  - "[[CSS-030]]"
  - "[[CSS-031]]"
  - "[[CSS-032]]"
  - "[[CSS-033]]"
  - "[[CSS-034]]"
  - "[[CSS-035]]"
  - "[[CSS-036]]"
  - "[[CSS-037]]"
  - "[[CSS-038]]"
depends_on: []
blocks: []
status: active
assignee: "@css"
created: 2026-08-04
updated: 2026-08-04
---

# 5️⃣ CSS - Framework CSS Propio

**Objetivo**: Sistema de diseño completo, tree-shakeable, accesible, dark-mode ready, RTL, documentado, testeado, publicable.

**Owner**: @css | **Tareas**: 38 | **Progreso**: 0/38 (0%)

## 📋 Tareas

### Arquitectura y Tokens (1-4)
- [ ] [[CSS-001]] Arquitectura del Framework: Decisiones técnicas, estructura, build tool (Vite)
- [ ] [[CSS-002]] Design Tokens: Colores (escalas 50-950), spacing, tipografía, shadows, radii, z-index, breakpoints
- [ ] [[CSS-003]] Sistema de Tipografía: Font families, escalas fluidas (clamp), pesos, line-height, responsive
- [ ] [[CSS-004]] CSS Custom Properties: Estrategia naming (`--color-primary-600`), fallback, dark mode via `[data-theme]`

### Base y Primitivas (5-6)
- [ ] [[CSS-005]] Reset + Normalize: Reset moderno, box-sizing border-box, base styles, focus-visible
- [ ] [[CSS-006]] Layout Primitives: Container, Grid (12-col), Flex utilities, Gap, Aspect-ratio

### Componentes (7-21)
- [ ] [[CSS-007]] Componente Button: Variantes (primary, secondary, ghost, danger), tamaños, estados, loading, icon-only
- [ ] [[CSS-008]] Componente Form: Input, Textarea, Select, Checkbox, Radio, Switch, File, Label, Error, Hint
- [ ] [[CSS-009]] Componente Card: Base, Header/Body/Footer, Image, Action, variantes (elevated, outlined, filled)
- [ ] [[CSS-010]] Componente Modal/Dialog: Portal, backdrop, focus trap, ESC close, animaciones, responsive
- [ ] [[CSS-011]] Componente Table: Sortable, striped, hover, responsive (scroll horizontal / card en móvil)
- [ ] [[CSS-012]] Componente Dropdown/Select: Popper positioning, keyboard nav, grupos, búsqueda, multi-select
- [ ] [[CSS-013]] Componente Tabs/Accordion: ARIA, keyboard, animaciones, lazy panels
- [ ] [[CSS-014]] Componente Toast/Notification: Stack, auto-dismiss, action buttons, tipos (success, error, warning, info)
- [ ] [[CSS-015]] Componente Tooltip/Popover: Posicionamiento (Floating UI), delay, interactive, arrow
- [ ] [[CSS-016]] Componente Avatar: Imagen, fallback (iniciales), tamaños, grupo, badge de estado
- [ ] [[CSS-017]] Componente Badge/Tag: Variantes, tamaños, dot, dismissible, contador
- [ ] [[CSS-018]] Componente Pagination: Simple, con ellipsis, page size selector, ARIA
- [ ] [[CSS-019]] Componente Breadcrumb: Separadores, truncado, current page aria
- [ ] [[CSS-020]] Componente Sidebar/Navigation: Collapsible, nested, active state, mobile drawer
- [ ] [[CSS-021]] Componente Data Display: Stat card, Progress bar, Skeleton loader, Empty state, Divider

### Utilidades (22-30)
- [ ] [[CSS-022]] Utilidades de Espaciado: Margin, padding, gap (responsive: `p-4 md:p-6 lg:p-8`)
- [ ] [[CSS-023]] Utilidades de Display/Visibility: Block, flex, grid, hidden, invisible, sr-only
- [ ] [[CSS-024]] Utilidades de Flexbox/Grid: Direction, wrap, justify, align, gap, order, basis
- [ ] [[CSS-025]] Utilidades de Tipografía: Font family, size, weight, color, alignment, truncate, decoration
- [ ] [[CSS-026]] Utilidades de Color: Text, bg, border, placeholder, accent, gradient
- [ ] [[CSS-027]] Utilidades de Border/Radius/Shadow: Width, color, radius, shadow, ring
- [ ] [[CSS-028]] Utilidades de Sizing/Spacing: Width, height, min/max, space-x/y, inset
- [ ] [[CSS-029]] Utilidades de Interacción: Cursor, pointer-events, select, resize, touch-action
- [ ] [[CSS-030]] Utilidades de Transición/Animación: Duration, easing, delay, keyframes, reduce-motion

### Features Avanzadas (31-38)
- [ ] [[CSS-031]] Dark Mode Strategy: `prefers-color-scheme`, `[data-theme="dark"]`, toggle JS, persist localStorage
- [ ] [[CSS-032]] RTL Support: Logical properties, direction, mirroring automático
- [ ] [[CSS-033]] Accesibilidad: Focus visible, skip links, reduced motion, high contrast, ARIA patterns
- [ ] [[CSS-034]] Build System: Vite config, postcss (autoprefixer, cssnano), purgecss, sourcemaps, hash filenames
- [ ] [[CSS-035]] Tree Shaking / Modular Import: `@import 'framework/components/button'`, unused CSS elimination
- [ ] [[CSS-036]] Documentación Viva: Styleguide con ejemplos interactivos
- [ ] [[CSS-037]] Testing Visual: Regression testing (Playwright), snapshot CSS, a11y audit
- [ ] [[CSS-038]] Publicación: Package.json, README, changelog, versionado semver, npm publish (opcional)

## 🔗 Enlaces
- [[desarrollo]] — Índice maestro
- [[todo]] — Planificación completa