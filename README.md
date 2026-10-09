<div align="center">

# Core HMIF

**An Integrated Organization Management System for Himpunan Mahasiswa Informatika (HMIF)**

[![Laravel](https://img.shields.io/badge/Laravel-12-FF2D20?logo=laravel&logoColor=white)](https://laravel.com)
[![Livewire](https://img.shields.io/badge/Livewire-Volt-FB70A9?logo=livewire&logoColor=white)](https://livewire.laravel.com)
[![Tailwind CSS](https://img.shields.io/badge/Tailwind_CSS-4-06B6D4?logo=tailwindcss&logoColor=white)](https://tailwindcss.com)
[![PHP](https://img.shields.io/badge/PHP-%E2%89%A5%208.2-777BB4?logo=php&logoColor=white)](https://www.php.net)
[![Tests](https://img.shields.io/badge/tests-Pest-F28D1A)](https://pestphp.com)
[![Code Style](https://img.shields.io/badge/code%20style-Laravel%20Pint-FF2D20)](https://laravel.com/docs/pint)

</div>

---

## Table of Contents

- [About](#about)
- [Key Features](#key-features)
- [Tech Stack](#tech-stack)
- [Architecture](#architecture)
- [Module Reference](#module-reference)
- [Prerequisites](#prerequisites)
- [Installation](#installation)
- [Configuration](#configuration)
- [Running the Application](#running-the-application)
- [Multi-Domain Routing](#multi-domain-routing)
- [Seeders and Initial Data](#seeders-and-initial-data)
- [Authorization and Access Control](#authorization-and-access-control)
- [IoT Attendance API](#iot-attendance-api)
- [Testing](#testing)
- [Code Quality and CI](#code-quality-and-ci)
- [Project Structure](#project-structure)
- [Troubleshooting](#troubleshooting)

---

## About

**Core HMIF** is a Laravel-based web application that serves as the operational hub (ERP-like) for *Himpunan Mahasiswa Informatika* (the Informatics Student Association). It consolidates administration, finance, human resources, and event management into a single platform, making organizational governance more orderly, transparent, and well documented.

Problems it addresses:

- Member, department, and position data scattered across multiple files.
- Manual attendance records that are error-prone and hard to audit.
- Incoming/outgoing correspondence and financial records that are not centralized.
- Event ticketing and registration that are not integrated with internal administration.

## Key Features

### Human Resources Management
- **Member Directory**: detailed member profiles with department and position relations.
- **Attendance Tracking**:
  - IoT (RFID) integration for automatic `tap-in` attendance recording.
  - Automatic lateness calculation.
  - Manual attendance logging and management per schedule.
  - Attendance reports.
- **Schedule Management**: create and assign schedules for organizational activities or duties.

### Event Management (TIX)
- **Event Lifecycle**: create and manage events with detailed descriptions.
- **Internal Ticketing**: `EventOrder` and `EventAttendee` tracking.
- **Payments**: support for multiple `PaymentMethod` types for event registration.
- **Public Catalog**: event listing, detail, and checkout pages for visitors.

### Finance and Administration
- **Financial Records**: income and expense tracking (`Finance`).
- **Correspondence**: digital management of incoming (`IncomeLetter`) and outgoing (`OutcomeLetter`) letters.
- **Transparency**: a centralized ledger for tracking the organization's budget.

### Content and Social Media
- **Content Plan**: a dedicated module for planning and scheduling social media posts or internal content releases.

### Public Website
- Home page, organization structure, community page, and `sitemap.xml`.

## Tech Stack

| Category | Technology |
| --- | --- |
| Language | PHP ≥ 8.2 |
| Backend Framework | [Laravel 12](https://laravel.com) |
| Reactive Frontend | [Livewire](https://livewire.laravel.com) + Volt |
| UI Components | [Flux UI](https://fluxui.dev) |
| Styling | [Tailwind CSS 4](https://tailwindcss.com) |
| Bundler | [Vite](https://vitejs.dev) |
| Database | MySQL (in-memory SQLite for tests) |
| API Authentication | Laravel Sanctum |
| Permissions | [spatie/laravel-permission](https://spatie.be/docs/laravel-permission) |
| PDF Export | barryvdh/laravel-dompdf |
| QR Codes | simplesoftwareio/simple-qrcode |
| Testing | [Pest PHP](https://pestphp.com) |
| Code Formatting | [Laravel Pint](https://laravel.com/docs/pint) |
| CI/CD | GitHub Actions |

## Architecture

- **Backend**: Laravel 12. Middleware and routing are configured in `bootstrap/app.php`.
- **Frontend**: Livewire + Volt with Flux UI components (server-driven, no separate SPA).
- **Styling and Assets**: Tailwind CSS 4 built via Vite (`vite.config.js`, `resources/css`, `resources/js`).
- **Authentication**: session-based + Livewire (`routes/auth.php`). Registration and forgot-password are disabled by default (routes are commented out); users sign in via the `login` page.
- **Dual authorization**: per-department roles (Spatie Permission) combined with position-based restrictions (`check.position` and `check.kominfo` middleware).
- **IoT API**: static token sent via header, validated by the `api.token` middleware.
- **Multi-domain**: a single codebase serves several subdomains (see [Multi-Domain Routing](#multi-domain-routing)).

## Module Reference

| Module | Description | Component |
| --- | --- | --- |
| Dashboard | Internal summary | `App\Livewire\Dashboard` |
| Departments & Positions | CRUD for departments and positions | `Departments` |
| Members | User directory with department/position relations and Spatie roles | `Members` |
| Schedules | Activity schedule management | `Schedules` |
| Attendance | Manual per-schedule attendance and reports | `ScheduleAttendance`, `AttendanceReport` |
| IoT Attendance | RFID tap via API with automatic lateness calculation | `Api\AttendanceController::storeTap` |
| Letters | Incoming and outgoing letters | `Letter`, `IncomeLetter` / `OutcomeLetter` models |
| Finance | Income and expense records | `Finance` |
| Content Plans | Content scheduling | `ContentPlans` |
| TIX Admin | Manage events, orders, event attendance, and payment methods | `Tix\Admin\*` |
| Public TIX | Event catalog, detail, and checkout | `Tix\User\*` |
| Public Pages | Home, organization structure (placeholder template), community | `Main\*` |
| Settings | Profile, password, appearance | `Settings\*` |

## Prerequisites

Make sure your machine has:

- **PHP** ≥ 8.2 (CI uses PHP 8.4)
- **Composer** 2
- **Node.js** ≥ 18 (CI uses Node.js 22)
- **MySQL** (or a compatible database server)
- **Flux UI license**: the `livewire/flux` package requires Composer credentials for `composer.fluxui.dev`

## Installation

```bash
# 1. Clone the repository
git clone https://github.com/wildannzm/core-hmif.git
cd core-hmif

# 2. Install dependencies
composer install
npm install

# 3. Set up the environment
cp .env.example .env
php artisan key:generate

# 4. Run migrations and seeders
php artisan migrate --seed
```

> [!NOTE]
> The repository also contains a `bun.lock`, but CI uses the available `package-lock.json`. Use `npm` to stay consistent with the pipeline.

### Flux UI Credentials

If `composer install` fails at the authentication step, configure your Flux UI license credentials:

```bash
composer config http-basic.composer.fluxui.dev "$FLUX_USERNAME" "$FLUX_LICENSE_KEY"
composer install
```

## Configuration

Copy `.env.example` to `.env`, then adjust the following variables:

| Variable | Default | Description |
| --- | --- | --- |
| `APP_URL` | `http://localhost` | Application base URL |
| `DB_CONNECTION` | `mysql` | Database driver |
| `DB_HOST` / `DB_PORT` / `DB_DATABASE` / `DB_USERNAME` / `DB_PASSWORD` | – | Set to match your environment |
| `QUEUE_CONNECTION` | `database` | Used by `queue:listen` in development mode |
| `MAIL_MAILER` | `log` | Development default; does not send real email |
| `IOT_API_TOKEN` | empty | **Required** for the RFID tap API |

Example database configuration:

```dotenv
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=core_hmif
DB_USERNAME=root
DB_PASSWORD=
```

> [!IMPORTANT]
> Set `IOT_API_TOKEN` to a strong random token. IoT devices must send the same value in the `X-API-TOKEN` header.

Example of generating a random token:

```bash
php -r "echo bin2hex(random_bytes(32)), PHP_EOL;"
```

## Running the Application

### Development Mode

```bash
composer dev
```

This starts four processes at once:

| Process | Command |
| --- | --- |
| Server | `php artisan serve` |
| Queue worker | `php artisan queue:listen --tries=1` |
| Log viewer | `php artisan pail --timeout=0` |
| Vite | `npm run dev` |

The application is available at `http://localhost:8000`.

### Production Build

```bash
npm run build
php artisan migrate --force
```

### Available Scripts

| Command | Purpose |
| --- | --- |
| `composer dev` | Server, queue, logs, and Vite together |
| `npm run dev` | Vite dev server only |
| `npm run build` | Production asset build |
| `composer test` | `config:clear` followed by `php artisan test` |
| `./vendor/bin/pest` | Run tests directly |
| `vendor/bin/pint` | Format code with Laravel Pint |

## Multi-Domain Routing

The application uses subdomain-based routing (see `routes/web.php`, `routes/api.php`, and `bootstrap/app.php`):

| Domain | Content |
| --- | --- |
| `internal.hmif.unma.ac.id` | Internal app and authentication (dashboard, members, schedules, attendance, letters, finance, content plans, event admin) |
| `tix.hmif.unma.ac.id` | Public TIX (catalog, detail at `/event/{slug}`, checkout at `/checkout/{slug}`) |
| `hmif.unma.ac.id` | Public website (`/`, `/struktural`, `/komunitas`, `/sitemap.xml`) |
| `internal.hmifunma.web.id` | IoT API `POST /api/attendance/tap` |

### Local Development Notes

`php artisan serve` serves a single host. To test multi-domain behavior locally:

1. Map the subdomains to `127.0.0.1` in your system's `hosts` file.
2. Adjust `APP_URL` (and `SESSION_DOMAIN` if needed).
3. Test each domain separately.

`trustProxies` and `trustHosts` are already configured for the `hmifunma.web.id` domain.

## Seeders and Initial Data

`php artisan migrate --seed` runs:

1. **`DepartmentSeeder`**
   - Departments: `Badan Pengurus Harian`, `LITBANG`, `EKSTERNAL`, `DANUS`, `KOMINFO`.
   - Positions: `Ketua`, `Wakil Ketua`, `Sekertaris`, `Bendahara`, `Koordinator`, `Anggota`.
2. **`MemberSeeder`**: dummy template data only, with no real personal data.

Seeder password format: **lowercase first name + `123`**. Example: `John` → `john123`.

> [!WARNING]
> Seeder passwords are for development only. Do not run the dummy seeders in production without replacing the credentials.

## Authorization and Access Control

Spatie roles are created per department: `bph`, `litbang`, `danus`, `eksternal`, `kominfo` (created via `firstOrCreate`).

Position-based restrictions are enforced through middleware:

| Route | Middleware | Allowed Positions |
| --- | --- | --- |
| `departemen`, `anggota` | `check.position` | Ketua, Wakil Ketua |
| `absensi`, `surat` | `check.position` | Ketua, Wakil Ketua, Sekertaris |
| `keuangan`, `payment-methods` | `check.position` | Ketua, Wakil Ketua, Bendahara |
| `content-plan` | `check.kominfo` | Ketua, Wakil Ketua, and all Kominfo department members |
| `jadwal`, `absensi/{scheduleId}`, dashboard, event admin | authentication | All authenticated users |

Helpers in `App\Models\User`:

- `hasSecretaryAccess()`
- `hasTreasurerAccess()`
- `hasScheduleManagementAccess()`
- `hasOrganizationalAccess()`
- `hasAttendanceReportAccess()`
- `hasKominfoAccess()`

## IoT Attendance API

### Endpoint

```
POST /api/attendance/tap
```

Domain: `internal.hmifunma.web.id`

### Headers

| Header | Value |
| --- | --- |
| `X-API-TOKEN` | The `IOT_API_TOKEN` value |
| `Content-Type` | `application/json` |

### Request Body

```json
{
  "rfid_uid": "AB12CD34"
}
```

### Processing Flow

Handled by `AttendanceController::storeTap`:

1. Validate `rfid_uid`.
2. Find the user by `rfid_uid`.
3. Find today's closest schedule.
4. Reject if the time gap is greater than 120 minutes.
5. Update the `Attendance` record from `Alfa` to `Hadir` or `Terlambat`, including the lateness duration.

### Response Codes

| Code | Meaning |
| --- | --- |
| `200` | Attendance recorded successfully |
| `401` | Missing or invalid token |
| `404` | User, active schedule, or attendance record not found |
| `409` | The user has already tapped for that schedule |

### Example

```bash
curl -X POST https://internal.hmifunma.web.id/api/attendance/tap \
  -H "X-API-TOKEN: $IOT_API_TOKEN" \
  -H "Content-Type: application/json" \
  -d '{"rfid_uid":"AB12CD34"}'
```

## Testing

The application defaults to MySQL, but tests are configured to use **in-memory SQLite** (`phpunit.xml`), so no dedicated test database is needed.

```bash
composer test
# or
./vendor/bin/pest
```

**Current coverage** (`tests/Feature`, `tests/Unit`):

- Authentication (login, password reset, verification, password confirmation)
- Dashboard
- Settings (profile, password)

> [!NOTE]
> Domain modules (finance, letters, attendance, TIX) do not have tests yet. See [Contributing](#contributing) if you would like to help.

## Code Quality and CI

Workflows live in `.github/workflows`:

| Workflow | Trigger | Purpose |
| --- | --- | --- |
| `tests.yml` | push / PR to `main` or `develop` | Installs dependencies, builds assets (PHP 8.4, Node 22), runs Pest |
| `lint.yml` | `main` / `develop` | Checks code formatting with Laravel Pint |

Before committing, run:

```bash
vendor/bin/pint
composer test
```

> [!IMPORTANT]
> The `tests.yml` workflow requires the repository secrets `FLUX_USERNAME` and `FLUX_LICENSE_KEY`.

## Project Structure

```
core-hmif/
├── .github/workflows/                  # CI pipelines (tests, lint)
├── app/
│   ├── Http/
│   │   ├── Controllers/Api/
│   │   │   └── AttendanceController.php  # RFID tap endpoint
│   │   └── Middleware/
│   │       ├── ApiTokenMiddleware.php    # X-API-TOKEN validation
│   │       ├── CheckPosition.php         # Position-based restriction
│   │       └── CheckKominfoAccess.php    # Kominfo access restriction
│   ├── Livewire/                         # Dashboard, Members, Schedules, Finance, Letter, ...
│   │   ├── Tix/{Admin,User}/             # Event admin and public TIX
│   │   └── Main/                         # Home, Structure, Community
│   └── Models/                           # User, Department, Position, Schedule, Attendance, ...
├── bootstrap/                            # App configuration, middleware, routing
├── config/
├── database/
│   ├── migrations/
│   └── seeders/                          # DatabaseSeeder, DepartmentSeeder, MemberSeeder
├── public/
├── resources/
│   ├── css/ js/
│   └── views/livewire/                   # Livewire Blade views
├── routes/
│   ├── web.php                           # 3-subdomain routing + auth
│   ├── api.php                           # IoT API
│   └── auth.php                          # Login/logout (registration disabled)
├── storage/
├── tests/                                # Pest (Feature & Unit)
├── .env.example
├── composer.json
├── package.json
├── phpunit.xml
└── vite.config.js
```

## Troubleshooting

| Symptom | Cause / Fix |
| --- | --- |
| `composer install` asks for Flux authentication | Set the `composer.fluxui.dev` credentials (see [Installation](#flux-ui-credentials)) |
| `vendor/autoload.php` not found | `composer install` has not been run |
| `419` / session errors across domains | Align `APP_URL`, `SESSION_DOMAIN`, and local `hosts` entries |
| Tap API returns `401` | The `X-API-TOKEN` header does not match `IOT_API_TOKEN` |
| Tap API returns `404 No active schedule` | No schedule today, or the time gap is greater than 120 minutes |
| Tap API returns `409` | The user has already tapped for that schedule |
| Vite 404 / stale assets | Run `npm run dev` (or `composer dev`) and check `public/build` |
