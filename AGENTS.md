# AGENTS.md — TG-PayGate

## Project Overview
Laravel 11+ SaaS for selling access to private Telegram channels/groups. Stack: PHP 8.2, MySQL 8, Redis, Tailwind CSS, Alpine.js. Early development — no Laravel code yet, only Kanban planning.

See also: [README.md](README.md) for project overview and installation.

## Key Commands
```bash
# Kanban CLI (Node.js, no deps)
node .opencode/skills/kanban/scripts/kanban.js read [column]        # View board/column
node .opencode/skills/kanban/scripts/kanban.js create task FUN --title "..." --priority P1
node .opencode/skills/kanban/scripts/kanban.js move FUN-001 in-progress
node .opencode/skills/kanban/scripts/kanban.js update FUN-001 --set assignee=@dev
node .opencode/skills/kanban/scripts/kanban.js validate             # Check consistency
node .opencode/skills/kanban/scripts/kanban.js metrics cfd --days 30
node .opencode/skills/kanban/scripts/kanban.js git sync-commits --apply
node .opencode/skills/kanban/scripts/kanban.js archive --days 7 --apply
```

## Kanban Conventions
- **Board**: `docu/kanban/` (columns: backlog, todo, in-progress, review, done)
- **Tasks**: `docu/kanban/tasks/DOM-NNN.md` with YAML frontmatter
- **Templates**: `docu/kanban/templates/{task,bug,epic,milestone}.md`
- **ID format**: `DOM-NNN` where DOM ∈ {FUN,UX,UI,WEB,CSS,PUB,CLI,CRE,ADM,CRM,INS,DOC,KAN,TST-F,TST-P,TST-S}
- **Required frontmatter**: tags (kanban/, type/, domain/, priority/), parent, children, depends_on, blocks, status, assignee, created, updated

## Commit Patterns (auto-sync)
```
feat(FUN-001): descripción      # starts work → in-progress
fix(UI-003): descripción        # bugfix → in-progress
move(FUN-001→in-progress): ...  # manual move
review(FUN-001): PR #123        # PR opened → review
done(FUN-001): merged           # PR merged → done
```

## Workflow
1. Daily: `read in-progress` + `metrics wip` → report blockers
2. Start task: `move ID in-progress` + update `updated`
3. Commit with `feat(ID):` → auto-moves to review via `git sync-commits --apply`
4. PR merged → auto-moves to done via `git sync-prs --apply`
5. Weekly: `metrics cfd` + `metrics throughput` → refinement
6. Archive weekly: `archive --apply` (done > 7d)

## Architecture (Planned)
- **Domains**: `app/Domains/{Public,Creadores,Staff}` (DDD)
- **Subdomains**: dynamic via RouteServiceProvider + middleware `EnsureCorrectSubdomain`
- **Auth**: spatie/laravel-permission (roles: user, creador, staff, admin)
- **Security**: AES-256 encryption for Telegram bot tokens (Eloquent casts), no local card storage (PCI compliance via webhooks)

## Installer (Planned)
Portable WordPress-style installer at `/install/*` with 5 steps: requirements, DB, migrations+seeders, admin user, finalize.

## Testing (Planned)
- Pest + Pest Laravel + Parallel
- Target: 100% service coverage, feature tests per domain, Dusk E2E (5 journeys)
- CI: GitHub Actions (lint, phpstan, test, coverage)

## Security (CRITICAL)
- **NO BYPASS ALLOWED** — Strict security policy prohibits any bypass mechanisms
- **Security is paramount** — This site handles payments and Telegram bot tokens; all code must follow security best practices
- AES-256 encryption for Telegram bot tokens (Eloquent casts)
- No local card storage — PCI compliance via webhooks only
- All secrets/keys must be in environment variables, never committed

## Permissions
- `opencode.json` allows: git, gh, kanban CLI
- Kanban agent can self-modify: `.opencode/agents/kanban.md`, `.opencode/skills/kanban/{SKILL.md,scripts/kanban.js}`
- Must validate after changes: `node .opencode/skills/kanban/scripts/kanban.js validate`

## Current State
- No composer.json, package.json, .env.example yet (pre-initialization)
- Only Kanban planning exists — check [Kanban Index](docu/kanban/todo.md) for full roadmap