# 🚗 Showroom Mobil Bekas - Website Katalog & Pemesanan

Website katalog showroom mobil bekas dengan fitur lengkap untuk manajemen inventory, test drive booking, dan pemesanan mobil. Dibangun dengan Laravel 11, TailwindCSS, dan Alpine.js dengan tema merah-putih-carbon yang modern.

## ✨ Fitur Utama

### 👥 Untuk Customer
- **Katalog Mobil** - Browse dan filter mobil bekas berdasarkan kategori, brand, harga, dll
- **Detail Mobil** - Informasi lengkap spesifikasi, foto, dan kondisi mobil
- **Test Drive Booking** - Jadwalkan test drive dengan mudah
- **Pemesanan Mobil** - Proses pemesanan online dengan upload dokumen
- **User Dashboard** - Tracking test drive dan order history
- **Responsive Design** - Mobile-friendly untuk semua device

### 🔧 Untuk Admin
- **Dashboard Analytics** - Overview statistik showroom
- **Manajemen Mobil** - CRUD mobil dengan upload multiple foto
- **Manajemen Test Drive** - Approve/reject/reschedule booking
- **Manajemen Order** - Track dan update status pemesanan
- **User Management** - Kelola data customer

## 🛠️ Tech Stack

- **Backend**: PHP 8.2+ & Laravel 11
- **Frontend**: TailwindCSS 4 & Alpine.js 3
- **Database**: MySQL 8.0+
- **Build Tool**: Vite
- **Icons**: Heroicons (SVG)

## 📋 Requirements

- PHP >= 8.2
- Composer
- Node.js >= 18
- MySQL >= 8.0
- NPM atau Yarn

## 🚀 Instalasi

### 1. Clone Repository
```bash
git clone <repository-url>
cd showroom-project
```

### 2. Install Dependencies
```bash
# Install PHP dependencies
composer install

# Install Node dependencies
npm install
```

### 3. Environment Setup
```bash
# Copy .env file
cp .env.example .env

# Generate application key
php artisan key:generate
```

### 4. Database Configuration
Edit file `.env` dan sesuaikan database credentials:
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=showroom_db
DB_USERNAME=root
DB_PASSWORD=
```

### 5. Run Migrations & Seeders
```bash
# Create database tables
php artisan migrate

# Seed demo data
php artisan db:seed
```

### 6. Storage Link
```bash
php artisan storage:link
```

### 7. Install Laravel Breeze (Authentication)
```bash
composer require laravel/breeze --dev
php artisan breeze:install blade
npm install
```

### 8. Build Assets & Run Server
```bash
# Build frontend assets
npm run dev

# In another terminal, start Laravel server
php artisan serve
```

Website akan berjalan di `http://localhost:8000`

## 👤 Default Login Credentials

### Admin
- Email: `admin@showroom.com`
- Password: `password`

### User
- Email: `user@example.com`
- Password: `password`

## 📁 Struktur Database

### Tables
- **users** - Data user (admin & customer)
- **categories** - Kategori mobil (SUV, Sedan, MPV, dll)
- **cars** - Data mobil bekas
- **car_images** - Multiple foto untuk setiap mobil
- **test_drives** - Booking test drive
- **orders** - Pemesanan mobil

## 🎨 Theme & Design

Website menggunakan tema **merah-putih-carbon** yang terinspirasi dari KTM:
- Primary Color: Red (#dc2626)
- Secondary Color: Dark Gray/Carbon (#1f2937)
- Accent: Bright Red (#ef4444)
- Background: White & Light Gray

## 📱 Halaman Utama

### Public Pages
- `/` - Homepage dengan hero section & featured cars
- `/catalog` - Katalog mobil dengan filter
- `/catalog/{id}` - Detail mobil

### User Pages (Requires Login)
- `/dashboard` - User dashboard
- `/test-drive` - Test drive booking
- `/orders` - Order history

### Admin Pages (Requires Admin Role)
- `/admin/dashboard` - Admin dashboard
- `/admin/cars` - Manajemen mobil
- `/admin/test-drives` - Manajemen test drive
- `/admin/orders` - Manajemen pemesanan

## 🔐 Security Features

- CSRF Protection
- Password Hashing
- Role-based Access Control (Admin/User)
- Middleware Protection
- SQL Injection Prevention (Eloquent ORM)

## 📝 Development Notes

### Adding New Car
1. Login sebagai admin
2. Navigate ke Admin Panel > Kelola Mobil
3. Click "Tambah Mobil Baru"
4. Fill form dan upload foto
5. Submit

### Managing Test Drive Requests
1. Login sebagai admin
2. Navigate ke Admin Panel > Test Drive
3. View pending requests
4. Approve/Reject dengan catatan

## 🤝 Contributing

Untuk development lebih lanjut:
1. Buat branch baru untuk fitur
2. Commit changes dengan pesan yang jelas
3. Test thoroughly
4. Submit pull request

## 📄 License

This project is for educational/internship purposes.

---

**Developed for Showroom Internship Project**
