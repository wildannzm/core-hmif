# Core HMIF

**Core HMIF** is a comprehensive Organization Management System designed for _Himpunan Mahasiswa Informatika_ (HMIF). It serves as a central ERP-like solution to streamline administrative, financial, and operational workflows within the organization.

## 🚀 Overview

This application is built to modernize the internal operations of the student organization. From managing memberships and tracking attendance (with IoT integration) to handling event ticketing and financial records, Core HMIF provides a unified platform for organizational governance.

## ✨ Key Features

### 👥 Human Resources (HR) Management

- **Member Directory**: Manage detailed profiles for all members, including Departments and Positions.
- **Attendance Tracking**:
    - Integrated with IoT devices for seamless `tap-in` attendance recording.
    - Manual attendance logging and management.
    - Dedicated API endpoints for internal hardware verification.
- **Schedule Management**: Create and assign schedules for organizational shifts or duties.

### 📅 Event Management

- **Event Lifecycle**: Create and manage events with detailed descriptions.
- **Ticketing System**: Internal ticketing engine with `EventOrder` and `EventAttendee` tracking.
- **Payment Processing**: Support for multiple `PaymentMethod` types for event registrations.

### 💰 Finance & Administration

- **Financial Recording**: Track `Finance` records for income and expenses.
- **Correspondence**: Digital management of `IncomeLetter` (Surat Masuk) and `OutcomeLetter` (Surat Keluar).
- **Transparency**: Centralized ledger for organizational budget tracking.

### 📢 Content & Social Media

- **Content Planning**: A dedicated module for scheduling and planning social media posts or internal content releases via `ContentPlan`.

## 🛠 Technology Stack

This project leverages the latest Laravel ecosystem for a robust and reactive user experience.

- **Backend Framework**: [Laravel 12](https://laravel.com)
- **Frontend Architecture**: [Livewire](https://livewire.laravel.com) + [Flux UI](https://fluxui.dev)
- **Styling**: [Tailwind CSS 4](https://tailwindcss.com)
- **Bundler**: [Vite](https://vitejs.dev)
- **Database**: MySQL
- **Testing**: Pest PHP

## ⚙️ Prerequisites

Ensure you have the following installed on your machine:

- **PHP**: >= 8.2
- **Node.js**: >= 18.x
- **Composer**: Latest version

## 📥 Installation & Setup

1.  **Clone the repository**

    ```bash
    git clone https://github.com/wildanzm/core-hmif.git
    cd core-hmif
    ```

2.  **Install PHP dependencies**

    ```bash
    composer install
    ```

3.  **Install Node.js dependencies**

    ```bash
    npm install
    ```

4.  **Environment Configuration**
    Copy the example environment file and configure it:

    ```bash
    cp .env.example .env
    php artisan key:generate
    ```

    > [!IMPORTANT]
    > If you are setting up the IoT Attendance hardware, ensure you set a secure `IOT_API_TOKEN` in your `.env` file. This token is required for the hardware to authenticate with the attendance API.

5.  **Database Setup**
    Create the database and run migrations:
    ```bash
    php artisan migrate --seed
    ```

## 🚀 Running the Application

This project uses a concurrent runner to handle the development server, queue workers, and build processes simultaneously.

Start the development server:

```bash
npm run dev
```

This command will simultaneously start:

- **Laravel Server** (`php artisan serve`)
- **Queue Worker** (`php artisan queue:listen`)
- **Log Viewer** (`php artisan pail`)
- **Vite Development Server**

Access the application at `http://localhost:8000`.

## 🧪 Testing

Run the test suite using Pest to ensure everything is working correctly:

```bash
php artisan test
```

## 🔒 Security

If you discover any security related issues, please email instead of using the issue tracker.

## 📄 License

This software is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
