**Purpose**: Panduan singkat untuk agen AI supaya cepat paham arsitektur, konvensi, dan workflow project ini.

**Big Picture**:
- **Framework**: Laravel 12 (PHP ^8.2). Core backend di `app/`.
- **Frontend**: Vite + Tailwind + `alpinejs` (lihat `package.json`).
- **Livewire**: Project pakai Livewire (packages `livewire/flux`, `livewire/volt` in `composer.json`) — many UI pieces are server-driven components under `app/Livewire`.
- **Routing pattern**: Livewire components are mounted directly in routes (e.g. `routes/auth.php` uses `Route::get('login', App\\Livewire\\Auth\\Login::class)`).

**Key files & dirs (quick map)**:
- `app/Livewire/` : server-side UI components (auth flows in `app/Livewire/Auth`). Use these for behaviour changes.
- `resources/js/` and `resources/views/` : frontend entrypoints and blade views. Vite builds assets.
- `routes/*.php` : route definitions (note Livewire route-to-component pattern).
- `config/mail.php` : default mailer is `log` (so emails are logged by default).

**Important dev commands** (from `composer.json` / `package.json`):
- Dev server + watchers: `composer run-script dev` (runs `php artisan serve`, queue listener, and `npm run dev` concurrently).
- Frontend dev: `npm run dev` (Vite dev server).
- Build assets: `npm run build` (Vite production build).
- Run tests: `composer test` (runs `php artisan test`).

**Project-specific patterns & tips**:
- Livewire components use PHP 8 attributes (e.g. `#[Layout('components.layouts.auth')]`, `#[Validate(...)]`) — treat attributes as first-class metadata.
- Auth pages are Livewire-first: prefer editing `app/Livewire/Auth/*` instead of traditional controllers for auth UI/flows.
- Rate-limiting and session handling often live inside Livewire components (see `Login::login()` and `ensureIsNotRateLimited()` in `app/Livewire/Auth/Login.php`).
- Frontend interactivity uses `alpinejs` (already in `package.json`) — check `resources/js` imports and Blade templates for `x-` attributes.

**Integration points & external deps**:
- Mail: default `MAIL_MAILER` is `log` per `config/mail.php` — to send real emails set env vars and use SMTP/SES/Postmark as needed.
- Queues: composer `dev` script starts `php artisan queue:listen` — changes that touch jobs should consider queue worker behavior.
- Livewire packages: behaviour may be driven by `livewire/flux` and `livewire/volt` conventions (check vendor docs when uncertain).

**How to modify UI flow safely**:
- Change component logic in `app/Livewire/...` and update blades in `resources/views/components`.
- If adding a new page, prefer `Route::get('path', YourComponent::class)` to keep parity with existing routes.

**Debugging / tests**:
- To reproduce local errors: run `composer run-script dev` and open the app at the printed server URL. Use browser devtools for Vite assets and Laravel logs (`storage/logs/laravel.log`).
- Unit / Feature tests: `composer test`. Tests live in `tests/`.

**What NOT to change lightly**:
- Don't swap Livewire components to controller+view without checking app-wide patterns — this repo is Livewire-first.
- Be careful changing `config/mail.php` defaults; the app assumes `log` in local/dev.

If something di sini unclear atau mau gue perincikan (contoh: flow Livewire tertentu atau cara menjalankan tests di Windows), bilang aja — gue iterasi lagi.
