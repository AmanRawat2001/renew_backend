# 🌱 Renew Foundation Backend

<div align="center">
  <img src="https://api.renewfoundation.in/images/renew-foundation-logo.png" alt="Renew Foundation Logo" width="200" height="auto" />
  
  **A modern Laravel backend powering the Renew Foundation digital presence**
  
  [![Laravel](https://img.shields.io/badge/Laravel-v12-FF2D20?style=flat-square&logo=laravel)](https://laravel.com)
  [![PHP](https://img.shields.io/badge/PHP-8.4+-777BB4?style=flat-square&logo=php)](https://www.php.net)
  [![License](https://img.shields.io/badge/License-MIT-green?style=flat-square)](LICENSE)
</div>

---

## 📋 Table of Contents

- [Project Overview](#project-overview)
- [Technology Stack](#technology-stack)
- [Architecture & Workflow](#architecture--workflow)
- [Project Structure](#project-structure)
- [Installation & Setup](#installation--setup)
- [Development](#development)
- [Deployment](#deployment)
- [Database Migrations](#database-migrations)
- [Testing](#testing)
- [Contributing](#contributing)

---

## 🎯 Project Overview

Renew Foundation Backend is a comprehensive content management system built with Laravel, providing a robust API and admin dashboard for managing:

- **Homepage Content**: Sliders, feature cards, and impact statistics
- **Mission & Values**: Mission slides and organizational messaging
- **Impact Stories**: Case studies and impact narratives with supporting media
- **Programs & Publications**: Program information and publication management
- **User Management**: Admin authentication with two-factor authentication
- **Content Sections**: Dynamic page sections for various areas of the website

### Key Features

✨ **Admin Dashboard**: Livewire-powered real-time admin interface  
🔐 **Security**: Two-factor authentication, API token-based access with Sanctum  
🚀 **Performance**: Optimized database queries with eager loading  
📱 **Responsive**: Mobile-friendly admin interface  
🔄 **Real-time Updates**: Events and WebSockets ready with Livewire Flux  
🧪 **Well-Tested**: Comprehensive test suite with Pest PHP  

---

## 🛠️ Technology Stack

| Layer | Technologies |
|-------|--------------|
| **Backend Framework** | Laravel 12, Livewire 4 |
| **Language** | PHP 8.4+ |
| **Database** | MySQL/SQLite (configurable) |
| **Authentication** | Laravel Fortify + Sanctum |
| **UI Components** | Livewire Flux |
| **Frontend Build** | Vite |
| **Testing** | Pest PHP |
| **Code Quality** | Laravel Pint (PSR-12) |
| **Deployment** | GitHub Actions → AWS EC2 |

---

## 🏗️ Architecture & Workflow

```
┌─────────────────────────────────────────────────────────────────────┐
│                        DEVELOPMENT WORKFLOW                         │
└─────────────────────────────────────────────────────────────────────┘

1️⃣  LOCAL DEVELOPMENT
    ├─ Clone Repository
    ├─ Run Setup: composer run setup
    ├─ Develop & Test Locally
    └─ Code Quality: composer run lint

2️⃣  VERSION CONTROL (GitHub)
    ├─ Commit & Push to Branch
    ├─ Create Pull Request
    ├─ Code Review
    └─ Merge to Main ──────────────┐
                                   │
3️⃣  CI/CD PIPELINE (GitHub Actions)
    │                              │
    ├─ Trigger: On push to 'main'◄─┘
    │
    ├─ Checkout Code
    ├─ Validate PHP/Composer
    ├─ Run Tests (Pest)
    ├─ Code Quality Checks (Pint)
    └─ Build Assets (Vite) ────────┐
                                   │
4️⃣  DEPLOYMENT TO PRODUCTION     │
    │                              │
    ├─ SSH into EC2 Instance ◄────┘
    │
    ├─ Create Release Directory
    │   └─ /var/www/renew-releases/release_[TIMESTAMP]
    │
    ├─ Clone Repository
    │
    ├─ Link Shared Resources
    │   ├─ .env (from /renew-shared/)
    │   └─ Storage (from /renew-shared/storage)
    │
    ├─ Install Dependencies
    │   ├─ composer install (production)
    │   └─ npm install & build
    │
    ├─ Run Database Migrations
    │   └─ php artisan migrate --force
    │
    ├─ Clear Cache & Warm Up
    │   ├─ php artisan cache:clear
    │   └─ php artisan config:cache
    │
    ├─ Setup Symlink
    │   └─ Point /var/www/renew to new release
    │
    └─ Restart Services
        └─ Laravel Supervisor/PHP-FPM

5️⃣  MONITORING & MAINTENANCE
    ├─ Application Logs (storage/logs/)
    ├─ Error Tracking
    ├─ Database Backups
    └─ Performance Monitoring

┌─────────────────────────────────────────────────────────────────────┐
│                          TECH STACK FLOW                            │
└─────────────────────────────────────────────────────────────────────┘

User/Admin
    │
    ├─→ Livewire Components (Real-time UI)
    │
    ├─→ Laravel Routes & Controllers
    │   ├─ Admin Routes (web.php)
    │   └─ API Routes (api.php)
    │
    ├─→ Business Logic
    │   ├─ Models (Eloquent ORM)
    │   ├─ Services & Actions
    │   └─ Validation
    │
    ├─→ Database Layer
    │   ├─ MySQL/SQLite
    │   └─ Migrations & Seeders
    │
    └─→ Response
        ├─ JSON (API)
        └─ HTML (Admin Dashboard)
```

---

## 📁 Project Structure

```
renew_backend/
├── app/
│   ├── Http/
│   │   ├── Controllers/
│   │   │   └── Admin/          # Admin controllers for content management
│   │   ├── Middleware/         # Route middleware
│   │   └── Requests/           # Form validation rules
│   │
│   ├── Models/                 # Eloquent models
│   │   ├── User.php
│   │   ├── Slider.php
│   │   ├── ContentSection.php
│   │   ├── Impact.php
│   │   ├── ImpactStory.php
│   │   └── ...
│   │
│   ├── Livewire/               # Livewire components
│   │   └── Actions/
│   │
│   └── Providers/
│       ├── AppServiceProvider.php
│       └── FortifyServiceProvider.php
│
├── database/
│   ├── migrations/             # Database schema changes
│   ├── factories/              # Model factories for testing
│   └── seeders/                # Database seeders
│
├── resources/
│   ├── css/                    # Tailwind CSS
│   ├── js/                     # Vue/JavaScript components
│   └── views/                  # Blade templates
│
├── routes/
│   ├── web.php                 # Web routes (admin dashboard)
│   ├── api.php                 # API routes
│   └── console.php             # Console commands
│
├── tests/
│   ├── Feature/                # Feature tests
│   ├── Unit/                   # Unit tests
│   └── Pest.php                # Pest test configuration
│
├── .github/
│   └── workflows/
│       └── deploy.yml          # GitHub Actions CI/CD pipeline
│
├── config/
│   ├── app.php
│   ├── database.php
│   ├── auth.php
│   └── ...
│
└── public/
    ├── index.php               # Application entry point
    └── build/                  # Compiled assets
```

---

## 🚀 Installation & Setup

### Prerequisites

- **PHP** 8.2 or higher
- **Composer** (latest)
- **Node.js** 18+ and npm
- **MySQL** 8.0+ or SQLite
- **Git**

### Quick Start

```bash
# 1. Clone the repository
git clone https://github.com/AmanRawat2001/renew_backend.git
cd renew_backend

# 2. Run automated setup
composer run setup

# This command automatically:
# ✓ Installs Composer dependencies
# ✓ Copies .env.example to .env
# ✓ Generates APP_KEY
# ✓ Runs database migrations
# ✓ Installs npm dependencies
# ✓ Compiles frontend assets with Vite
```

### Manual Setup (if needed)

```bash
# Install PHP dependencies
composer install

# Copy environment file
cp .env.example .env

# Generate application key
php artisan key:generate

# Create database tables
php artisan migrate

# Install JavaScript dependencies
npm install

# Build frontend assets
npm run build

# Start development server
php artisan serve

# In another terminal, start Vite dev server
npm run dev
```

### Environment Configuration

Update your `.env` file with:

```env
APP_NAME="Renew Foundation"
APP_ENV=local
APP_KEY=base64:XXXXX
APP_DEBUG=true
APP_URL=http://localhost:8000

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=renew_foundation
DB_USERNAME=root
DB_PASSWORD=

MAIL_DRIVER=smtp
MAIL_HOST=smtp.mailtrap.io
MAIL_PORT=465
MAIL_USERNAME=your_username
MAIL_PASSWORD=your_password
```

---

## 💻 Development

### Running the Application

```bash
# Terminal 1: Start Laravel development server
php artisan serve

# Terminal 2: Start Vite dev server for hot module replacement
npm run dev
```

Visit `http://localhost:8000` to access the application.

### Code Quality

```bash
# Format code with Laravel Pint (PSR-12)
composer run lint

# Run all tests
composer test

# Run specific test file
composer test tests/Feature/SomeFeatureTest.php

# Generate test coverage report
composer test -- --coverage
```

### Database Management

```bash
# Create a new migration
php artisan make:migration create_table_name

# Run all pending migrations
php artisan migrate

# Rollback last migration
php artisan migrate:rollback

# Fresh start (⚠️ caution: drops all tables)
php artisan migrate:fresh --seed
```

### Tinker (Interactive Shell)

```bash
php artisan tinker

# Inside tinker:
User::create(['name' => 'John', 'email' => 'john@example.com', 'password' => Hash::make('password')])
User::all()
```

---

## 🔄 Deployment

### Prerequisites for Deployment

- AWS EC2 instance with Ubuntu/Debian
- Apache web server
- PHP 8.4+ with required extensions
- MySQL 8.0+
- SSH access to server

### Deployment Flow

#### Automatic Deployment (GitHub Actions)

The `.github/workflows/deploy.yml` file automates the entire deployment process:

1. **Trigger**: Push to `main` branch
2. **Actions**:
   - Checkout code
   - SSH into EC2 instance
   - Clone repository into timestamped release directory
   - Link shared `.env` and storage files
   - Install dependencies (production mode)
   - Run database migrations
   - Clear application cache
   - Update symlink to new release
   - Restart services

```yaml
# Deployment Configuration (.github/workflows/deploy.yml)
Release Strategy: Timestamped releases
Shared Files: .env, storage/
Rollback: Automatic symlink revert to previous release
Zero-Downtime: Yes (new release built before switching)
```

### Manual Deployment (If Needed)

```bash
# SSH into server
ssh -i your-key.pem ubuntu@your-ec2-ip

# Navigate to project directory
cd /var/www/renew-releases

# Create new release
mkdir -p release_$(date +%s)
cd release_$(date +%s)

# Clone and deploy
git clone --depth 1 https://github.com/AmanRawat2001/renew_backend.git .
ln -sfn /var/www/renew-shared/.env .env
ln -sfn /var/www/renew-shared/storage storage
composer install --no-dev --optimize-autoloader
php artisan migrate --force
php artisan cache:clear
php artisan config:cache

# Update symlink
ln -sfn /var/www/renew-releases/release_$(date +%s) /var/www/renew
sudo systemctl restart php-fpm
```

### Deployment Secrets (GitHub)

Configure these secrets in your GitHub repository settings:

- `EC2_HOST`: Your EC2 instance IP/domain
- `EC2_USER`: SSH username (usually `ubuntu`)
- `EC2_SSH_KEY`: Private SSH key for EC2 access

---

## 🗄️ Database Migrations

### Available Migrations

| Migration | Purpose |
|-----------|---------|
| `create_users_table` | User authentication & admin accounts |
| `create_cache_table` | Cache driver support |
| `create_jobs_table` | Queue job storage |
| `add_two_factor_columns_to_users_table` | 2FA support |
| `create_sliders_table` | Homepage image carousel |
| `create_content_sections_table` | Dynamic page sections |
| `create_feature_cards_table` | Feature card management |
| `create_impacts_table` | Impact statistics |
| `create_impact_stories_table` | Case studies & narratives |

### Running Migrations

```bash
# Run all pending migrations
php artisan migrate

# Run specific migration
php artisan migrate --path=database/migrations/2026_02_25_101826_create_sliders_table.php

# Rollback all migrations
php artisan migrate:reset

# Refresh database (rollback + migrate)
php artisan migrate:refresh

# Fresh database with seeds
php artisan migrate:fresh --seed
```

---

## 🧪 Testing

The project uses **Pest PHP** for elegant, modern testing.

### Running Tests

```bash
# Run all tests
npm run test
# Or
composer test

# Run specific test file
npm run test tests/Feature/AdminTest.php

# Run tests matching a pattern
npm run test --filter=Admin

# Run tests with coverage report
npm run test -- --coverage

# Watch mode (auto-run on file changes)
npm run test -- --watch
```

### Test Directory Structure

```
tests/
├── Feature/          # Integration tests (test full features)
├── Unit/             # Unit tests (test individual functions)
└── Pest.php          # Pest configuration
```

### Example Test

```php
// tests/Feature/AdminAuthTest.php
use App\Models\User;

it('can login with valid credentials', function () {
    $user = User::factory()->create(['password' => 'password']);
    
    $response = $this->post('/login', [
        'email' => $user->email,
        'password' => 'password',
    ]);
    
    $response->assertRedirect('/dashboard');
    $this->assertAuthenticatedAs($user);
});
```

---

## 📝 Environment Files

### `.env.example`

```env
APP_NAME="Renew Foundation"
APP_ENV=local
APP_KEY=
APP_DEBUG=true
APP_URL=http://localhost

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=renew
DB_USERNAME=root
DB_PASSWORD=

MAIL_DRIVER=smtp
MAIL_HOST=smtp.mailtrap.io
MAIL_PORT=465
MAIL_USERNAME=
MAIL_PASSWORD=

REDIS_HOST=127.0.0.1
REDIS_PASSWORD=null
REDIS_PORT=6379

SESSION_DRIVER=database
```

---

## 🔐 Security Features

- **Two-Factor Authentication**: Enabled for all admin accounts
- **CSRF Protection**: Built into all forms
- **SQL Injection Prevention**: Eloquent ORM parameterized queries
- **XSS Protection**: Blade template escaping by default
- **API Token Authentication**: Sanctum tokens for API access
- **Rate Limiting**: Request throttling to prevent abuse
- **Password Encryption**: bcrypt hashing with configurable rounds

---

## 📦 Key Dependencies

### Production
- `laravel/framework` (v12) - Web framework
- `laravel/sanctum` (v4) - API token authentication
- `laravel/fortify` (v1.30) - Authentication backend
- `livewire/livewire` (v4) - Real-time UI components
- `livewire/flux` (v2.9) - Component library

### Development
- `pestphp/pest` (v4.4) - Testing framework
- `laravel/pint` (v1.24) - Code formatter
- `laravel/pail` (v1.2) - Log viewer
- `nunomaduro/collision` - Error display

---

## 🐛 Troubleshooting

### Common Issues

#### "No installed version of package laravel/framework"
```bash
composer update
composer install
```

#### "Class 'App\Models\User' not found"
```bash
composer dump-autoload
php artisan cache:clear
```

#### "SQLSTATE[HY000]: General error"
```bash
php artisan migrate:refresh
php artisan db:seed
```

#### "Vite manifest file not found"
```bash
npm run build
# or in development
npm run dev
```

---

## 📚 Helpful Commands

```bash
# Create new controller
php artisan make:controller Admin/CategoryController

# Create new model with migration
php artisan make:model Category -m

# Create new Livewire component
php artisan make:livewire admin.category.create

# Generate API routes
php artisan install:api

# List all routes
php artisan route:list

# Clear all caches
php artisan cache:clear
php artisan config:clear
php artisan view:clear

# Database backup (MySQL)
mysqldump -u root -p renew_db > backup.sql

# Database restore
mysql -u root -p renew_db < backup.sql
```

---

## 🤝 Contributing

1. **Create a Feature Branch**
   ```bash
   git checkout -b feature/your-feature-name
   ```

2. **Make Your Changes**
   - Write clean, PSR-12 compliant code
   - Add tests for new features
   - Update documentation

3. **Test Locally**
   ```bash
   composer run lint  # Code formatting
   composer test      # Run tests
   ```

4. **Commit & Push**
   ```bash
   git commit -m "feat: add new feature"
   git push origin feature/your-feature-name
   ```

5. **Create Pull Request**
   - Describe your changes
   - Link related issues
   - Wait for code review

---

## 📞 Support & Contact

For issues and questions:
- 📧 Email: [amanrawat0506@gmail.com](mailto:amanrawat0506@gmail.com)
- 🐛 Issues: [GitHub Issues](https://github.com/AmanRawat2001/renew_backend/issues)

---

## 📄 License

This project is open source and available under the [MIT License](LICENSE).

---

<div align="center">
  
  **Built with ❤️ for Renew Foundation**
  
  Made by [Aman Rawat](https://github.com/AmanRawat2001)
  
  *Renewing communities, one project at a time* 🌱

</div>
