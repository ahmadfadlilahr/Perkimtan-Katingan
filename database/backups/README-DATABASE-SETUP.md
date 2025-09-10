# 🗄️ Database Setup Guide

**Project:** Dinas Perumahan dan Permukiman Website  
**Database:** MySQL/MariaDB  
**Date:** September 2, 2025

---

## 📋 **Prerequisites**

Pastikan Anda sudah install:
- ✅ PHP 8.1+ 
- ✅ MySQL/MariaDB
- ✅ Composer
- ✅ Laragon/XAMPP/WAMP (recommended)

---

## 📥 **Import Database**

### **Method 1: Via HeidiSQL**

1. **Buka HeidiSQL**
2. **Connect** ke MySQL server Anda
3. **Create Database Baru:**
   ```sql
   CREATE DATABASE dinas_perkim CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
   ```
4. **Import Database:**
   - File → Load SQL file
   - Pilih file: `dinas-perkim-database.sql`
   - Execute (F9)

### **Method 2: Via phpMyAdmin**

1. **Buka phpMyAdmin** (`http://localhost/phpmyadmin`)
2. **Create Database:** `dinas_perkim`
3. **Select Database** yang baru dibuat
4. **Tab Import:**
   - Choose File: `dinas-perkim-database.sql`
   - Character set: `utf8mb4_unicode_ci`
   - Click **Go**

### **Method 3: Via Command Line**

```bash
# Login ke MySQL
mysql -u root -p

# Create database
CREATE DATABASE dinas_perkim CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
EXIT;

# Import database
mysql -u root -p dinas_perkim < dinas-perkim-database.sql
```

---

## ⚙️ **Setup Laravel Environment**

### **1. Copy Environment File**
```bash
cp .env.example .env
```

### **2. Edit .env File**
Update database configuration:
```env
APP_NAME="Dinas Perumahan dan Permukiman"
APP_ENV=local
APP_KEY=
APP_DEBUG=true
APP_URL=http://localhost:8000

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=dinas_perkim
DB_USERNAME=root
DB_PASSWORD=your_mysql_password
```

### **3. Generate Application Key**
```bash
php artisan key:generate
```

### **4. Create Storage Link**
```bash
php artisan storage:link
```

### **5. Install Dependencies**
```bash
composer install
npm install
npm run build
```

---

## 🔧 **Verify Setup**

### **Test Database Connection:**
```bash
php artisan tinker
# Dalam tinker:
DB::connection()->getPdo();
# Jika sukses, akan menampilkan PDO object
```

### **Check Tables:**
```bash
php artisan migrate:status
# Semua migration harus menampilkan "Ran"
```

### **Test Website:**
```bash
php artisan serve
# Buka: http://localhost:8000
```

---

## 👥 **Default Login Credentials**

### **Admin Login:**
- **URL:** `http://localhost:8000/login`
- **Email:** `admin@dinasperkim.go.id`
- **Password:** `password123`

*(Update password setelah login pertama kali)*

---

## 📁 **File Structure Penting**

```
project/
├── .env                    # Environment config (BUAT SENDIRI)
├── database/
│   ├── migrations/         # Database structure
│   ├── seeders/           # Sample data
│   └── backups/           # Database backup files
├── storage/
│   ├── app/public/        # Uploaded files (kosong awalnya)
│   └── logs/              # Application logs
└── public/
    ├── images/            # Static images (logo, etc.)
    └── storage/           # Link ke storage (dibuat otomatis)
```

---

## 🚨 **Troubleshooting**

### **Database Connection Error:**
```bash
# Cek MySQL service running
# Cek username/password di .env
# Cek database name spelling
```

### **Storage Link Error:**
```bash
# Hapus link lama (jika ada)
rm public/storage

# Buat ulang
php artisan storage:link
```

### **Permission Error:**
```bash
# Berikan permission ke storage dan cache
chmod -R 775 storage
chmod -R 775 bootstrap/cache
```

### **Key Error:**
```bash
# Generate ulang app key
php artisan key:generate --force
```

---

## 📊 **Database Content**

Database yang di-import berisi:
- ✅ **Users table** - Admin accounts
- ✅ **Berita table** - News articles data
- ✅ **Agenda table** - Events data  
- ✅ **Galeri table** - Gallery images
- ✅ **Slides table** - Homepage slider
- ✅ **Pejabat table** - Officials data
- ✅ **VisiMisi table** - Vision & mission
- ✅ **Settings** - Website configuration

---

## 🔄 **Update & Maintenance**

### **Backup Database Secara Berkala:**
```bash
# Via command line
mysqldump -u root -p dinas_perkim > backup-$(date +%Y%m%d).sql

# Via HeidiSQL
# Tools → Export database as SQL
```

### **Update Dependencies:**
```bash
composer update
npm update
```

---

## 📞 **Need Help?**

Jika mengalami masalah:
1. **Check Laravel logs:** `storage/logs/laravel.log`
2. **Check web server logs** 
3. **Verify .env configuration**
4. **Test database connection** dengan tinker

---

**Setup Date:** September 2, 2025  
**Laravel Version:** 11.31  
**PHP Version:** 8.1+  
**Database:** MySQL 8.0+ / MariaDB 10.4+

**Status:** 🚀 **Ready for Development**
