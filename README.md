# 🚗 SMM AUTO GALLERY - Pure PHP Laravel

Showroom Mobil Bekas Berkualitas - **100% Pure PHP Laravel** (No Node.js Required!)

## ✨ Highlights

- ✅ **Pure PHP Laravel** - Tidak perlu Node.js, npm, atau Vite
- ✅ **Vanilla CSS & JavaScript** - Tidak ada framework dependencies
- ✅ **Portable** - Copy folder dan langsung jalan (setelah composer install)
- ✅ **Lightweight** - Hemat ~450MB tanpa node_modules
- ✅ **Fast Setup** - Tidak perlu `npm install` atau `npm run build`

## � Quick Start

### 1. Clone & Setup

```bash
# Clone repository
git clone <repository-url>
cd showroom-project

# Install PHP dependencies
composer install

# Setup environment
cp .env.example .env
php artisan key:generate

# Setup database
php artisan migrate --seed

# Create storage link
php artisan storage:link

# Run server
php artisan serve
```

Buka browser: `http://localhost:8000`

**TIDAK PERLU `npm install`!** 🎉

### 2. Pindah Laptop Lain

```bash
# Copy folder project
# Jalankan:
composer install
php artisan serve
```

Selesai! Tidak perlu install Node.js atau npm!

## 📁 Struktur Project

```
showroom-project/
├── app/                    # Laravel application
├── public/
│   ├── css/
│   │   └── style.css      # Pure CSS (No TailwindCSS)
│   └── js/
│       └── app.js          # Vanilla JS (No Alpine.js)
├── resources/
│   └── views/              # Blade templates
├── routes/                 # Laravel routes
├── database/               # Migrations & seeders
└── ...
```

## 🎯 Fitur Utama

### Untuk Pengunjung
- 🏠 Homepage dengan featured cars
- 🔍 Katalog mobil dengan filter & sorting
- 🚗 Detail mobil lengkap dengan galeri
- 📅 Booking test drive
- 💰 Request pemesanan
- 📱 Responsive design (mobile-friendly)

### Untuk Admin
- 📊 Dashboard dengan statistik
- 🚗 Kelola mobil (CRUD)
- 📅 Kelola test drive requests
- 💼 Kelola pemesanan
- 🔔 Notifikasi real-time

### Untuk User
- 👤 Dashboard pribadi
- 📋 Riwayat test drive
- 💳 Riwayat pemesanan
- 🔔 Notifikasi status

## 🛠️ Tech Stack

- **Backend:** Laravel 11.x
- **Database:** MySQL
- **Frontend:** Pure HTML, CSS, JavaScript
- **Authentication:** Laravel Breeze (modified)
- **Storage:** Laravel File Storage

## � Default Accounts

### Admin
- Email: `admin@showroom.com`
- Password: `password`

### User
- Email: `user@showroom.com`
- Password: `password`

## 🎨 Customization

### Mengubah Warna Theme

Edit `public/css/style.css`:

```css
/* Cari dan ubah warna primary (red) */
.bg-red-600 { background-color: #dc2626; } /* Ubah ke warna lain */
.text-red-600 { color: #dc2626; }
.btn-primary { background-color: #dc2626; }
```

### Menambah JavaScript Functionality

Edit `public/js/app.js`:

```javascript
// Tambahkan function baru
function myNewFeature() {
    // Your code
}

// Daftarkan di ready()
ready(function() {
    // ... existing code
    myNewFeature();
});
```

## � Deployment

### Shared Hosting

1. Upload semua file via FTP/SFTP
2. Point document root ke folder `public`
3. Jalankan di terminal:

```bash
composer install --optimize-autoloader --no-dev
php artisan config:cache
php artisan route:cache
php artisan view:cache
```

### VPS/Dedicated Server

```bash
# Clone repository
git clone <repository-url>
cd showroom-project

# Install dependencies
composer install --optimize-autoloader --no-dev

# Setup environment
cp .env.example .env
php artisan key:generate

# Setup database
php artisan migrate --seed

# Setup permissions
chmod -R 775 storage bootstrap/cache
chown -R www-data:www-data storage bootstrap/cache

# Create storage link
php artisan storage:link

# Cache config
php artisan config:cache
php artisan route:cache
php artisan view:cache
```

Setup Nginx/Apache untuk point ke folder `public`.

## � Development

### Menjalankan Server

```bash
php artisan serve
```

### Clear Cache

```bash
php artisan cache:clear
php artisan config:clear
php artisan route:clear
php artisan view:clear
```

### Database

```bash
# Run migrations
php artisan migrate

# Run seeders
php artisan db:seed

# Fresh migration with seed
php artisan migrate:fresh --seed
```

## 📚 Documentation

- [Migration Guide](MIGRATION_TO_PURE_PHP.md) - Penjelasan migrasi dari Vite+TailwindCSS+Alpine.js
- [Implementation Guide](IMPLEMENTATION_GUIDE.md) - Panduan implementasi fitur
- [Routes Documentation](ROUTES.md) - Daftar semua routes

## 🐛 Troubleshooting

### CSS tidak muncul
```bash
php artisan cache:clear
php artisan view:clear
# Pastikan file ada di public/css/style.css
```

### JavaScript tidak berfungsi
```bash
# Cek console browser (F12)
# Pastikan file ada di public/js/app.js
```

### Storage link error
```bash
php artisan storage:link
# Atau manual: ln -s ../storage/app/public public/storage
```

## 🤝 Contributing

1. Fork repository
2. Create feature branch (`git checkout -b feature/AmazingFeature`)
3. Commit changes (`git commit -m 'Add some AmazingFeature'`)
4. Push to branch (`git push origin feature/AmazingFeature`)
5. Open Pull Request

## 📄 License

This project is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).

## 👨‍💻 Developer

Developed with ❤️ using Pure PHP Laravel

---

## 🎉 Keunggulan Pure PHP Laravel

### Sebelum (dengan Node.js)
```
📦 Size: ~500MB (dengan node_modules)
⚙️ Setup: composer install + npm install + npm run build
🚀 Deploy: Upload + npm install + npm run build
⏱️ Time: ~5-10 menit
```

### Sesudah (Pure PHP)
```
� Size: ~50MB (tanpa node_modules)
⚙️ Setup: composer install
🚀 Deploy: Upload + composer install
⏱️ Time: ~1-2 menit
```

**Hemat 90% ukuran dan 80% waktu!** 🚀

---

**Last Updated:** 26 November 2025
**Version:** 2.0.0 (Pure PHP)
**Status:** ✅ Production Ready
