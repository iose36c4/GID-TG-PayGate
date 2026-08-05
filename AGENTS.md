# AGENTS.md — TG-PayGate

## Project Overview
Laravel 13+ SaaS for selling access to private Telegram channels/groups. Stack: PHP 8.3+ (8.4 local), MySQL 8, Redis, Tailwind CSS 4 + Vite, Alpine.js. Active development: a working Laravel app plus Kanban planning in `docu/kanban/`.

See also: [README.md](README.md) (project overview, in Spanish).

## Layout Gotcha (CRITICAL)
- The **entire Laravel app lives inside `public/`** (composer.json, artisan, app/, routes/, tests/), NOT at the repo root.
- **Always run composer/artisan/npm from `public/`** (e.g. `composer test`, `php artisan migrate`). The repo root has no PHP code; `public/.env` is local and gitignored.
- The web server document root is `public/public/` (Laravel's own `public/`).

## App Commands (run inside `public/`)
```bash
composer setup             # fresh install: deps, .env, key, migrate, npm build
composer dev               # concurrently: artisan serve + queue:listen + pail + vite
composer lint              # pint --test (check only)
composer lint:fix          # pint (fix)
composer static            # phpstan analyse -c phpstan.neon (level 5, larastan)
composer test              # pest --parallel (uses sqlite :memory:, see phpunit.xml)
composer test:coverage     # pest --coverage
composer ci                # lint && static && test
php artisan migrate        # MySQL in .env, sqlite for tests
```

> **Known issue (verified 2026-08-05):** `composer static` / `phpstan analyse` crashes
> silently with exit 1 and zero output on PHPStan 2.2.8 (this repo's code triggers it;
> single-file and /tmp analyses run fine). Lint + test pass; do not block on `composer ci`
> until the phpstan crash is fixed. Once it runs, expect real errors (e.g. undefined
> `User::$role`) — the existing `ignoreErrors` regex `.*::$` doesn't actually match them.

## Kanban CLI (Node.js, no deps)
```bash
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
- **Tasks**: `docu/kanban/tasks/DOM-NNN.md` with YAML frontmatter (268 tasks)
- **Templates**: `docu/kanban/templates/{task,bug,epic,milestone}.md`
- **ID format**: `DOM-NNN`, DOM ∈ {FUN,UX,UI,WEB,CSS,PUB,CLI,CRE,ADM,CRM,INS,DOC,KAN,TST-F,TST-P,TST-S,SEC}
- **Required frontmatter**: tags (kanban/, type/, domain/, priority/), parent, children, depends_on, blocks, status, assignee, created, updated

## Commit Patterns (auto-sync via `git sync-commits`)
```
feat(FUN-001): descripción      # starts work → in-progress
fix(UI-003): descripción        # bugfix → in-progress
move(FUN-001→in-progress): ...  # manual move
review(FUN-001): PR #123        # PR opened → review
done(FUN-001): merged           # PR merged → done
```

## Architecture (implemented in `public/app/`)
- **DDD**: `app/Domains/{Public,Creadores,Staff}` — each has a ServiceProvider that loads its own `Routes/web.php` and registers a view namespace (e.g. `public.*`, `creadores.*`). The domain `Views/` dirs don't exist; actual Blade views live in `resources/views/`.
- **Root routes**: `routes/web.php` holds `/` + `/install/*`; domain routes are in `app/Domains/*/Routes/web.php`. Note `/` is defined in both the root and Public domain route files.
- **Auth/RBAC**: spatie/laravel-permission; roles `user, creador, staff, admin` seeded by `database/seeders/RolePermissionSeeder.php`; guard `web`. Creador routes use `role:creador` middleware.
- **Subdomain routing / `EnsureCorrectSubdomain`**: planned only — NOT implemented.

## Installer (implemented)
- WordPress-style installer at `/install/*` (requirements → database → migrate → admin → complete), throttled.
- `app/Http/Middleware/RedirectIfNotInstalled.php` is prepended globally; it redirects to the installer until `Installation::isInstalled()` passes.
- `app/Helpers/Installation.php` checks the `storage/installed` marker + `.env` values (APP_KEY, DB_DATABASE, DB_USERNAME) + migrations table. **Always returns true under `APP_ENV=testing`** so tests bypass it.

## Testing
- Pest 4 (`composer test` = `pest --parallel`), Larastan/PHPStan level 5, Pint, Dusk available.
- `phpunit.xml` forces sqlite `:memory:`, `array` cache/queue/session, `sync` queue — no external services needed to run tests.

## Security (CRITICAL)
- **NO BYPASS ALLOWED** — strict policy prohibits any bypass mechanisms (except the deliberate `Installation::isInstalled()` testing short-circuit).
- Payments + Telegram bot tokens handled here; follow security best practices.
- `ChannelPago` encrypts `telegram_bot_token` via `Crypt::encryptString` in a custom mutator (AES-256 via APP_KEY), with `bot_token_decrypted` accessor — do not store tokens in plaintext.
- No local card storage — PCI compliance via webhooks only (spatie/laravel-webhook-client).
- Secrets/keys only in `public/.env` (gitignored), never committed. Do not touch the local `.env`.

## Permissions
- `opencode.json` allows: git, gh, kanban CLI.
- Kanban agent can self-modify: `.opencode/agents/kanban.md`, `.opencode/skills/kanban/{SKILL.md,scripts/kanban.js}`.
- Must validate after kanban changes: `node .opencode/skills/kanban/scripts/kanban.js validate`.

## Current State
- Laravel 13.24 app in `public/`: DDD scaffold, installer, Creadores onboarding/CRUD controllers + Blade views, migrations for channels/categories/subscriptions/payments/invoices/payouts/permissions.
- In-progress: PUB-001 (see `docu/kanban/in-progress.md`). Full roadmap: `docu/kanban/todo.md`.
