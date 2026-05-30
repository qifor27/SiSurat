# Pra-Sprint (S0) — Setup & Fondasi

> **Laravel Version: 13.x** (sesuai composer.json)

**Minggu:** 1–2
**Goal:** Laravel jalan di localhost, login & role aktif, semua tabel siap, seeder berhasil
**Total:** 8 task · ~14 jam

---

## S0-01: Install Laravel 13 & konfigurasi .env

| Item | Detail |
|------|--------|
| **Tags** | Config |
| **Priority** | HIGH |
| **Estimasi** | 1 jam |
| **Dependency** | — |

**User Story:**
Sebagai developer, saya ingin project Laravel terkonfigurasi agar bisa mulai development.

**Deskripsi:**
Install fresh Laravel 13, konfigurasi .env untuk koneksi database MySQL, dan pastikan artisan serve berjalan.

**Checklist:**
- [ ] `composer create-project laravel/laravel sisurat` (Laravel 13)
- [ ] Konfigurasi .env: DB_NAME=sisurat, APP_NAME=SiSurat
- [ ] Buat database MySQL: `CREATE DATABASE sisurat`
- [ ] `php artisan key:generate`
- [ ] Test: `php artisan serve` → buka localhost:8000

---

## S0-02: Install & setup Laravel Breeze (Auth)

> **Catatan:** Proyek sudah di-install. Langkah ini untuk memastikan Breeze terpasang.

| Item | Detail |
|------|--------|
| **Tags** | Config, Backend |
| **Priority** | HIGH |
| **Estimasi** | 1 jam |
| **Dependency** | S0-01 |

**User Story:**
Sebagai developer, saya ingin sistem autentikasi siap pakai agar user bisa login.

**Deskripsi:**
Install Breeze dengan template Blade, jalankan migration auth, setup frontend.

**Checklist:**
- [ ] `composer require laravel/breeze --dev`
- [ ] `php artisan breeze:install blade`
- [ ] `npm install && npm run dev`
- [ ] `php artisan migrate`
- [ ] Test login/logout berfungsi di browser

---

## S0-03: Install Spatie Laravel Permission

| Item | Detail |
|------|--------|
| **Tags** | Config, Backend |
| **Priority** | HIGH |
| **Estimasi** | 1 jam |
| **Dependency** | S0-02 |

**User Story:**
Sebagai developer, saya ingin sistem role & permission agar setiap pengguna punya akses yang berbeda.

**Deskripsi:**
Install Spatie, publish config, tambahkan trait HasRoles ke model User.

**Checklist:**
- [ ] `composer require spatie/laravel-permission`
- [ ] `php artisan vendor:publish --provider="Spatie\Permission\PermissionServiceProvider"`
- [ ] Tambahkan `HasRoles` ke `app/Models/User.php`
- [ ] `php artisan migrate`
- [ ] Cek tabel `roles` & `permissions` ada di database

---

## S0-04: Buat migration tabel bagian & surat_masuk

| Item | Detail |
|------|--------|
| **Tags** | Database |
| **Priority** | HIGH |
| **Estimasi** | 2 jam |
| **Dependency** | S0-03 |

**User Story:**
Sebagai developer, saya ingin tabel database siap agar data bisa disimpan dengan benar.

**Deskripsi:**
Buat 2 migration: tabel bagian (master data), surat_masuk dengan semua kolom lengkap termasuk enum status.

**Checklist:**
- [ ] Buat migration `create_bagian_table` (id, nama_bagian, kode_bagian unique, timestamps)
- [ ] Buat migration `create_surat_masuk_table` dengan semua kolom (nomor_agenda unique, status enum, tingkat_urgensi enum, dibuat_oleh FK)
- [ ] Tambah kolom `bagian_id` & `is_active` ke tabel users
- [ ] `php artisan migrate` → semua tabel terbuat
- [ ] Cek struktur tabel di MySQL client (DBeaver/TablePlus)

---

## S0-05: Buat Model SuratMasuk & Bagian

| Item | Detail |
|------|--------|
| **Tags** | Backend |
| **Priority** | HIGH |
| **Estimasi** | 1.5 jam |
| **Dependency** | S0-04 |

