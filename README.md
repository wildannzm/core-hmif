# Core HMIF

Organization management system for Himpunan Mahasiswa Informatika (HMIF): membership, attendance (manual + IoT RFID), schedules, letters, finance, content plans, and event ticketing (TIX).

Stack: Laravel 12, Livewire + Volt + Flux UI, Tailwind CSS 4, Vite. Testing: Pest. Default database is MySQL.

## Table of Contents

- [Features](#features)
- [Architecture](#architecture)
- [Prerequisites](#prerequisites)
- [Installation](#installation)
- [Configuration](#configuration)
- [Running the Application](#running-the-application)
- [Multi-domain Routing](#multi-domain-routing)
- [Seeders](#seeders)
- [Authorization](#authorization)
- [IoT Attendance API](#iot-attendance-api)
- [Testing](#testing)
- [Code Quality & CI](#code-quality--ci)
- [Project Structure](#project-structure)
- [Troubleshooting](#troubleshooting)
- [Security](#security)
- [License](#license)

## Features

| Module | Description |
|---|---|
| Dashboard | Internal summary (`App\Livewire\Dashboard`) |
| Departments & Positions | CRUD for departments and positions (`Departments`) |
| Members | User directory with department/position relations, Spatie roles (`Members`) |
| Schedules | Activity schedule management (`Schedules`) |
| Attendance | Per-schedule attendance (manual) plus reports (`ScheduleAttendance`, `AttendanceReport`) |
| IoT Attendance | RFID tap via API with automatic lateness calculation (`Api\AttendanceController::storeTap`) |
| Letters | Incoming/outgoing letters (`Letter`, `IncomeLetter`/`OutcomeLetter` models) |
| Finance | Income/expense records (`Finance`) |
| Content Plans | Content scheduling (`ContentPlans`) |
| TIX Admin | Manage events, orders, event attendance, payment methods (`Tix\Admin\*`) |
| Public TIX | Event catalog, detail, checkout (`Tix\User\*`) |
| Public Pages | Home, organization structure (placeholder template), community (`Main\*`) |
| Settings | Profile, password, appearance (`Settings\*`) |

## Architecture

- Backend: Laravel 12 (`bootstrap/app.php` for middleware + routing).
- Reactive frontend: Livewire + Volt with Flux UI components.
- Styling: Tailwind CSS 4 via Vite (`vite.config.js`, `resources/css`, `resources/js`).
- Auth: session-based + Livewire (`routes/auth.php`). Registration and forgot-password are disabled by default (routes commented out); login via `login`.
- Dual authorization: Spatie Permission department roles + position middleware (`check.position`, `check.kominfo`).
- IoT API: static token via header, `api.token` middleware.

## Prerequisites

- PHP >= 8.2 (CI uses 8.4).
- Composer 2.
- Node.js >= 18.
- Flux UI license (`livewire/flux` is a private package and requires Composer credentials for `composer.fluxui.dev`).

## Installation

```bash
git clone https://github.com/wildanzm/core-hmif.git
cd core-hmif

composer install
npm install

cp .env.example .env
php artisan key:generate
php artisan migrate --seed
```

Flux credentials (if `composer install` fails on auth):

```bash
composer config http-basic.composer.fluxui.dev "$FLUX_USERNAME" "$FLUX_LICENSE_KEY"
composer install
```

## Configuration

Copy `.env.example` to `.env`. Key variables:

| Key | Default | Description |
|---|---|---|
| `APP_URL` | `http://localhost` | Local base URL |
| `DB_CONNECTION` | `mysql` | Local default; use `mysql` plus `DB_HOST/PORT/DATABASE/USERNAME/PASSWORD` for production |
| `QUEUE_CONNECTION` | `database` | Used by `queue:listen` in dev mode |
| `MAIL_MAILER` | `log` | Dev default, does not send real email |
| `IOT_API_TOKEN` | empty | Required for the RFID tap API |

MySQL example:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=core_hmif
DB_USERNAME=root
DB_PASSWORD=
```

> [!IMPORTANT]
> Set `IOT_API_TOKEN` to a strong random token. IoT devices must send the same value in the `X-API-TOKEN` header.

## Running the Application

Dev mode (server + queue + logs + Vite at once):

```bash
composer dev
```

It runs:

- `php artisan serve`
- `php artisan queue:listen --tries=1`
- `php artisan pail --timeout=0`
- `npm run dev` (Vite only)

Open: `http://localhost:8000`.

Production build:

```bash
npm run build
php artisan migrate --force
```

Other scripts:

| Command | Purpose |
|---|---|
| `npm run dev` | Vite dev server only |
| `npm run build` | Production asset build |
| `composer test` | `config:clear` + `php artisan test` |
| `./vendor/bin/pest` | Run tests directly |
| `vendor/bin/pint` | Laravel Pint code formatting |

## Multi-domain Routing

Routes use subdomains (see `routes/web.php`, `routes/api.php`, `bootstrap/app.php`):

| Domain | Content |
|---|---|
| `internal.hmif.unma.ac.id` | Internal app + auth (dashboard, members, schedules, attendance, letters, finance, content plans, event admin) |
| `tix.hmif.unma.ac.id` | Public TIX (catalog, detail `/event/{slug}`, checkout `/checkout/{slug}`) |
| `hmif.unma.ac.id` | Public website (`/`, `/struktural`, `/komunitas`, `/sitemap.xml`) |
| `internal.hmifunma.web.id` | IoT API `POST /api/attendance/tap` |

Local note: `php artisan serve` serves a single host. For multi-domain dev, map subdomains to `127.0.0.1` in `hosts` or set `APP_URL` and test per domain. `trustProxies` and `trustHosts` are already configured for `hmifunma.web.id`.

## Seeders

`php artisan migrate --seed` runs:

1. `DepartmentSeeder` — departments (`Badan Pengurus Harian`, `LITBANG`, `EKSTERNAL`, `DANUS`, `KOMINFO`) and positions (`Ketua`, `Wakil Ketua`, `Sekertaris`, `Bendahara`, `Koordinator`, `Anggota`).
2. `MemberSeeder` — dummy template data only (no real personal data).

Seeder password format: lowercase first name + `123`. Example: `John` -> `john123`.

## Authorization

Spatie roles per department: `bph`, `litbang`, `danus`, `eksternal`, `kominfo` (created via `firstOrCreate`).

Position restrictions via middleware:

| Route | Middleware |
|---|---|
| `departemen`, `anggota` | `check.position:Ketua,Wakil Ketua` |
| `absensi`, `surat` | `check.position:Ketua,Wakil Ketua,Sekertaris` |
| `keuangan`, `payment-methods` | `check.position:Ketua,Wakil Ketua,Bendahara` |
| `content-plan` | `check.kominfo` (Ketua/Wakil Ketua plus all Kominfo department members) |
| `jadwal`, `absensi/{scheduleId}`, dashboard, event admin | authenticated users |

Helpers in `App\Models\User`: `hasSecretaryAccess()`, `hasTreasurerAccess()`, `hasScheduleManagementAccess()`, `hasOrganizationalAccess()`, `hasAttendanceReportAccess()`, `hasKominfoAccess()`.

## IoT Attendance API

Endpoint: `POST /api/attendance/tap` (domain `internal.hmifunma.web.id`).

Headers:

```http
X-API-TOKEN: <IOT_API_TOKEN value>
Content-Type: application/json
```

Body:

```json
{ "rfid_uid": "AB12CD34" }
```

Flow (`AttendanceController::storeTap`): validate `rfid_uid` -> find user by `rfid_uid` -> find today's closest schedule -> reject if gap > 120 minutes -> update the `Alfa` `Attendance` record to `Hadir`/`Terlambat` with lateness duration. Responses: `404` when user/schedule/record is missing, `409` on duplicate tap, `200` on success.

Example:

```bash
curl -X POST https://internal.hmifunma.web.id/api/attendance/tap \
  -H "X-API-TOKEN: $IOT_API_TOKEN" \
  -H "Content-Type: application/json" \
  -d '{"rfid_uid":"AB12CD34"}'
```

## Testing

Tests use in-memory SQLite (`phpunit.xml`), so no dedicated database is needed:

```bash
composer test
# or
./vendor/bin/pest
```

Current coverage (`tests/Feature`, `tests/Unit`): auth (login, reset, verification, password confirmation), dashboard, settings (profile, password). Domain modules (finance, letters, attendance, TIX) have no tests yet.

CI (`.github/workflows`): `tests.yml` runs on push/PR to `main`/`develop` (PHP 8.4, Node 22, asset build + Pest). It requires `FLUX_USERNAME` and `FLUX_LICENSE_KEY` secrets.

## Code Quality & CI

- `vendor/bin/pint` — formatter (`lint.yml` workflow on `main`/`develop`).
- `tests.yml` — install dependencies, build assets, run Pest.

## Project Structure

```text
app/
  Http/Controllers/Api/AttendanceController.php  # IoT RFID tap
  Http/Middleware/ApiTokenMiddleware.php         # X-API-TOKEN check
  Http/Middleware/CheckPosition.php              # position restriction
  Http/Middleware/CheckKominfoAccess.php         # Kominfo restriction
  Livewire/                                      # Dashboard, Members, Schedules, Finance, Letter, ...
  Livewire/Tix/Admin|User/                       # event admin + public TIX
  Livewire/Main/                                 # Home, Structure, Community
  Models/                                        # User, Department, Position, Schedule, Attendance, ...
routes/
  web.php   # 3-subdomain routing + auth
  api.php   # IoT API
  auth.php  # login/logout, registration disabled
database/
  migrations/
  seeders/DatabaseSeeder.php                     # calls Department + Member seeders
  seeders/DepartmentSeeder.php
  seeders/MemberSeeder.php                       # dummy template
resources/views/livewire/                        # Livewire Blade views (structure = placeholder)
tests/                                           # Pest Feature/Unit
```

## Troubleshooting

| Symptom | Cause / Fix |
|---|---|
| `composer install` asks for Flux auth | Set `composer.fluxui.dev` credentials (see Installation) |
| Missing `vendor/autoload.php` | `composer install` has not been run in this environment |
| `419` / session errors across domains | Align `APP_URL`, `SESSION_DOMAIN`, and local hosts entries |
| Tap API `401` | `X-API-TOKEN` header does not match `IOT_API_TOKEN` |
| Tap API `404 No active schedule` | No schedule today, or gap > 120 minutes |
| Tap API `409` | User already tapped for that schedule |
| Vite 404 / stale assets | Run `npm run dev` (or `composer dev`), check `public/build` |
