# 🚀 PRODUCTION DEPLOYMENT CHECKLIST
## Dinas Perumahan dan Permukiman - Kab. Katingan

### 📋 **WAJIB DIKONFIGURASI SEBELUM DEPLOY**

---

## 1. 🔐 **ENVIRONMENT & SECURITY**

### ✅ **APP Configuration**
```env
# ❌ DEVELOPMENT:
APP_ENV=local
APP_DEBUG=true
APP_URL=http://dinas-perkim.test

# ✅ PRODUCTION:
APP_ENV=production
APP_DEBUG=false
APP_URL=https://dinasperkim.katingankab.go.id
```

### ✅ **Generate New APP_KEY untuk Production**
```bash
php artisan key:generate
```

### ✅ **Database Configuration**
```env
# ❌ DEVELOPMENT:
DB_HOST=127.0.0.1
DB_DATABASE=db_dinas_perkim
DB_USERNAME=root
DB_PASSWORD=

# ✅ PRODUCTION:
DB_HOST=localhost  # atau IP database server
DB_DATABASE=production_dinas_perkim
DB_USERNAME=secure_db_user
DB_PASSWORD=STRONG_DATABASE_PASSWORD_HERE
```

---

## 2. 📧 **MAIL CONFIGURATION (Yang Sudah Anda Tanyakan)**

### ✅ **SMTP Production**
```env
# Current (Gmail):
MAIL_MAILER=smtp
MAIL_HOST=smtp.gmail.com
MAIL_PORT=465
MAIL_USERNAME=noreplay0925@gmail.com
MAIL_PASSWORD=password
MAIL_ENCRYPTION=tls

# ✅ PRODUCTION Recommendation:
# Gunakan email domain resmi:
MAIL_FROM_ADDRESS="noreply@katingankab.go.id"
MAIL_FROM_NAME="Dinas Perkim Kab. Katingan"
```

---

## 3. 🌐 **CORS CONFIGURATION**

### ✅ **Production CORS Setup**
```env
# Tambahkan ke .env production:
CORS_ALLOWED_ORIGIN_1=https://dinasperkim.katingankab.go.id
CORS_ALLOWED_ORIGIN_2=https://www.dinasperkim.katingankab.go.id

# Jika ada subdomain API:
# CORS_ALLOWED_ORIGIN_3=https://api.dinasperkim.katingankab.go.id
```

---

## 4. 🗄️ **SESSION & CACHE**

### ✅ **Production Performance**
```env
# ❌ DEVELOPMENT:
SESSION_DRIVER=file
CACHE_STORE=database

# ✅ PRODUCTION (Better Performance):
SESSION_DRIVER=database  # atau redis jika tersedia
CACHE_STORE=redis        # atau tetap database jika tidak ada redis
QUEUE_CONNECTION=database

# Jika ada Redis:
REDIS_HOST=127.0.0.1
REDIS_PASSWORD=your_redis_password
REDIS_PORT=6379
```

---

## 5. 📁 **FILE STORAGE**

### ✅ **Storage Configuration**
```env
# Current:
FILESYSTEM_DISK=local

# ✅ PRODUCTION Options:
# Option 1: Local storage (default)
FILESYSTEM_DISK=local

# Option 2: Jika menggunakan cloud storage
# FILESYSTEM_DISK=s3
# AWS_ACCESS_KEY_ID=your_key
# AWS_SECRET_ACCESS_KEY=your_secret
# AWS_DEFAULT_REGION=ap-southeast-1
# AWS_BUCKET=dinas-perkim-storage
```

---

## 6. 🔒 **SSL & SECURITY HEADERS**

### ✅ **HTTPS Configuration**
```env
# Force HTTPS di production:
APP_URL=https://dinasperkim.katingankab.go.id

# Session security:
SESSION_SECURE_COOKIE=true
SESSION_HTTP_ONLY=true
SESSION_SAME_SITE=lax
```

---

## 7. 📊 **LOGGING & MONITORING**

### ✅ **Production Logging**
```env
# ❌ DEVELOPMENT:
LOG_LEVEL=debug

# ✅ PRODUCTION:
LOG_LEVEL=error
LOG_CHANNEL=daily
LOG_STACK=single

# Optional: Error tracking
# SENTRY_LARAVEL_DSN=your_sentry_dsn
```

---

## 8. 🚀 **PERFORMANCE OPTIMIZATION**

### ✅ **Production Commands**
```bash
# Jalankan sebelum deploy:
php artisan config:cache
php artisan route:cache
php artisan view:cache
php artisan event:cache

# Database:
php artisan migrate --force
php artisan db:seed --class=DatabaseSeeder --force

# Clear development caches:
php artisan config:clear
php artisan cache:clear
php artisan route:clear
php artisan view:clear
```