**User Story:**
Sebagai developer, saya ingin model Eloquent agar bisa berinteraksi dengan database.

**Deskripsi:**
Buat model dengan fillable, casts, dan relasi yang benar.

**Checklist:**
- [ ] Buat `app/Models/Bagian.php` dengan fillable
- [ ] Buat `app/Models/SuratMasuk.php` dengan fillable lengkap
- [ ] Tambah casts untuk status (string enum), is_rahasia (boolean), tanggal (date)
- [ ] Tambah relasi: `dibuat()` belongsTo User, `disposisi()` hasMany
- [ ] Tambah scope: `scopeMenungguWarek`, `scopeMenungguRektor`

---

## S0-06: Buat Seeder: roles, permissions, users, bagian

| Item | Detail |
|------|--------|
| **Tags** | Backend |
| **Priority** | HIGH |
| **Estimasi** | 2 jam |
| **Dependency** | S0-03, S0-04 |

**User Story:**
Sebagai developer, saya ingin data dummy tersedia agar bisa test login semua role.

**Deskripsi:**
Buat seeder lengkap untuk roles Spatie, 3 user per role, dan data bagian dummy.

**Checklist:**
- [ ] Buat `RoleSeeder`: buat role admin, wakil_rektor, rektor, bagian_terkait
- [ ] Buat `UserSeeder`: 1 akun per role (email + password berbeda per role)
- [ ] Buat `BagianSeeder`: 4 bagian dummy (BAK, SDM, KEU, UMUM)
- [ ] Daftarkan semua seeder ke `DatabaseSeeder.php`
- [ ] `php artisan db:seed` → test login semua akun

---

## S0-07: Setup middleware & route per role

| Item | Detail |
|------|--------|
| **Tags** | Backend |
| **Priority** | HIGH |
| **Estimasi** | 2 jam |
| **Dependency** | S0-06 |

**User Story:**
Sebagai developer, saya ingin route terlindungi per role agar user tidak bisa akses halaman yang bukan haknya.

**Deskripsi:**
Konfigurasi route group dengan prefix dan middleware role Spatie. Buat redirect setelah login per role.

**Checklist:**
- [ ] Buat route group `admin/` dengan middleware `role:admin`
- [ ] Buat route group `warek/` dengan middleware `role:wakil_rektor`
- [ ] Buat route group `rektor/` dengan middleware `role:rektor`
- [ ] Buat `AuthenticatedSessionController` redirect ke dashboard sesuai role setelah login
- [ ] Test: login admin → ke `/admin/dashboard`, login warek → ke `/warek/dashboard`

---

## S0-08: Buat layout blade & sidebar dinamis

| Item | Detail |
|------|--------|
| **Tags** | Frontend |
| **Priority** | MEDIUM |
| **Estimasi** | 3 jam |
| **Dependency** | S0-07 |

**User Story:**
Sebagai pengguna, saya ingin tampilan yang berbeda per role agar mudah navigasi sesuai tugas saya.

**Deskripsi:**
Buat layout utama dengan sidebar. Isi sidebar berubah tergantung role yang sedang login.

**Checklist:**
- [ ] Buat `resources/views/layouts/app.blade.php` (sidebar + header + content)
- [ ] Buat komponen sidebar yang cek role: `@role("admin")` tampil menu admin `@endrole`
- [ ] Buat halaman dashboard kosong untuk 3 role (admin, warek, rektor)
- [ ] Pastikan logout berfungsi
- [ ] Test: setiap role lihat menu yang berbeda

---

## Dependency Graph

```
S0-01 → S0-02 → S0-03 → S0-04 → S0-05
                              ↘
                          S0-06 → S0-07 → S0-08
```

## Definition of Done

- [ ] `php artisan serve` jalan tanpa error
- [ ] Login dengan 3 akun role berbeda berhasil
- [ ] Semua tabel ada di database (`php artisan migrate`)
- [ ] Seeder berhasil (`php artisan db:seed`)
- [ ] Akses route role lain ditolak (403)
- [ ] Sidebar berbeda tiap role
