# Roles & Permissions — SiSurat

## Daftar Role

| Role | Label | Redirect Login | Prefix Route |
|------|-------|---------------|-------------|
| `admin` | Administrator | `/admin/dashboard` | `admin/` |
| `wakil_rektor` | Wakil Rektor | `/warek/dashboard` | `warek/` |
| `rektor` | Rektor | `/rektor/dashboard` | `rektor/` |
| `bagian_terkait` | Bagian Terkait | `/bagian/dashboard` | `bagian/` |

---

## Hak Akses per Role

### Admin
- ✅ Input surat masuk (CRUD)
- ✅ Upload file surat
- ✅ Ajukan surat ke Wakil Rektor
- ✅ Edit surat (jika status = draft atau dikembalikan)
- ✅ Lihat semua surat yang dia input
- ✅ Lihat catatan dari Warek/Rektor
- ✅ Manajemen user (CRUD akun)
- ❌ Tidak bisa approve/reject surat
- ❌ Tidak bisa buat disposisi

### Wakil Rektor
- ✅ Lihat surat dengan status `menunggu_warek`
- ✅ Teruskan surat ke Rektor
- ✅ Kembalikan surat ke Admin (catatan WAJIB)
- ✅ Lihat detail surat + file
- ❌ Tidak bisa input surat baru
- ❌ Tidak bisa edit surat
- ❌ Tidak bisa buat disposisi

### Rektor
- ✅ Lihat surat dengan status `menunggu_rektor`
- ✅ Approve surat (status → selesai)
- ✅ Kembalikan surat (catatan WAJIB)
- ✅ Buat disposisi ke bagian terkait
- ✅ Lihat catatan Wakil Rektor
- ❌ Tidak bisa input surat baru
- ❌ Tidak bisa edit surat

### Bagian Terkait (Opsional)
- ✅ Lihat disposisi yang ditujukan ke bagiannya
- ❌ Tidak bisa mengubah apapun pada surat

---

## Middleware yang Digunakan

```php
// routes/web.php

Route::middleware(['auth'])->group(function () {

    // Admin routes
    Route::middleware(['role:admin'])
        ->prefix('admin')
        ->name('admin.')
        ->group(function () { ... });

    // Wakil Rektor routes
    Route::middleware(['role:wakil_rektor'])
        ->prefix('warek')
        ->name('warek.')
        ->group(function () { ... });

    // Rektor routes
    Route::middleware(['role:rektor'])
        ->prefix('rektor')
        ->name('rektor.')
        ->group(function () { ... });
});
```

---

## Akun Seeder (Development)

| Role | Email | Password |
|------|-------|----------|
| Admin | admin@alifah.ac.id | password |
| Wakil Rektor | warek@alifah.ac.id | password |
| Rektor | rektor@alifah.ac.id | password |

> ⚠️ Password hanya untuk development. Di production harus diganti.

---

## Sidebar Menu per Role

### Admin
- Dashboard
- Surat Masuk (index, create)
- Manajemen User

### Wakil Rektor
- Dashboard
- Surat Masuk (review)

### Rektor
- Dashboard
- Surat Masuk (approval)
- Disposisi
