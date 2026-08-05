---
tags:
  - kanban/review
  - type/container
parent: null
children: []
status: review
created: 2026-08-04
updated: 2026-08-04
---

# En Revisión

## Criterios de Aceptación por Tipo

### Feature
- [ ] Tests passing (unit + feature)
- [ ] PHPStan nivel 5 sin errores nuevos
- [ ] Code style (Pint) passing
- [ ] Documentación actualizada (ADR/espec si aplica)
- [ ] Manual QA en staging
- [ ] Code review aprobado (1 approval mínimo)

### Bugfix
- [ ] Test de regresión añadido
- [ ] Fix verificado en staging
- [ ] Changelog actualizado
- [ ] Root cause documentado

### Docs
- [ ] Frontmatter válido
- [ ] Wikienlaces funcionando
- [ ] Mermaid renderizando (si aplica)
- [ ] LaTeX válido
- [ ] Revisado por peer

### CSS Framework
- [ ] Componente/utility documentado en styleguide
- [ ] Tests visuales passing (snapshot)
- [ ] Accesibilidad verificada (axe-core)
- [ ] Responsive verificado (320px - 1536px)
- [ ] Dark mode verificado
- [ ] Tree-shaking verificado (bundle size)

## Proceso de Revisión
1. Developer crea PR → mueve tarea a `review`
2. Asignar reviewer en GitHub
3. Reviewer verifica DoD checklist
4. Si pasa → merge a `main` → mover a `done`
5. Si no → feedback → mover de vuelta a `in-progress`

## Tareas en Revisión
> Se poblarán durante el desarrollo