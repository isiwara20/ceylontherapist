# Ceylon Therapist — Modern PHP MVC Web Application

A luxury therapist, sanctuary spa, and wellness appointment web application built with **pure PHP 8+ (PDO)**, **MySQL**, **Vanilla CSS3**, and **Vanilla JavaScript**, optimized for standard Apache/XAMPP environments.

---

## 1. Project Architecture

The application has been refactored from an over-engineered N-tier layout into a clean, modern, and standard **MVC (Model-View-Controller)** pattern:

```text
HTTP Request (e.g., /treatments.php, /admin/dashboard.php)
    ↓
Entry Point Script (Requires app/bootstrap.php, calls Controller action)
    ↓
Controller (app/controllers/*.php — Validates input, checks Auth/CSRF)
    ↓
Model (app/models/*.php — Direct PDO Prepared Statements, returns clean arrays)
    ↓
MySQL Database (ceylon_therapist)
    ↓
View Template (views/public/*.php or views/admin/*.php with views/layouts/*)
    ↓
HTTP Response (Rendered HTML + page-specific CSS/JS)
```

### Key Architectural Highlights
- **Direct MVC Flow**: Eliminates obsolete BLL/DAL layers; controllers interact directly with focused models.
- **Autoloading & Bootstrap**: `app/bootstrap.php` loads configuration, environment variables, helpers, and automatically loads models, controllers, and services.
- **No Complex Frameworks**: 100% pure PHP without Laravel, Symfony, Composer dependencies, or npm build pipelines.
- **Asset Separation**: CSS and JS are split into shared common components (`variables.css`, `header.css`, `navigation.js`) and page-specific files (`home.css`, `contact.js`, `admin/*.css`).
- **Structured Admin Section**: Admin routes are organized cleanly into subfolders (`admin/dashboard.php`, `admin/categories/`, `admin/services/`, `admin/packages/`, `admin/enquiries/`, `admin/media/`, `admin/content/`, `admin/settings/`, `admin/profile/`).
- **Full Backward Compatibility**: Legacy root `admin_*.php` files gracefully redirect to new admin URLs with query strings preserved.

---

## 2. Directory Structure

```text
ceylontherapist/
├── .env                      # Local environment configuration
├── .env.example              # Example environment template
├── .htaccess                 # Apache rewrite rules & file protection
├── index.php                 # Public Home page entry point
├── about.php                 # About Us entry point
├── contact.php               # Contact & Reservation entry point
├── treatments.php            # Treatments overview entry point
├── for-her.php               # For Her Sanctuary entry point
├── couples.php               # Couples Rituals entry point
├── packages.php              # Wellness Packages listing entry point
├── package.php               # Single Package detail entry point
├── login.php                 # Admin login entry point
├── logout.php                # Admin logout entry point
│
├── admin/                    # Structured Admin Panel Entry Points
│   ├── index.php             # Admin router/dashboard redirector
│   ├── dashboard.php         # Admin dashboard statistics & overview
│   ├── categories/           # Category management (index, create, edit)
│   ├── services/             # Treatment management (index, create, edit)
│   ├── packages/             # Package management (index, create, edit)
│   ├── enquiries/            # Booking enquiries & status workflow (index, view)
│   ├── media/                # Media library upload & gallery
│   ├── content/              # CMS content editors (home.php, about.php)
│   ├── settings/             # Site & contact settings (site.php, contact.php)
│   └── profile/              # Admin profile & change password
│
├── app/                      # Application Core Logic
│   ├── bootstrap.php         # Autoloader, session init, environment bootstrap
│   ├── config/               # Configuration files
│   │   ├── app.php           # App name, URL, environment constants
│   │   ├── database.php      # Database credentials & PDO singleton
│   │   └── mail.php          # Mail settings
│   ├── controllers/          # MVC Controllers
│   │   ├── AdminController.php
│   │   ├── AuthController.php
│   │   ├── HomeController.php
│   │   ├── AboutController.php
│   │   ├── ContactController.php
│   │   ├── TreatmentController.php
│   │   ├── PackageController.php
│   │   ├── CategoryController.php
│   │   ├── ServiceController.php
│   │   ├── EnquiryController.php
│   │   ├── MediaController.php
│   │   └── SettingsController.php
│   ├── models/               # PDO Models (Prepared Statements)
│   │   ├── Admin.php
│   │   ├── Category.php
│   │   ├── Service.php
│   │   ├── Package.php
│   │   ├── Enquiry.php
│   │   ├── Media.php
│   │   └── Setting.php
│   ├── services/             # Core Utilities & Services
│   │   ├── AuthService.php
│   │   ├── CsrfService.php
│   │   ├── UploadService.php
│   │   ├── EmailService.php
│   │   └── WhatsAppService.php
│   └── helpers/              # Helper functions
│       ├── env.php           # .env file reader
│       ├── url.php           # baseUrl(), assetUrl(), mediaUrl(), redirect()
│       ├── auth.php          # isLoggedIn(), requireAdmin(), currentAdmin()
│       ├── flash.php         # setFlash(), getFlash(), hasFlash()
│       ├── validation.php    # validateRequired(), validateEmail()
│       └── common.php        # e() HTML escaping, sanitizeInput(), isPost()
│
├── assets/                   # Static Assets
│   ├── css/
│   │   ├── common/           # variables.css, reset.css, typography.css, header.css, footer.css, responsive.css
│   │   ├── pages/            # home.css, about.css, contact.css, treatments.css, for-her.css, couples.css, packages.css, login.css
│   │   └── admin/            # admin-common.css, dashboard.css, services.css, packages.css, media.css, etc.
│   ├── js/
│   │   ├── common/           # navigation.js, main.js
│   │   ├── pages/            # contact.js, for-her.js, login.js
│   │   └── admin/            # admin-common.js, media.js
│   └── images/               # Organized media (branding/, home/, treatments/, for-her/, couples/)
│
├── database/                 # Database Schema & Seed Data
│   └── schema.sql            # Complete database schema and default records
│
├── storage/                  # Storage & Runtime Data
│   ├── logs/                 # Error and system logs
│   └── uploads/              # Dynamic uploaded files (services/, packages/, media/, profiles/)
│
└── views/                    # HTML Presentation Templates
    ├── layouts/              # Shared layouts
    │   ├── header.php        # Public global header & navigation
    │   ├── footer.php        # Public global footer
    │   ├── admin-header.php  # Admin top navigation & head
    │   ├── admin-sidebar.php # Admin navigation sidebar
    │   └── admin-footer.php  # Admin footer scripts
    ├── public/               # Public page views
    ├── admin/                # Admin page views
    └── auth/                 # Authentication views (login.php)
```

