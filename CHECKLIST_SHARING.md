# Checklist File untuk Dibagikan

## ✅ File/Folder yang WAJIB dibagikan:

### Core Laravel Files
- [ ] `app/` - Application code
- [ ] `bootstrap/` - Bootstrap files
- [ ] `config/` - Configuration files
- [ ] `database/` - Migrations & seeders
- [ ] `public/` - Public assets (JS, CSS, images)
- [ ] `resources/` - Views, raw CSS/JS
- [ ] `routes/` - Route definitions
- [ ] `storage/` - Uploaded files (images carousel, about, etc)
- [ ] `artisan` - Artisan CLI
- [ ] `composer.json` - PHP dependencies list
- [ ] `composer.lock` - PHP dependencies lock
- [ ] `package.json` - Node dependencies list
- [ ] `package-lock.json` - Node dependencies lock

### Dependencies (Sudah terinstall)
- [ ] `vendor/` - Composer packages (sudah include)
- [ ] `node_modules/` - NPM packages (sudah include)

### Configuration Files
- [ ] `.env` - Environment config dengan credentials
- [ ] `.env.example` - Template env file
- [ ] `.gitignore` - Git ignore rules

### Custom Files
- [ ] `set-admin.php` - Script untuk set admin user
- [ ] `public/test-callback.php` - Test callback URL
- [ ] `QUICK_START.md` - Panduan cepat
- [ ] `SETUP.md` - Panduan lengkap
- [ ] `README.md` - Project info

### Build Assets (Sudah compiled)
- [ ] `public/build/` - Compiled Vite assets
- [ ] `public/hot` - Vite dev server file

---

## ⚠️ File yang BISA DIABAIKAN (tapi tidak masalah jika dibagikan):

- `storage/logs/laravel.log` - Log file (bisa dihapus dulu)
- `storage/framework/cache/` - Cache files
- `storage/framework/sessions/` - Session files
- `storage/framework/views/` - Compiled views

---

## 🔴 Cara Compress untuk Dibagikan:

### Option 1: ZIP semua folder
```powershell
# Di folder project
Compress-Archive -Path * -DestinationPath GrahaAlfaAmertha.zip
```

### Option 2: ZIP tanpa logs (lebih kecil)
```powershell
# Hapus log dulu
Remove-Item storage\logs\laravel.log -ErrorAction SilentlyContinue

# Buat ZIP
Compress-Archive -Path * -DestinationPath GrahaAlfaAmertha.zip
```

---

## 📦 Ukuran Folder (Estimasi):

- `vendor/` - ~50-100 MB
- `node_modules/` - ~200-300 MB
- `public/build/` - ~5-10 MB
- `storage/app/public/` - Tergantung jumlah gambar
- **Total: ~300-500 MB** (compressed menjadi ~100-150 MB)

---

## 📝 Instruksi untuk Teman Anda:

1. **Extract ZIP** ke folder di komputer
2. Pastikan **XAMPP** terinstall (MySQL & Apache)
3. Buka file **QUICK_START.md**
4. Ikuti 4 langkah:
   - Import/migrate database
   - `php artisan storage:link`
   - `php artisan serve`
   - Login Google → `php set-admin.php`

---

## ⚡ Tips Agar Mudah:

### Buat file database.sql
1. Export database dari phpMyAdmin
2. Taruh di root folder project
3. Tambahkan instruksi import di QUICK_START.md

### Test sebelum dibagikan:
1. Copy folder ke lokasi lain di komputer Anda
2. Coba jalankan dari folder baru
3. Pastikan semua fitur berfungsi

---

## 🎯 Yang Perlu Diberitahu Teman Anda:

⚠️ **PENTING:**
- Server HARUS di port 8000: `php artisan serve`
- Akses via `http://127.0.0.1:8000` (bukan localhost)
- Database name: `graha_alfa_amertha`
- Jika error SSL, disable Avast Web Shield
- Jalankan `php set-admin.php` setelah login pertama

✅ **Fitur Lengkap:**
- Google OAuth Login
- Admin Dashboard dengan statistik
- User Management
- Analytics dengan grafik
- Midtrans Payment (Sandbox)
- Donation & Volunteer System

📧 **Kontak:**
Jika ada error, cek `storage/logs/laravel.log` atau hubungi Anda.
