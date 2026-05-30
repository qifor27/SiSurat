# Folder Structure — SiSurat

## Konvensi Lokasi File

### Controllers (per role)
```
app/Http/Controllers/
├── Admin/
│   ├── DashboardController.php
│   ├── SuratMasukController.php
│   └── UserController.php          (manajemen user)
├── WakilRektor/
│   ├── DashboardController.php
│   └── SuratMasukController.php
├── Rektor/
│   ├── DashboardController.php
│   ├── SuratMasukController.php
│   └── DisposisiController.php
└── Controller.php                   (base)
```

### Models
```
app/Models/
├── User.php
├── Bagian.php
├── SuratMasuk.php
└── Disposisi.php                    (Sprint 3)
```

### Form Requests
```
app/Http/Requests/
├── StoreSuratMasukRequest.php
├── UpdateSuratMasukRequest.php
└── StoreDisposisiRequest.php        (Sprint 3)
```

### Views (per role)
```
resources/views/
├── layouts/
│   └── app.blade.php               (layout utama + sidebar)
├── components/
│   ├── sidebar.blade.php
│   ├── status-badge.blade.php
│   └── timeline.blade.php
├── admin/
│   ├── dashboard.blade.php
│   └── surat-masuk/
│       ├── index.blade.php
│       ├── create.blade.php
│       ├── edit.blade.php
│       └── show.blade.php
├── warek/
│   ├── dashboard.blade.php
│   └── surat-masuk/
│       ├── index.blade.php
│       └── show.blade.php
├── rektor/
│   ├── dashboard.blade.php
│   └── surat-masuk/
│       ├── index.blade.php
│       └── show.blade.php
├── errors/
│   ├── 403.blade.php
│   └── 404.blade.php
└── auth/
    └── login.blade.php              (dari Breeze)
```

### Migrations
```
database/migrations/
├── 0001_01_01_000000_create_users_table.php     (bawaan)
├── 0001_01_01_000001_create_cache_table.php     (bawaan)
├── 0001_01_01_000002_create_jobs_table.php      (bawaan)
├── xxxx_create_bagian_table.php                  (S0-04)
├── xxxx_create_surat_masuk_table.php             (S0-04)
├── xxxx_add_bagian_id_to_users_table.php         (S0-04)
├── xxxx_create_disposisi_table.php               (S3-05)
└── xxxx_create_disposisi_bagian_table.php        (S3-05)
```

### Seeders
```
database/seeders/
├── DatabaseSeeder.php
├── RoleSeeder.php                    (S0-06)
├── UserSeeder.php                    (S0-06)
└── BagianSeeder.php                  (S0-06)
```

### Storage (File Upload)
```
storage/app/public/
└── surat-masuk/
    └── *.pdf, *.jpg, *.png          (file yang diupload)
```

> Jalankan `php artisan storage:link` agar bisa diakses via URL
