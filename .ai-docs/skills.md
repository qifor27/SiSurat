# SiSurat — Skills & Workflow Rules

## ATURAN UTAMA: Code-in-Plan Workflow

> **AI TIDAK BOLEH menulis kode langsung ke file proyek.**
> Semua kode WAJIB ditulis di implementation plan terlebih dahulu.
> User yang akan mengetik ulang berdasarkan plan tersebut.

---

## Cara Kerja Workflow

### Langkah 1: User Meminta Task

User akan meminta dengan format seperti:
- "Kerjakan S1-01"
- "Buatkan kode untuk Sprint 1 task 01"
- "Mulai S0-03"

### Langkah 2: AI Membuat Implementation Plan

AI WAJIB membuat kode dalam format implementation plan berikut:

```
### S1-01: Buat SuratMasukController (Admin) — CRUD

**Sprint:** Sprint 1 — CRUD Surat Masuk
**Estimasi:** 2 jam
**Dependency:** S0-08 (layout blade & sidebar)
**Priority:** HIGH

---

#### Daftar File

| # | File | Aksi | Path Lengkap |
|---|------|------|-------------|
| 1 | SuratMasukController.php | NEW | `app/Http/Controllers/Admin/SuratMasukController.php` |
| 2 | web.php | MODIFY | `routes/web.php` |

---

#### File 1: SuratMasukController.php [NEW]

**Path:** `app/Http/Controllers/Admin/SuratMasukController.php`

\```php
<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
// ... kode LENGKAP di sini, BUKAN snippet ...

\```

**Penjelasan per bagian:**
- **Baris 1-8:** Namespace dan import class yang diperlukan
- **Baris 10-15:** Method `index()` — mengambil semua surat masuk milik user yang login, paginate 10 per halaman
- **Baris 17-22:** Method `create()` — menampilkan form tambah surat baru
- ... dst untuk setiap method

---

#### File 2: web.php [MODIFY]

**Path:** `routes/web.php`

\```diff
  Route::middleware(['auth'])->group(function () {
+     Route::middleware(['role:admin'])->prefix('admin')->name('admin.')->group(function () {
+         Route::resource('surat-masuk', Admin\SuratMasukController::class);
+     });
  });
\```

**Penjelasan:**
- Menambahkan route resource di dalam group middleware `role:admin`
- Semua route akan memiliki prefix `/admin/` dan name `admin.surat-masuk.*`

---

#### Cara Mengetik

1. Buat folder `app/Http/Controllers/Admin/` jika belum ada
2. Buat file baru `SuratMasukController.php` di folder tersebut
3. Copy-paste kode dari File 1 di atas
4. Buka `routes/web.php`
5. Tambahkan baris yang ditandai `+` di diff File 2
6. Simpan kedua file

#### Command yang Perlu Dijalankan

\```bash
php artisan route:list --path=admin
\```

#### Test yang Harus Dilakukan

- [ ] Buka `http://localhost:8000/admin/surat-masuk` → halaman index tampil
- [ ] Buka `http://localhost:8000/admin/surat-masuk/create` → form tampil
- [ ] Isi form → klik Simpan → data tersimpan di database
- [ ] Cek database: tabel `surat_masuk` ada data baru

#### Checklist dari Sprint Board

- [ ] Method index(): query semua surat_masuk user ini, paginate(10)
- [ ] Method create(): return view form tambah surat
- [ ] Method store(): validasi + simpan + handle upload file
- [ ] Method show(): tampilkan detail surat
- [ ] Method edit() & update(): form edit surat (hanya jika status = draft)
```

---

## Aturan Konten Implementation Plan

### WAJIB ada di setiap step:

1. **Header** — ID task, judul, sprint, estimasi, dependency, priority
2. **Daftar file** — tabel semua file yang dibuat/diubah dengan path lengkap
3. **Kode LENGKAP** — bukan snippet atau potongan, tapi kode yang siap di-copy-paste
4. **Format diff** — untuk file yang dimodifikasi, gunakan format `+` (tambah) dan `-` (hapus)
5. **Penjelasan per bagian** — jelaskan KENAPA kode ditulis seperti itu, bukan hanya APA yang dilakukan
6. **Cara mengetik** — instruksi langkah-langkah copy-paste untuk user
7. **Command** — perintah terminal yang perlu dijalankan (jika ada)
8. **Test** — checklist test yang harus dilakukan setelah selesai
9. **Checklist sprint board** — salin checklist dari sprint board (`to-do.blade.php`)

### DILARANG:

1. **Jangan tulis snippet** — selalu kode lengkap dari awal file sampai akhir
2. **Jangan skip penjelasan** — user adalah mahasiswa, butuh memahami setiap baris
3. **Jangan gabung banyak step** — 1 implementation plan = 1 step (S0-01, S1-01, dst.)
4. **Jangan asumsikan kode sebelumnya** — selalu referensikan step dependency-nya

---

## Urutan Dependency

AI WAJIB mengerjakan task sesuai urutan dependency di sprint board.

### Pra-Sprint (S0)
```
S0-01 → S0-02 → S0-03 → S0-04 → S0-05
                              ↘
                          S0-06 → S0-07 → S0-08
```

### Sprint 1 (S1)
```
S0-08 → S1-01 → S1-02 → S1-03
              → S1-04
              → S1-05 → S1-06 → S1-07 → S1-08
              → S1-09
```

### Sprint 2 (S2)
```
S1-07 → S2-01 → S2-02 → S2-03 → S2-06
                       → S2-04 → S2-05 → S2-06 → S2-07
```

### Sprint 3 (S3)
```
S2-07 → S3-01 → S3-02 → S3-04 → S3-05
              → S3-03          → S3-06 → S3-07
```

### Sprint 4 (S4)
```
S3-07 → S4-01 → S4-02
              → S4-03 → S4-04 → S4-05 → S4-06 → S4-07
```

---

## Shortcut Commands

User bisa mengetik shortcut berikut:

| Command | Aksi |
|---------|------|
| `kerjakan S0-01` | Buat implementation plan untuk step S0-01 |
| `kerjakan S1-01 sampai S1-03` | Buat plan untuk S1-01, S1-02, dan S1-03 berurutan |
| `lanjut` | Kerjakan step berikutnya sesuai dependency |
| `review S0-01` | Review kode yang sudah diketik user untuk step S0-01 |
| `jelaskan S1-03` | Jelaskan apa yang dilakukan step S1-03 tanpa menulis kode |
| `status` | Tampilkan progress sprint saat ini |

---

## Standar Kode

### Arsitektur
- **Thin Controller** — logika bisnis di Service class atau Model
- **Form Request** — untuk semua validasi input
- **Resource Route** — `Route::resource()` untuk CRUD
- **View per role** — `views/admin/`, `views/warek/`, `views/rektor/`

### Keamanan
- Selalu gunakan `@csrf` di form
- Validasi semua input via Form Request
- File upload: validasi `mimes` dan `max` size
- Gunakan `$fillable` di model (BUKAN `$guarded`)
- Gunakan middleware `role:xxx` dari Spatie
- Hindari raw query — selalu Eloquent

### Bahasa
- **Penjelasan**: Bahasa Indonesia
- **Variabel/fungsi/komentar kode**: Bahasa Inggris
- **Nama tabel database**: Bahasa Indonesia (snake_case): `surat_masuk`, `bagian`
- **Nama kolom**: Bahasa Indonesia (snake_case): `nomor_surat`, `tanggal_diterima`
