# Naming Conventions — SiSurat

## Model
- PascalCase, singular
- `SuratMasuk`, `Bagian`, `Disposisi`, `User`

## Controller
- PascalCase + `Controller`
- Dalam subfolder per role
- `Admin\SuratMasukController`
- `WakilRektor\SuratMasukController`
- `Rektor\DisposisiController`

## Migration
- snake_case, prefix timestamp
- `create_surat_masuk_table`
- `add_bagian_id_to_users_table`
- `create_disposisi_bagian_table`

## Tabel Database
- snake_case, Bahasa Indonesia
- `surat_masuk`, `bagian`, `disposisi`, `disposisi_bagian`

## Kolom Database
- snake_case, Bahasa Indonesia
- `nomor_surat`, `tanggal_diterima`, `asal_surat`
- `dibuat_oleh`, `catatan_warek`, `is_rahasia`
- Boolean prefix: `is_` → `is_rahasia`, `is_active`
- Foreign key: `{tabel}_id` → `bagian_id`, `surat_masuk_id`

## Route
- kebab-case untuk URL
- dot-notation untuk name
- `admin/surat-masuk` → `admin.surat-masuk.index`
- `warek/surat-masuk/{id}/teruskan` → `warek.surat-masuk.teruskan`

## View
- kebab-case folder, kebab-case file
- `admin/surat-masuk/index.blade.php`
- `warek/surat-masuk/show.blade.php`
- Blade reference: `admin.surat-masuk.index`

## Form Request
- PascalCase + `Request`
- `StoreSuratMasukRequest`
- `UpdateSuratMasukRequest`

## Seeder
- PascalCase + `Seeder`
- `RoleSeeder`, `UserSeeder`, `BagianSeeder`

## Variable & Method (PHP)
- camelCase
- `$suratMasuk`, `$tingkatUrgensi`
- `index()`, `store()`, `ajukan()`, `teruskan()`, `kembalikan()`

## Enum/Konstanta
- snake_case string value
- `'draft'`, `'menunggu_warek'`, `'menunggu_rektor'`
- `'normal'`, `'segera'`, `'sangat_segera'`