---

## 9. 🔐 **SANCTUM TOKEN CONFIGURATION**

### ✅ **API Authentication**
```env
# Hapus ini di production (sudah dihapus):
# SANCTUM_STATEFUL_DOMAINS=localhost,localhost:3000,127.0.0.1,127.0.0.1:8000,::1,dinas-perkim.test

# Token expiration (opsional):
# SANCTUM_EXPIRATION=525600  # 1 year in minutes
```

---

## 10. 📱 **PWA & MOBILE SUPPORT**

### ✅ **Progressive Web App**
```env
# Jika ingin PWA support:
VITE_APP_NAME="Dinas Perkim Katingan"
VITE_APP_SHORT_NAME="Perkim"
VITE_APP_DESCRIPTION="Portal Resmi Dinas Perumahan dan Permukiman"
```

---

## 🚨 **CRITICAL SECURITY CHECKS**

### ✅ **Before Going Live:**

1. **Remove Debug Information:**
   ```env
   APP_DEBUG=false
   LOG_LEVEL=error
   ```

2. **Secure File Permissions:**
   ```bash
   chmod -R 755 /path/to/your/app
   chmod -R 644 /path/to/your/app/storage
   chmod -R 644 /path/to/your/app/bootstrap/cache
   ```

3. **Hide Sensitive Files:**
   ```nginx
   # In nginx config:
   location ~ /\.(env|git) {
       deny all;
   }
   ```

4. **Database Security:**
   - ✅ Strong database password
   - ✅ Limit database user permissions
   - ✅ Regular backups

5. **API Security:**
   - ✅ Rate limiting (sudah ada di routes/api.php)
   - ✅ Sanctum tokens dengan expiration
   - ✅ CORS properly configured

---

## 📋 **DEPLOYMENT STEPS**

### 1. **Backup Current System**
```bash
# Backup database
mysqldump -u root -p db_dinas_perkim > backup_before_production.sql

# Backup files
tar -czf app_backup_$(date +%Y%m%d).tar.gz /path/to/app
```

### 2. **Upload & Configure**
```bash
# Upload aplikasi ke server
# Update .env dengan konfigurasi production
# Set file permissions
```

### 3. **Database Setup**
```bash
php artisan migrate --force
php artisan db:seed --force
```

### 4. **Cache & Optimize**
```bash
php artisan config:cache
php artisan route:cache
php artisan view:cache
composer install --optimize-autoloader --no-dev
```

### 5. **Test Everything**
- ✅ Website loading
- ✅ Admin login
- ✅ Contact form
- ✅ API endpoints
- ✅ File uploads
- ✅ Email sending

---

## 🔧 **WEB SERVER CONFIGURATION**

### **Apache (.htaccess) - Sudah Ada**
```apache
# public/.htaccess sudah configured untuk Laravel
```

### **Nginx (Recommended)**
```nginx
server {
    listen 80;
    server_name dinasperkim.katingankab.go.id www.dinasperkim.katingankab.go.id;
    return 301 https://$server_name$request_uri;
}

server {
    listen 443 ssl;
    server_name dinasperkim.katingankab.go.id www.dinasperkim.katingankab.go.id;
    root /path/to/your/app/public;
    
    ssl_certificate /path/to/ssl/cert.pem;
    ssl_certificate_key /path/to/ssl/private.key;
    
    add_header X-Frame-Options "SAMEORIGIN";
    add_header X-XSS-Protection "1; mode=block";
    add_header X-Content-Type-Options "nosniff";
    
    index index.html index.htm index.php;
    
    charset utf-8;
    
    location / {
        try_files $uri $uri/ /index.php?$query_string;
    }
    
    location = /favicon.ico { access_log off; log_not_found off; }
    location = /robots.txt  { access_log off; log_not_found off; }
    
    error_page 404 /index.php;
    
    location ~ \.php$ {
        fastcgi_pass unix:/var/run/php/php8.3-fpm.sock;
        fastcgi_index index.php;
        fastcgi_param SCRIPT_FILENAME $realpath_root$fastcgi_script_name;
        include fastcgi_params;
    }
    
    location ~ /\.(?!well-known).* {
        deny all;
    }
}
```

---

## 📞 **SUPPORT & MAINTENANCE**

### **Regular Tasks:**
- ✅ Database backup (daily)
- ✅ Log rotation
- ✅ Security updates
- ✅ Performance monitoring
- ✅ SSL certificate renewal

### **Monitoring URLs:**
- Website: https://dinasperkim.katingankab.go.id
- API Health: https://dinasperkim.katingankab.go.id/up
- Admin: https://dinasperkim.katingankab.go.id/login

---

**🎯 Siap untuk Go-Live! 🚀**
