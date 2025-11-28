# 🚗 SMM AUTO GALLERY

A premium used car showroom management system built with **Laravel 11**.
This project is designed to be **lightweight** and **easy to install**, using **Pure CSS & JavaScript** (No Node.js/NPM dependencies required).

## ✨ Features

- **Pure PHP/Laravel**: No complex frontend build steps.
- **Zero-Config Database**: Pre-configured with SQLite for instant setup.
- **Responsive Design**: Custom CSS for a premium look on all devices.
- **Role-Based Access**: Admin and User dashboards.
- **Car Management**: Complete CRUD for vehicle inventory.
- **Test Drive & Orders**: Booking system with status tracking.

## 🚀 Installation Guide

Follow these simple steps to get the project running in minutes.

### Prerequisites
- PHP >= 8.2
- Composer

### Step-by-Step Setup

1. **Clone the Repository**
   ```bash
   git clone <repository-url>
   cd showroom-project
   ```

2. **Install PHP Dependencies**
   ```bash
   composer install
   ```

3. **Setup Environment**
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

4. **Setup Database**
   The project uses SQLite by default. Run migrations and seed the database:
   ```bash
   # Create database file (if not exists)
   touch database/database.sqlite

   # Run migrations and seeders
   php artisan migrate --seed
   ```

5. **Link Storage**
   ```bash
   php artisan storage:link
   ```

6. **Run the Server**
   ```bash
   php artisan serve
   ```

   Visit **http://localhost:8000** in your browser.

---

## 👤 Default Login Credentials

### Admin Account
- **Email:** `admin@showroom.com`
- **Password:** `password`

### User Account
- **Email:** `user@showroom.com`
- **Password:** `password`

---

## 🛠️ Tech Stack

- **Framework:** Laravel 11
- **Language:** PHP 8.2+
- **Database:** SQLite (Default) / MySQL (Supported)
- **Frontend:** Blade Templates, Vanilla CSS, Vanilla JS
- **Auth:** Laravel Breeze (Customized)

## 📁 Project Structure

```
showroom-project/
├── app/                 # Core Logic
├── database/            # Migrations & Seeds
├── public/
│   ├── css/style.css   # Main Stylesheet (No Tailwind Build)
│   └── js/app.js       # Main JavaScript (No Bundler)
├── resources/
│   └── views/          # Blade Templates
└── routes/             # Web Routes
```

## 📝 License

This project is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
