# CLAUDE.md

This file provides guidance to Claude Code (claude.ai/code) when working with code in this repository.

## Project Overview

QuoteDB is a Laravel 11 + Inertia.js + Vue 3 quotes database application with a Filament admin panel and a Sanctum-authenticated REST API.

## Common Commands

```bash
# Install dependencies
composer install && npm ci

# Dev server (Vite)
npm run dev

# Build frontend
npm run build

# Run all tests
php artisan test

# Run a single test by name
php artisan test --filter=TestMethodName

# Lint/format PHP
composer run pint

# Run migrations
php artisan migrate

# Sail (Docker)
./vendor/bin/sail up
./vendor/bin/sail artisan migrate
```

CI (`.github/workflows/build.yml`) runs PHP 8.2, MySQL 8.0, Node 18. Tests run against a MySQL service container.

## Architecture

**Three interfaces share one Laravel backend:**
- **Web frontend** — Inertia.js + Vue 3 SPA (`resources/js/Pages/`), session auth
- **Admin panel** — Filament 3 at `/admin` (`app/Filament/`), role-gated (ADMIN, SUPER_ADMIN)
- **REST API** — Sanctum token auth, versioned at `/api/v1/` (`routes/api.php`), auto-documented via Scramble at `/api/documentation`

**Models:**
- `User` — has roles via `UserRole` enum (USER, ADMIN, SUPER_ADMIN), hasMany Quote, soft deletes, HasApiTokens
- `Quote` — belongsTo User, soft deletes

**Routing:**
- `routes/web.php` — Inertia pages (home, login, quotes, random)
- `routes/api.php` — Sanctum-protected endpoints (quotes CRUD, search, random, token management)

**Frontend stack:** Vue 3 + Tailwind CSS + Ziggy (Laravel route helpers in JS). Entry point: `resources/js/app.js`.

## Key Conventions

- PHP ^8.2, Laravel ^11.9
- Code formatting: Laravel Pint (run `composer run pint`)
- API responses use `JsonResource` without wrapping
- API rate limit: 100 req/min per user
- Both User and Quote use soft deletes
- Tests in `tests/Feature/` and `tests/Unit/`, extends `Tests\TestCase`
