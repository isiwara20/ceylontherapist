# Ceylon Therapist — Core N-Tier MVC Bootstrap Architecture

## Overview
Ceylon Therapist is a premium therapist and wellness service web application designed for Sri Lanka. Built with pure PHP 8+, Apache (XAMPP), and MySQL (PDO only), following a strict **N-Tier MVC** pattern.

---

## Technical Stack
- **Server**: Apache / XAMPP Localhost
- **Backend Language**: Pure PHP 8+ (No Laravel, Symfony, or CodeIgniter)
- **Database**: MySQL Port 3306 (PDO Prepared Statements Only, No ORM, No `mysqli`)
- **Frontend**: HTML5, Vanilla CSS3, Vanilla JavaScript (No Bootstrap, Tailwind, React, Vue)
- **External CDN Libraries**:
  - Font Awesome 6.4.0 (`https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css`)
  - Google Fonts (Inter, Plus Jakarta Sans, Playfair Display for public; Montserrat, Inter for admin)
  - `ui-avatars.com` (Admin avatar generation)

---

## N-Tier Architecture & Request Flow

```text
Public / Admin Entry Request (.php)
        ↓
    Controller (Input Validation, Session & Auth Guard, View Prep)
        ↓
    BLL — Business Logic Layer (Domain Rules, Transformations)
        ↓
    DAL — Data Access Layer (PDO Prepared Statements SQL)
        ↓
    MySQL Database (ceylon_therapist)
```

### Layer Responsibilities
- `/controllers/`: Receives HTTP GET/POST inputs, performs request validation, checks authentication/CSRF, invokes BLL, loads view templates. Contains **NO SQL**.
- `/bll/`: Encapsulates business rules and calls DAL. Does **NOT render HTML directly**.
- `/dal/`: Contains **ALL SQL queries**. Uses PDO prepared statements exclusively. Returns raw array data or booleans. Does **NOT generate HTML**.
- `/services/`: Reusable technical services (`CsrfService`, `WhatsAppService`, `EmailService`, `FileUploadService`).
- `/views/`: Presentation templates organized by `public`, `admin`, `auth`, and `partials`.
- `/config/`: Central initialization, PDO connection singleton, environment constants, and autoloader.
- `/helpers/`: Reusable helpers for escaping `e()`, redirection, auth guards, flash notifications, and validation.

---

## Directory Structure

```text
ceylontherapist/
├── index.php
├── treatments.php
├── for-her.php
├── couples.php
├── about.php
├── contact.php
├── package.php
├── login.php
├── logout.php
├── admin_dashboard.php
├── admin_services.php
├── admin_service_create.php
├── admin_service_edit.php
├── admin_packages.php
├── admin_package_create.php
├── admin_package_edit.php
├── admin_for_her.php
├── admin_couples.php
├── admin_site_settings.php
├── admin_contact_settings.php
├── config/
│   ├── app.php
│   ├── db.php
│   ├── init.php
│   └── mail.php
├── controllers/
│   ├── HomeController.php
│   ├── TreatmentController.php
│   ├── PackageController.php
│   ├── ContactController.php
│   ├── AdminAuthController.php
│   ├── AdminDashboardController.php
│   ├── AdminServiceController.php
│   ├── AdminPackageController.php
│   └── AdminSettingsController.php
├── bll/
│   ├── ServiceBLL.php
│   ├── PackageBLL.php
│   ├── ContactBLL.php
│   ├── AdminAuthBLL.php
│   └── SettingsBLL.php
├── dal/
│   ├── ServiceDAL.php
│   ├── PackageDAL.php
│   ├── EnquiryDAL.php
│   ├── AdminDAL.php
│   └── SettingsDAL.php
├── services/
│   ├── EmailService.php
│   ├── WhatsAppService.php
│   ├── FileUploadService.php
│   └── CsrfService.php
├── helpers/
│   ├── auth_helper.php
│   ├── url_helper.php
│   ├── validation_helper.php
│   ├── flash_helper.php
│   └── common_helper.php
├── views/
│   ├── public/
│   │   ├── home.php
│   │   ├── treatments.php
│   │   ├── for-her.php
│   │   ├── couples.php
│   │   ├── about.php
│   │   ├── contact.php
│   │   └── package-detail.php
│   ├── auth/
│   │   └── login.php
│   ├── admin/
│   │   ├── dashboard.php
│   │   ├── services/
│   │   ├── packages/
│   │   └── settings/
│   └── partials/
│       ├── public-header.php
│       ├── public-footer.php
│       ├── admin-header.php
│       ├── admin-sidebar.php
│       └── admin-footer.php
├── assets/
│   ├── css/
│   │   ├── main.css
│   │   ├── responsive.css
│   │   └── admin.css
│   ├── js/
│   │   ├── main.js
│   │   ├── booking.js
│   │   └── admin.js
│   └── images/
├── database/
│   ├── schema.sql
│   └── seed.sql
├── storage/
│   ├── logs/
│   └── uploads/
├── .htaccess
├── .gitignore
└── README.md
```

---

## Local Setup & Testing Instructions

### 1. File Installation Path
Place the project inside your XAMPP `htdocs` directory:
```text
c:\xampp\htdocs\ceylontherapist\
```

### 2. Database Import
1. Open phpMyAdmin (`http://localhost/phpmyadmin`) or MySQL CLI.
2. Import `database/schema.sql` to build the database tables.
3. Import `database/seed.sql` to populate default categories and initial admin credentials.

### 3. Default Admin Account
- **Email**: `admin@ceylontherapist.lk`
- **Password**: `admin123` *(Hashed via `password_hash()` in seed.sql)*

### 4. URLs
- **Public Website Landing Page**: `http://localhost/ceylontherapist/`
- **Isolated Admin Sign In**: `http://localhost/ceylontherapist/login.php`
- **Admin Dashboard** *(Requires Login)*: `http://localhost/ceylontherapist/admin_dashboard.php`
