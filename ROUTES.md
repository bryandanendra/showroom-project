# 🛣️ Routes Documentation

## Public Routes (No Authentication)

### Homepage
```
GET  /                    HomeController@index
```
- Menampilkan homepage dengan featured cars
- Data: categories, featuredCars (6 mobil terbaru)

### Catalog
```
GET  /catalog             CatalogController@index
```
- Browse semua mobil dengan filter
- Query params: brand, category, max_price, transmission, etc.

```
GET  /catalog/{car}       CatalogController@show
```
- Detail mobil spesifik
- Menampilkan: spesifikasi, foto, fitur, harga

---

## User Routes (Requires Authentication)

### Dashboard
```
GET  /dashboard
```
- User dashboard overview
- Menampilkan: test drive history, orders, profile

### Test Drive
```
GET  /test-drive                    TestDriveController@index
```
- List test drive bookings user
- Status: pending, approved, rejected, completed

```
GET  /test-drive/create             TestDriveController@create
```
- Form booking test drive
- Select: car, date, time, location

```
POST /test-drive                    TestDriveController@store
```
- Submit test drive booking
- Validation: car_id, date, time required

### Orders
```
GET  /orders                        OrderController@index
```
- List semua orders user
- Status tracking

```
GET  /orders/create/{car}           OrderController@create
```
- Form pemesanan mobil
- Upload: KTP, SIM
- Input: payment method, DP, notes

```
POST /orders                        OrderController@store
```
- Submit order
- Auto-generate order number
- Update car status to 'reserved'

```
GET  /orders/{order}                OrderController@show
```
- Detail order spesifik
- Download documents

---

## Admin Routes (Requires Admin Role)

Prefix: `/admin`
Middleware: `auth`, `admin`

### Dashboard
```
GET  /admin/dashboard               DashboardController@index
```
- Statistics overview
- Charts: sales, bookings, inventory
- Recent activities

### Car Management (Resource Controller)
```
GET     /admin/cars                 CarController@index
GET     /admin/cars/create          CarController@create
POST    /admin/cars                 CarController@store
GET     /admin/cars/{car}           CarController@show
GET     /admin/cars/{car}/edit      CarController@edit
PUT     /admin/cars/{car}           CarController@update
DELETE  /admin/cars/{car}           CarController@destroy
```

**Index** - List semua mobil dengan pagination
- Filter: status, category, brand
- Search: brand, model, license plate

**Create** - Form tambah mobil baru
- Upload multiple images
- Select category
- Input: brand, model, year, price, specs

**Store** - Save mobil baru
- Validation rules
- Handle image uploads
- Set main_image

**Show** - Detail mobil untuk admin
- View all data
- Image gallery
- Related bookings/orders

**Edit** - Form edit mobil
- Pre-filled data
- Update images
- Change status

**Update** - Save changes
- Validate updates
- Handle new images
- Update timestamps

**Destroy** - Soft delete mobil
- Check if has active orders
- Prevent deletion if reserved/sold

### Test Drive Management
```
GET    /admin/test-drives                      TestDriveController@index
```
- List semua test drive requests
- Filter by status: pending, approved, rejected
- Sort by date

```
PATCH  /admin/test-drives/{testDrive}/approve  TestDriveController@approve
```
- Approve test drive request
- Add admin notes
- Send notification to user

```
PATCH  /admin/test-drives/{testDrive}/reject   TestDriveController@reject
```
- Reject test drive request
- Require rejection reason
- Send notification to user

### Order Management
```
GET    /admin/orders                   OrderController@index
```
- List semua orders
- Filter: status, date range
- Search: order number, customer name

```
GET    /admin/orders/{order}           OrderController@show
```
- Detail order lengkap
- Customer info
- Car details
- Documents (KTP, SIM)
- Payment info

```
PATCH  /admin/orders/{order}/approve   OrderController@approve
```
- Approve order
- Update car status to 'sold'
- Set approved_at timestamp
- Send confirmation email

