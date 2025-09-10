# 🏛️ Sistem Informasi Dinas Perumahan, Kawasan Permukiman dan Pertanahan

<div align="center">

![Laravel](https://img.shields.io/badge/Laravel-11.31-FF2D20?style=for-the-badge&logo=laravel&logoColor=white)
![PHP](https://img.shields.io/badge/PHP-8.2+-777BB4?style=for-the-badge&logo=php&logoColor=white)
![Tailwind CSS](https://img.shields.io/badge/Tailwind_CSS-3.1-38B2AC?style=for-the-badge&logo=tailwind-css&logoColor=white)
![Alpine.js](https://img.shields.io/badge/Alpine.js-3.4-8BC34A?style=for-the-badge&logo=alpine.js&logoColor=white)

**Platform web modern untuk manajemen konten dan layanan publik Dinas Perkim**

[Demo](#demo) •
[Fitur](#-fitur-utama) •
[Instalasi](#-instalasi) •
[API Docs](#-api-documentation) •
[Kontribusi](#-kontribusi)

</div>

## 📋 Deskripsi

Sistem Informasi Dinas Perumahan, Kawasan Permukiman dan Pertanahan adalah platform web yang dirancang untuk:

- **Mengelola konten publik** (berita, agenda, galeri, unduhan)
- **Menyediakan informasi organisasi** (profil dinas, visi-misi, struktur)
- **Melayani masyarakat** melalui interface yang user-friendly
- **Mengelola administrasi** dengan dashboard admin yang komprehensif
- **Menyediakan API** untuk integrasi dengan sistem lain

## 🚀 Fitur Utama

### 🌐 Website Publik
- **Beranda** - Landing page dengan hero section dan informasi utama
- **Berita** - Sistem publikasi berita dengan fitur pencarian
- **Agenda** - Manajemen kegiatan dan event dinas
- **Galeri** - Showcase foto dokumentasi kegiatan
- **Unduhan** - Pusat dokumen dan formulir publik dengan pencarian
- **Profil Dinas** - Visi, misi, dan informasi organisasi
- **Struktur Organisasi** - Informasi pejabat dan hierarki
- **Kontak** - Informasi kontak dan lokasi

### 🔧 Dashboard Admin
- **Content Management System (CMS)** lengkap
- **User Management** dengan role-based access
- **Media Management** untuk upload dan organize files
- **Activity Logging** untuk audit trail
- **Dashboard Analytics** untuk monitoring website
- **CRUD Operations** untuk semua entitas

### 🔗 REST API
- **48+ API Endpoints** yang terdokumentasi lengkap
- **JWT Authentication** untuk keamanan
- **Rate Limiting** dan throttling
- **OpenAPI 3.0 Documentation** (Swagger UI)
- **Public & Private endpoints** terpisah
- **Standardized responses** dengan format konsisten

### 🔍 Fitur Pencarian
- **Search pada Berita** - Cari berdasarkan judul, penulis, atau isi
- **Search pada Unduhan** - Cari dokumen berdasarkan judul atau deskripsi
- **Highlighting** kata kunci yang dicari
- **Pagination** yang mempertahankan filter pencarian
- **Enhanced UX** dengan keyboard shortcuts

## 🛠️ Tech Stack

### Backend
- **Framework**: Laravel 11.31
- **PHP**: 8.2+
- **Database**: SQLite (development), MySQL/PostgreSQL (production)
- **Authentication**: Laravel Sanctum + JWT
- **API Documentation**: L5-Swagger (OpenAPI 3.0)
- **Permissions**: Spatie Laravel Permission
- **File Storage**: Laravel Storage (local/cloud)

### Frontend
- **CSS Framework**: Tailwind CSS 3.1
- **JavaScript**: Alpine.js 3.4
- **Build Tool**: Vite 6.0
- **Icons**: Heroicons
- **Forms**: Tailwind Forms
- **Responsive**: Mobile-first approach

### Development Tools
- **Testing**: Pest PHP
- **Code Style**: Laravel Pint
- **Package Manager**: Composer + NPM
- **Asset Compilation**: Vite
- **Development Server**: Laravel Artisan

## 📁 Struktur Proyek

```
dinas-perkim/
├── 📁 app/
│   ├── 📁 Console/Commands/     # Custom Artisan commands
│   ├── 📁 Http/Controllers/     # Controllers (Web, API, Admin)
│   │   ├── 📁 Api/             # API Controllers + Base classes
│   │   └── 📁 Admin/           # Admin dashboard controllers
│   ├── 📁 Models/              # Eloquent models
│   ├── 📁 Services/            # Business logic services
│   └── 📁 Helpers/             # Helper classes
├── 📁 database/
│   ├── 📁 migrations/          # Database schema
│   └── 📁 seeders/            # Sample data
├── 📁 resources/
│   ├── 📁 views/              # Blade templates
│   │   ├── 📁 layouts/        # Layout templates
│   │   ├── 📁 components/     # Reusable components
│   │   ├── 📁 admin/          # Admin dashboard views
│   │   └── 📁 [modules]/      # Feature-specific views
│   ├── 📁 css/               # Stylesheets
│   └── 📁 js/                # JavaScript files
├── 📁 routes/
│   ├── web.php               # Web routes
│   ├── api.php               # API routes
│   └── auth.php              # Authentication routes
├── 📁 storage/api-docs/       # Generated API documentation
└── 📁 public/                # Public assets
```

## 🗃️ Database Schema

### Core Tables
| Tabel | Deskripsi | Relasi |
|-------|-----------|---------|
| `users` | User dan admin sistem | - |
| `beritas` | Artikel berita | belongsTo: User |
| `agendas` | Kegiatan dan event | belongsTo: User |
| `galeris` | Foto galeri | belongsTo: User |
| `unduhans` | Dokumen download | - |
| `pejabats` | Data pejabat/staff | - |
| `visi_misis` | Visi, misi, tujuan | - |
| `slides` | Banner/slider homepage | - |
| `pesans` | Pesan kontak masuk | - |
| `activity_logs` | Log aktivitas sistem | belongsTo: User |

### Permission System
| Tabel | Deskripsi |
|-------|-----------|
| `roles` | Role user (admin, editor, etc.) |
| `permissions` | Permission spesifik |
| `role_has_permissions` | Mapping role-permission |
| `model_has_roles` | Mapping user-role |

## 🚀 Instalasi

### Prasyarat
- PHP 8.2 atau lebih baru
- Composer
- Node.js & NPM
- Web server (Apache/Nginx) atau Laravel development server

### 1. Clone Repository
```bash
git clone [repository-url]
cd dinas-perkim
```

### 2. Install Dependencies
```bash
# Install PHP dependencies
composer install

# Install JavaScript dependencies
npm install
```

### 3. Environment Setup
```bash
# Copy environment file
cp .env.example .env

# Generate application key
php artisan key:generate

# Configure database di .env
# Untuk development, SQLite sudah dikonfigurasi
```

### 4. Database Setup
```bash
# Run migrations
php artisan migrate

# Seed sample data (optional)
php artisan db:seed
```

### 5. Storage & Permissions
```bash
# Create storage symbolic link
php artisan storage:link

# Generate API documentation
php artisan l5-swagger:generate
```

### 6. Build Assets
```bash
# For development
npm run dev

# For production
npm run build
```

### 7. Start Development Server
```bash
# Option 1: Laravel development server
php artisan serve

# Option 2: Complete development environment
composer run dev
```

Akses aplikasi di: `http://localhost:8000`

### API Documentation
```env
# L5-Swagger configuration
L5_SWAGGER_GENERATE_ALWAYS=true
L5_SWAGGER_CONST_HOST=http://localhost:8000
```

## 📚 API Documentation

### Akses API Docs
- **Swagger UI**: `http://localhost:8000/api/documentation`
- **JSON Schema**: `http://localhost:8000/api/documentation.json`

### Authentication
```bash
# Login untuk mendapatkan token
POST /api/login
{
    "email": "admin@example.com",
    "password": "password"
}

# Gunakan token di header
Authorization: Bearer {your-token}
```

### Endpoint Categories

| Category | Base URL | Auth Required | Description |
|----------|----------|---------------|-------------|
| **Public** | `/api/public/*` | ❌ | Data publik tanpa auth |
| **Auth** | `/api/login`, `/api/logout` | ❌/✅ | Authentication |
| **Content** | `/api/berita`, `/api/agenda` | ✅ | Content management |
| **Media** | `/api/galeri`, `/api/unduhan` | ✅ | Media management |
| **Admin** | `/api/users`, `/api/settings` | ✅ | Admin operations |

### Response Format
```json
{
    "success": true,
    "message": "Operation successful",
    "data": {
        // Response data
    },
    "meta": {
        "current_page": 1,
        "total": 100
        // Pagination info
    }
}
```

## 🎨 UI/UX Features

### Design System
- **Color Palette**: Indigo primary, semantic colors
- **Typography**: System fonts dengan fallback
- **Spacing**: Tailwind's consistent spacing scale
- **Components**: Reusable Blade components

### Responsive Design
- **Mobile First**: Optimized untuk mobile devices
- **Breakpoints**: sm, md, lg, xl, 2xl
- **Touch Friendly**: Button sizes dan tap targets
- **Performance**: Optimized images dan lazy loading

### Accessibility
- **Semantic HTML**: Proper heading hierarchy
- **ARIA Labels**: Screen reader support
- **Keyboard Navigation**: Full keyboard accessibility
- **Color Contrast**: WCAG AA compliant

### Interactive Features
- **Search**: Real-time search dengan highlighting
- **Pagination**: Ajax-powered navigation
- **Modals**: Accessible modal dialogs
- **Forms**: Client-side validation
- **Notifications**: Toast notifications
- **Loading States**: Skeleton screens

## 🔒 Security Features

### Authentication & Authorization
- **JWT Tokens** dengan expiration
- **Role-based permissions** (Spatie)
- **Route protection** middleware
- **CSRF protection** untuk forms
- **Password hashing** (bcrypt)

### API Security
- **Rate limiting** (5 requests/minute untuk sensitive endpoints)
- **Input validation** pada semua endpoints
- **SQL injection protection** (Eloquent ORM)
- **XSS protection** (Blade templating)

### File Upload Security
- **MIME type validation**
- **File size limits**
- **Sanitized filenames**
- **Storage outside web root**

## 🧪 Testing

### Run Tests
```bash
# Run all tests
php artisan test

# Run specific test suite
php artisan test --testsuite=Feature

# Run with coverage
php artisan test --coverage
```

### Test Structure
```
tests/
├── Feature/           # Integration tests
│   ├── AuthTest.php
│   ├── ApiTest.php
│   └── WebTest.php
└── Unit/             # Unit tests
    ├── ModelTest.php
    └── ServiceTest.php
```

## 📈 Performance

### Optimization Features
- **Database indexing** pada kolom yang sering di-query
- **Eager loading** untuk mencegah N+1 queries
- **Query caching** untuk data statis
- **Asset minification** (CSS/JS)
- **Image optimization** dengan intervention/image
- **CDN ready** untuk static assets

### Monitoring
- **Activity logging** untuk audit
- **Error logging** dengan context
- **Performance monitoring** dengan Telescope (optional)

## 🚀 Deployment

### Production Checklist
- [ ] Set `APP_ENV=production`
- [ ] Set `APP_DEBUG=false`
- [ ] Configure proper database
- [ ] Set up file storage (S3/local)
- [ ] Configure mail settings
- [ ] Run `php artisan config:cache`
- [ ] Run `php artisan route:cache`
- [ ] Run `php artisan view:cache`
- [ ] Set up SSL certificate
- [ ] Configure web server
- [ ] Set up backup strategy

### Server Requirements
- **PHP**: 8.2+ dengan extensions: BCMath, Ctype, JSON, Mbstring, OpenSSL, PDO, Tokenizer, XML
- **Database**: MySQL 5.7+ / PostgreSQL 10+ / SQLite 3.8.8+
- **Web Server**: Apache 2.4+ / Nginx 1.15+
- **Memory**: 512MB minimum, 1GB recommended
- **Storage**: 1GB minimum untuk aplikasi + storage files

## 📝 Development Guide

### Code Style
```bash
# Format code dengan Laravel Pint
./vendor/bin/pint
```

### Custom Commands
```bash
# Regenerate API documentation
php artisan api:regenerate-docs

# Clear all caches
php artisan optimize:clear
```

### Adding New Features
1. Create migration: `php artisan make:migration`
2. Create model: `php artisan make:model`
3. Create controller: `php artisan make:controller`
4. Create service: Manual create in `app/Services/`
5. Add routes: Update `routes/web.php` atau `routes/api.php`
6. Create views: Add Blade templates
7. Update API docs: Add OpenAPI annotations
8. Write tests: Create feature/unit tests

## 🤝 Kontribusi

### Development Workflow
1. Fork repository
2. Create feature branch (`git checkout -b feature/amazing-feature`)
3. Commit changes (`git commit -m 'Add amazing feature'`)
4. Push to branch (`git push origin feature/amazing-feature`)
5. Create Pull Request

### Coding Standards
- Follow PSR-12 coding standard
- Use meaningful variable dan function names
- Add docblocks untuk public methods
- Write tests untuk new features
- Update documentation

## 📞 Support

### Getting Help
- **Documentation**: Baca README dan inline comments
- **API Docs**: Swagger UI di `/api/documentation`
- **Issues**: Create GitHub issue untuk bugs
- **Questions**: Contact development team

### Known Issues
- File upload size limit (default 2MB)
- Search hanya support basic text matching
- Email notifications memerlukan konfigurasi SMTP

## 📄 License

This project is licensed under the MIT License - see the [LICENSE](LICENSE) file for details.

## 🙏 Credits

### Dependencies
- **Laravel** - Web framework
- **Tailwind CSS** - Utility-first CSS framework
- **Alpine.js** - Lightweight JavaScript framework
- **L5-Swagger** - API documentation generator
- **Spatie Laravel Permission** - Role dan permission management

### Team
- **Development**: Internal team
- **Design**: Based on modern web standards
- **Testing**: Community feedback dan internal QA

---

<div align="center">

**Dibuat dengan ❤️ untuk Dinas Perumahan, Kawasan Permukiman dan Pertanahan**

Last updated: August 2025

</div>
