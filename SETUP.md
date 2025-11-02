# 🚀 Quick Setup Guide

## Prerequisites Check
Pastikan sudah terinstall:
- ✅ PHP 8.2 or higher
- ✅ Composer
- ✅ Node.js 18 or higher
- ✅ MySQL 8.0 or higher

## Quick Start (5 Menit)

### 1. Install Dependencies
```bash
composer install && npm install
```

### 2. Setup Environment
```bash
cp .env.example .env
php artisan key:generate
```

### 3. Configure Database
Buat database baru di MySQL:
```sql
CREATE DATABASE showroom_db;
```

Edit `.env`:
```env
DB_DATABASE=showroom_db
DB_USERNAME=root
DB_PASSWORD=your_password
```

### 4. Run Migrations & Seed Data
```bash
php artisan migrate --seed
```

### 5. Install Authentication (Laravel Breeze)
```bash
composer require laravel/breeze --dev
php artisan breeze:install blade
npm install
```

### 6. Create Storage Link
```bash
php artisan storage:link
```

### 7. Start Development Servers
**Terminal 1** - Frontend:
```bash
npm run dev
```

**Terminal 2** - Backend:
```bash
php artisan serve
```

## 🎉 Done!

Website berjalan di: **http://localhost:8000**

### Login Credentials

**Admin:**
- Email: `admin@showroom.com`
- Password: `password`

**User:**
- Email: `user@example.com`
- Password: `password`

## 📝 Next Steps

1. **Customize Theme Colors** - Edit `resources/css/app.css`
2. **Add Car Images** - Upload via Admin Panel
3. **Configure Email** - Setup SMTP di `.env` untuk notifications
4. **Test Features** - Browse catalog, book test drive, create order

## ⚠️ Troubleshooting

### Error: "Class not found"
```bash
composer dump-autoload
```

### Error: "Mix manifest not found"
```bash
npm run build
```

### Error: "Storage link already exists"
```bash
rm public/storage
php artisan storage:link
```

### Database Connection Error
- Check MySQL service is running
- Verify credentials in `.env`
- Ensure database exists

## 🔧 Development Commands

```bash
# Clear all cache
php artisan optimize:clear

# Run migrations fresh (WARNING: deletes all data)
php artisan migrate:fresh --seed

# Create new migration
php artisan make:migration create_table_name

# Create new controller
php artisan make:controller ControllerName

# Create new model
php artisan make:model ModelName -m
```

## 📦 Production Build

```bash
# Build for production
npm run build

# Optimize Laravel
php artisan config:cache
php artisan route:cache
php artisan view:cache
```

---

**Need Help?** Check the main README.md for detailed documentation.