```
PATCH  /admin/orders/{order}/reject    OrderController@reject
```
- Reject order
- Revert car status to 'available'
- Add rejection notes
- Notify customer

```
PATCH  /admin/orders/{order}/complete  OrderController@complete
```
- Mark order as completed
- Set completed_at timestamp
- Final status update

---

## Authentication Routes (Laravel Breeze)

### Register
```
GET   /register                      RegisterController@create
POST  /register                      RegisterController@store
```

### Login
```
GET   /login                         LoginController@create
POST  /login                         LoginController@store
```

### Logout
```
POST  /logout                        LoginController@destroy
```

### Password Reset
```
GET   /forgot-password               PasswordResetController@create
POST  /forgot-password               PasswordResetController@store
GET   /reset-password/{token}        PasswordResetController@edit
POST  /reset-password                PasswordResetController@update
```

### Email Verification
```
GET   /verify-email                  EmailVerificationController@show
POST  /verify-email/{id}/{hash}      EmailVerificationController@verify
POST  /email/verification-notification  EmailVerificationController@send
```

---

## Route Naming Convention

### Pattern
```
{resource}.{action}
admin.{resource}.{action}
```

### Examples
```php
route('home')                          // /
route('catalog.index')                 // /catalog
route('catalog.show', $car)            // /catalog/1
route('test-drive.create')             // /test-drive/create
route('orders.show', $order)           // /orders/1

route('admin.dashboard')               // /admin/dashboard
route('admin.cars.index')              // /admin/cars
route('admin.cars.edit', $car)         // /admin/cars/1/edit
route('admin.test-drives.approve', $td) // /admin/test-drives/1/approve
```

---

## Middleware Applied

### Public Routes
- `web` (default) - CSRF, session, cookies

### User Routes
- `auth` - Must be logged in
- `verified` (optional) - Email must be verified

### Admin Routes
- `auth` - Must be logged in
- `admin` - Must have admin role

---

## HTTP Methods

- **GET** - Retrieve/display data
- **POST** - Create new resource
- **PUT/PATCH** - Update existing resource
- **DELETE** - Remove resource

---

## Response Types

### Views (Blade)
Most routes return Blade views:
```php
return view('catalog.index', compact('cars'));
```

### Redirects
After form submissions:
```php
return redirect()->route('admin.cars.index')
    ->with('success', 'Mobil berhasil ditambahkan');
```

### JSON (Optional for API)
Can be added later:
```php
return response()->json(['data' => $cars]);
```

---

## Query Parameters

### Catalog Filtering
```
/catalog?brand=Toyota&category=1&max_price=200000000
/catalog?transmission=automatic&fuel_type=bensin
/catalog?year_min=2018&year_max=2022
```

### Admin Filtering
```
/admin/cars?status=available&category=2
/admin/test-drives?status=pending&date=2024-01-01
/admin/orders?status=pending&search=ORD-123
```

### Pagination
```
/catalog?page=2
/admin/cars?page=3&per_page=20
```

---

## Route Testing

### Test with Artisan
```bash
# List all routes
php artisan route:list

# Filter by name
php artisan route:list --name=admin

# Filter by method
php artisan route:list --method=GET

# Show middleware
php artisan route:list --columns=uri,name,middleware
```

### Test with Browser
1. Start server: `php artisan serve`
2. Visit: `http://localhost:8000`
3. Test each route manually

### Test with Postman/Insomnia
- Import routes as collection
- Test POST/PATCH/DELETE methods
- Include CSRF token for forms

---

## Security Notes

### CSRF Protection
All POST/PUT/PATCH/DELETE routes require CSRF token:
```blade
<form method="POST">
    @csrf
    <!-- form fields -->
</form>
```

### Route Model Binding
Laravel automatically injects models:
```php
Route::get('/cars/{car}', function (Car $car) {
    // $car is already loaded from database
});
```

### Authorization
Check permissions in controllers:
```php
$this->authorize('update', $car);
```

---

**Last Updated**: Project initialization
**Total Routes**: ~30+ routes
**API Version**: N/A (Web routes only)
