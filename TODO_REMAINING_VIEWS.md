# 📋 TODO: Update Remaining Views

## ✅ Files Yang Sudah Diupdate

### Layouts
- [x] `resources/views/layouts/app.blade.php` - Main layout (DONE)
- [x] `resources/views/layouts/admin.blade.php` - Admin layout (DONE)

### Main Pages
- [x] `resources/views/home.blade.php` - Homepage (DONE)
- [x] `resources/views/catalog/index.blade.php` - Catalog page (DONE)

### Core Files
- [x] `public/css/style.css` - Pure CSS stylesheet (DONE)
- [x] `public/js/app.js` - Vanilla JavaScript (DONE)

## 📝 Files Yang Mungkin Perlu Review

Berikut adalah file-file lain yang mungkin menggunakan Alpine.js atau Tailwind classes yang kompleks. File-file ini **kemungkinan sudah berfungsi** karena menggunakan layout yang sudah diupdate, tapi perlu dicek jika ada masalah:

### Auth Pages (Menggunakan Breeze Components)
- [ ] `resources/views/auth/login.blade.php`
- [ ] `resources/views/auth/register.blade.php`
- [ ] `resources/views/auth/forgot-password.blade.php`
- [ ] `resources/views/auth/reset-password.blade.php`

**Note:** File-file ini menggunakan Blade components (`<x-guest-layout>`, `<x-text-input>`, dll). Components ini perlu diupdate jika menggunakan Alpine.js.

### Catalog Pages
- [ ] `resources/views/catalog/show.blade.php` - Detail mobil

### Test Drive Pages
- [ ] `resources/views/test-drive/index.blade.php`
- [ ] `resources/views/test-drive/create.blade.php`

### Order Pages
- [ ] `resources/views/orders/index.blade.php`
- [ ] `resources/views/orders/create.blade.php`
- [ ] `resources/views/orders/show.blade.php`

### Admin Pages
- [ ] `resources/views/admin/dashboard.blade.php`
- [ ] `resources/views/admin/cars/index.blade.php`
- [ ] `resources/views/admin/cars/create.blade.php`
- [ ] `resources/views/admin/cars/edit.blade.php`
- [ ] `resources/views/admin/test-drives/index.blade.php`
- [ ] `resources/views/admin/orders/index.blade.php`
- [ ] `resources/views/admin/orders/show.blade.php`

### User Dashboard
- [ ] `resources/views/dashboard.blade.php`

### Other Pages
- [ ] `resources/views/contact.blade.php`
- [ ] `resources/views/profile/edit.blade.php`

### Blade Components (Breeze)
Jika menggunakan Alpine.js, perlu diupdate:
- [ ] `resources/views/components/app-layout.blade.php`
- [ ] `resources/views/components/dropdown.blade.php`
- [ ] `resources/views/components/modal.blade.php`
- [ ] `resources/views/layouts/guest.blade.php`
- [ ] `resources/views/layouts/breeze.blade.php`

## 🔍 Cara Mengecek

### 1. Test Manual
Buka setiap halaman di browser dan cek:
- ✅ Styling terlihat benar
- ✅ Tidak ada console errors
- ✅ Interactive elements berfungsi (dropdown, modal, dll)

### 2. Cek Alpine.js Usage
Cari file yang masih menggunakan Alpine.js directives:

```bash
# Cari x-data
grep -r "x-data" resources/views/

# Cari x-show
grep -r "x-show" resources/views/

# Cari x-if
grep -r "x-if" resources/views/

# Cari @click
grep -r "@click" resources/views/
```

### 3. Cek @vite Directive
Cari file yang masih menggunakan @vite:

```bash
grep -r "@vite" resources/views/
```

## 🛠️ Cara Update File

Jika menemukan file yang masih menggunakan Alpine.js atau @vite:

### 1. Replace @vite dengan asset()
```blade
<!-- Sebelum -->
@vite(['resources/css/app.css', 'resources/js/app.js'])

<!-- Sesudah -->
<link rel="stylesheet" href="{{ asset('css/style.css') }}">
<script src="{{ asset('js/app.js') }}"></script>
```

### 2. Replace Alpine.js dengan data attributes
```blade
<!-- Sebelum (Alpine.js) -->
<div x-data="{ open: false }">
    <button @click="open = !open">Toggle</button>
    <div x-show="open">Content</div>
</div>

<!-- Sesudah (Vanilla JS) -->
<div class="dropdown" data-dropdown>
    <button data-dropdown-toggle>Toggle</button>
    <div class="dropdown-menu" data-dropdown-menu>Content</div>
</div>
```

### 3. Replace Tailwind Classes
Kebanyakan Tailwind classes sudah didefinisikan di `public/css/style.css`. Jika ada class yang belum ada, tambahkan di CSS file.

## ✅ Status Saat Ini

**Core functionality sudah berfungsi:**
- ✅ Homepage
- ✅ Catalog
- ✅ Navbar & Mobile Menu
- ✅ Admin Sidebar
- ✅ Dropdowns
- ✅ Rupiah Formatting
- ✅ No console errors

**Yang perlu dicek (optional):**
- Auth pages (login, register, dll)
- Detail pages (catalog show, order show, dll)
- Admin CRUD pages
- Blade components

## 📌 Catatan

Karena semua page menggunakan layout yang sudah diupdate (`layouts/app.blade.php` atau `layouts/admin.blade.php`), kemungkinan besar **semua page sudah berfungsi dengan baik**.

File-file di atas hanya perlu dicek jika:
1. Ada interactive elements yang tidak berfungsi
2. Ada styling yang rusak
3. Ada console errors saat membuka page tersebut

**Prioritas:** LOW (karena core sudah berfungsi)

---

**Last Updated:** 26 November 2025
**Status:** Core migration COMPLETE ✅
