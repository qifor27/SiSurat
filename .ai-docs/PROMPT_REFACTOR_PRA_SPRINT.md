# PROMPT: Refactor Pra-Sprint siSurat ke Standar Backend Indonesia/Dunia

> Simpan di: `e:\laravel\siSurat\.ai-docs\PROMPT_REFACTOR_PRA_SPRINT.md`
> Gunakan di: Gemini 2.5 Pro (High) / Claude / ChatGPT GPT-4o

---

## 📋 KONTEKS PROYEK

Saya sedang membangun **siSurat** — Sistem Informasi Surat Masuk Internal Kampus berbasis **Laravel 13** + **PHP 8.5** + **Spatie Laravel Permission** + **Laravel Breeze** (Blade/Tailwind).

Roles yang ada: `admin`, `wakil_rektor`, `rektor`, `bagian_terkait`

Saya telah menyelesaikan **Pra-Sprint Batch 1 & 2 (S0-01 s/d S0-08)** yang mencakup:
- Migrasi tabel: `users`, `bagian`, `surat_masuk`
- Model: `User`, `Bagian`, `SuratMasuk`
- Seeder: `BagianSeeder`, `RoleSeeder`, `UserSeeder`
- Route per role dengan Spatie middleware
- Redirect login dinamis berdasarkan role
- Layout & navigasi dinamis dengan `@role` directive

**Masalah yang ditemukan pada kode saat ini:**

1. **Route `web.php`** — logic langsung di closure, bukan di Controller
2. **View `dashboard.blade.php`** — satu view dipakai semua role, data role di-hardcode dari route
3. **`AuthenticatedSessionController`** — redirect role pakai if-else manual, tidak scalable
4. **Tidak ada** `verified` middleware
5. **Tidak ada** proper `403 handler` page
6. **Tidak ada** struktur folder view per role (`admin/`, `rektor/`, dll)
7. **Seeder** menggunakan `User::create()` yang akan error jika dijalankan lebih dari sekali

---

## 🎯 TUGAS YANG DIMINTA

Refactor **seluruh kode Pra-Sprint Batch 1 & 2** mengikuti standar backend Laravel modern yang dipakai di sistem informasi kampus Indonesia (SIMAK UI, SIS Binus, Siakad Unair, dll) dan standar Laravel enterprise global.

---

## ✅ STANDAR YANG HARUS DIPENUHI

### 1. Struktur Route (`routes/web.php`)
- Semua route WAJIB mengarah ke **Controller method**, bukan closure
- Gunakan `verified` middleware di semua route yang memerlukan auth
- Tidak ada logic apapun di dalam file route

### 2. Struktur Controller
- Buat **Controller terpisah per role** di subfolder:
  - `app/Http/Controllers/Admin/DashboardController.php`
  - `app/Http/Controllers/Rektor/DashboardController.php`
  - `app/Http/Controllers/WakilRektor/DashboardController.php`
  - `app/Http/Controllers/Bagian/DashboardController.php`
- Setiap controller `index()` hanya mengembalikan view dengan data dari `auth()->user()`
- Tidak ada hardcode string role di controller

### 3. Struktur View
- Pisahkan view per role dalam subfolder:
  - `resources/views/admin/dashboard.blade.php`
  - `resources/views/rektor/dashboard.blade.php`
  - `resources/views/warek/dashboard.blade.php`
  - `resources/views/bagian/dashboard.blade.php`
- Tidak ada view generik yang menerima variabel `role` sebagai string

### 4. Redirect Setelah Login
- Buat **helper method** `getHomeRoute()` di `User` model menggunakan Spatie
- Tidak menggunakan if-else manual di `AuthenticatedSessionController` untuk setiap role baru

### 5. Seeder (Idempoten)
- Semua seeder harus menggunakan `firstOrCreate()` atau `updateOrCreate()`, BUKAN `create()`

### 6. Error Page 403
- Buat `resources/views/errors/403.blade.php` yang informatif

### 7. Model (`User.php`)
- Tambahkan `getHomeRoute()` method
- Pastikan relasi `bagian()` ada jika kolom `bagian_id` ada di tabel users
