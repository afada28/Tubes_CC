# Quick Start Guide - Ready to Run

Project ini sudah siap pakai dengan semua dependencies dan konfigurasi.

## Langkah Setup Cepat

### 1. Import Database

1. Buka XAMPP/phpMyAdmin
2. Buat database baru: `graha_alfa_amertha`
3. Import file SQL yang disediakan (jika ada), ATAU
4. Jalankan migration:
   ```bash
   php artisan migrate
   ```

### 2. Setup Storage Link

```bash
php artisan storage:link
```

Jika error "link already exists":
```bash
Remove-Item public\storage -Force -Recurse
php artisan storage:link
```

### 3. Jalankan Server

```bash
php artisan serve
```

Buka browser: **http://127.0.0.1:8000**

### 4. Login Admin

1. Klik **"Login dengan Google"**
2. Pilih akun Google Anda
3. Setelah login pertama kali, jalankan:
   ```bash
   php set-admin.php
   ```
4. Logout dan login lagi dengan Google
5. Anda akan masuk ke Dashboard Admin

---

## Konfigurasi yang Sudah Tersedia

Semua konfigurasi di file `.env` sudah siap:

- ✅ **Database**: MySQL (port 3306)
- ✅ **Google OAuth**: Credentials sudah terkonfigurasi
- ✅ **Midtrans Payment**: Sandbox credentials siap pakai
- ✅ **SSL Fix**: Sudah di-bypass untuk Avast Firewall

**PENTING:** Google OAuth dan Midtrans menggunakan credentials yang sudah terdaftar untuk `http://127.0.0.1:8000`. Server HARUS dijalankan di port 8000 (default `php artisan serve`).

---

## Troubleshooting

### Error: Database connection failed

Edit file `.env`:
```env
DB_DATABASE=graha_alfa_amertha  # Pastikan database sudah dibuat
DB_USERNAME=root
DB_PASSWORD=                     # Kosong jika XAMPP default
```

### Error: Storage images tidak muncul (403)

```bash
Remove-Item public\storage -Force -Recurse
php artisan storage:link
```

### Google Login redirect ke login lagi

1. Pastikan server berjalan di port 8000
2. Buka `http://127.0.0.1:8000` (bukan `localhost`)
3. Periksa apakah Avast/Antivirus memblokir SSL

### Dropdown user tidak berfungsi

Hard refresh browser: `Ctrl + Shift + R`

### User bukan admin (403 Unauthorized)

Setelah login pertama:
```bash
php set-admin.php
```

---

## Fitur yang Tersedia

1. **Homepage** - Landing page dengan carousel, about, milestone, dll
2. **Google OAuth Login** - Login cepat dengan akun Google
3. **Admin Dashboard** - Statistik users, subscriptions, revenue, visitors
4. **User Management** - Lihat semua user dan subscription status
5. **Analytics** - Grafik visitor 30 hari terakhir dengan Chart.js
6. **Payment Gateway** - Midtrans Snap untuk subscription (4 paket)
7. **Donation System** - Sistem donasi dengan participant tracking
8. **Volunteer System** - Pendaftaran volunteer dengan approval

---

## Kredensial yang Tersedia

### Admin Login
- Login via **Google OAuth** (any Gmail account)
- Setelah login pertama, jalankan `php set-admin.php`

### Midtrans (Sandbox)
- Server Key: (lihat file .env)
- Client Key: (lihat file .env)
- Mode: Sandbox (test mode)

### Google OAuth
- Sudah terkonfigurasi untuk `http://127.0.0.1:8000`
- Authorized Redirect URI: `http://127.0.0.1:8000/auth/google/callback`

---

## Catatan Penting

⚠️ **Jangan ubah port server!** Google OAuth hanya bekerja di `http://127.0.0.1:8000`

⚠️ **Gunakan Chrome/Edge**, bukan browser lain untuk hasil terbaik

⚠️ **Disable Avast Web Shield** jika Google login atau payment error

---

## Struktur Folder

```
├── app/                    # Laravel application code
├── config/                 # Configuration files
├── database/               # Migrations and seeders
├── public/                 # Public assets (CSS, JS, images)
│   └── storage/           # Symlink ke storage/app/public
├── resources/              # Views and raw assets
├── routes/                 # Route definitions
├── storage/                # Uploaded files and logs
│   └── app/public/        # Public uploaded files
├── vendor/                 # Composer dependencies (INCLUDED)
├── node_modules/           # NPM dependencies (INCLUDED)
├── .env                    # Environment config (INCLUDED)
└── set-admin.php          # Admin user setter script
```

---

## Jika Ada Error

Cek log di: `storage/logs/laravel.log`

Atau hubungi developer.