---

## 3. Copy-and-Paste Setup Guide

### Step 1: Place Files in XAMPP
Copy the `ceylontherapist` folder directly into your XAMPP `htdocs` directory:
```text
C:\xampp\htdocs\ceylontherapist\
```

### Step 2: Database Setup
1. Start **Apache** and **MySQL** in your XAMPP Control Panel.
2. Open **phpMyAdmin** (`http://localhost/phpmyadmin/`).
3. Create a new database named:
   ```sql
   CREATE DATABASE ceylon_therapist CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
   ```
4. Import the file `database/schema.sql` into `ceylon_therapist`.

### Step 3: Configure Environment (.env)
The project includes a preconfigured `.env` file for standard XAMPP localhost:
```ini
# Application Settings
APP_NAME="Ceylon Therapist"
APP_ENV=development
APP_URL=http://localhost/ceylontherapist

# Database Credentials
DB_HOST=localhost
DB_PORT=3306
DB_DATABASE=ceylon_therapist
DB_USERNAME=root
DB_PASSWORD=
DB_CHARSET=utf8mb4

# Business Contact Defaults
DEFAULT_WHATSAPP_NUMBER=94762244114
DEFAULT_BUSINESS_EMAIL=info@ceylontherapist.lk
```

### Step 4: Access the Website
- **Public Website**: `http://localhost/ceylontherapist/`
- **Admin Panel**: `http://localhost/ceylontherapist/admin/` or `http://localhost/ceylontherapist/login.php`
  - **Default Email**: `admin@ceylontherapist.lk`
  - **Default Password**: `admin123`

---

## 4. Security & Best Practices

1. **PDO Prepared Statements Only**: Every single database query uses parametrized prepared statements (`:named_parameters` with explicit types), completely eliminating SQL injection risks.
2. **CSRF Protection**: All POST forms include a hidden CSRF token verified via `CsrfService::validateToken()`.
3. **XSS Prevention**: All dynamic output in views is escaped with `<?= e($variable) ?>` using `htmlspecialchars(..., ENT_QUOTES, 'UTF-8')`.
4. **Apache Hardening (.htaccess)**:
   - Directory browsing disabled (`Options -Indexes`).
   - Direct HTTP access to hidden files (`.env`, `.git`), `database/`, `app/config/`, `views/`, and `storage/logs/` is forbidden (`403 Forbidden`).
5. **Secure Authentication**: Passwords stored using standard `password_hash($pwd, PASSWORD_BCRYPT)` and verified with `password_verify()`.

---

## 5. Verification & Testing

To test the application via command line:
```bash
# Verify PHP syntax across all project files:
php -l index.php
php -l app/bootstrap.php

# Test database connection and sample query:
php -r "require 'app/bootstrap.php'; echo 'Active services: ' . count((new Service())->getActive()) . PHP_EOL;"
```
All routes, public views, and admin modules render with zero syntax errors, zero missing includes, and 100% functional integrity.
