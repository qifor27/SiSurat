# SiSurat — Agents Configuration

## Identitas Proyek

| Item | Detail |
|------|--------|
| **Nama Sistem** | SiSurat — Sistem Manajemen Surat Masuk & Keluar |
| **Klien** | Universitas Alifah |
| **Developer** | Mahasiswa (proyek perdana dengan klien nyata) |
| **Dosen Pembimbing** | Ada (perlu laporan progress) |
| **Metode** | Sprint (Agile sederhana) |
| **Fokus MVP** | Surat Masuk (surat keluar direkomendasikan tapi bukan prioritas MVP) |

---

## Tech Stack yang WAJIB Digunakan

| Kategori | Teknologi | Versi |
|----------|-----------|-------|
| Framework | Laravel | 13.x |
| PHP | PHP | 8.3+ |
| Database | MySQL | 8.x |
| Auth | Laravel Breeze | Blade template |
| Roles | Spatie Laravel Permission | latest |
| CSS | Tailwind CSS | 4.x |
| Build | Vite | 8.x |
| Font | Plus Jakarta Sans, JetBrains Mono | Google Fonts |

---

## Batasan AI — WAJIB DIPATUHI

### DILARANG:
1. **Jangan mengarang fitur** di luar yang ada di sprint board (`to-do.blade.php`)
2. **Jangan mengubah tech stack** — tetap Laravel 13 + MySQL + Breeze + Spatie
3. **Jangan menambah dependency** tanpa diminta user secara eksplisit
4. **Jangan membuat halaman register** — sistem internal, akun dibuat oleh admin
5. **Jangan menggunakan API/REST** — ini aplikasi Blade server-side rendering
6. **Jangan menulis kode langsung ke file proyek** — tulis di implementation plan dulu (lihat `skills.md`)
7. **Jangan menggunakan raw SQL** — selalu pakai Eloquent ORM
8. **Jangan menggunakan `$guarded`** — selalu pakai `$fillable` di model

### WAJIB:
1. **Baca file spesifikasi** di folder `spesifikasi/` sebelum menulis kode
2. **Ikuti naming convention** yang ada di `spesifikasi/07-naming-conventions.md`
3. **Ikuti folder structure** yang ada di `spesifikasi/06-folder-structure.md`
4. **Ikuti alur status** yang ada di `spesifikasi/04-status-workflow.md`
5. **Gunakan Bahasa Indonesia** untuk penjelasan, Bahasa Inggris untuk kode
6. **Referensi sprint board** — setiap task punya ID (S0-01, S1-01, dst.)

---

## Referensi Wajib Sebelum Coding

Sebelum menulis kode untuk task apapun, AI HARUS membaca file berikut:

| Situasi | File yang harus dibaca |
|---------|----------------------|
| Membuat migration/model | `spesifikasi/02-database-erd.md` |
| Membuat controller/route | `spesifikasi/05-routes-api.md` |
| Mengatur akses per role | `spesifikasi/03-roles-permissions.md` |
| Mengubah status surat | `spesifikasi/04-status-workflow.md` |
| Membuat file baru | `spesifikasi/06-folder-structure.md` |
| Penamaan apapun | `spesifikasi/07-naming-conventions.md` |
| Membuat UI/view | `design.md` + `design/color-palette.md` |

---

## Konteks Penting dari Klien

1. **Sistem ini internal** — hanya pegawai universitas yang punya akun
2. **Akun dibuat oleh admin** — tidak ada self-registration
3. **Alur surat masuk sudah dikonfirmasi klien**: Admin → Wakil Rektor → Rektor → Disposisi
4. **Surat keluar diusulkan** tapi belum dikonfirmasi final oleh klien
5. **Keamanan sudah dipresentasikan ke dosen**: bcrypt, CSRF, Eloquent ORM, Spatie Permission
6. **Format nomor surat keluar**: `{nomor_urut}/{kode_institusi}/{kode_unit}/{bulan_romawi}/{tahun}` — contoh: `025/UN-ALF/BAK/XI/2025`

---

## Repo GitHub Referensi

Repo berikut bisa dijadikan referensi (BUKAN untuk copy-paste):

| Repo | Kegunaan |
|------|----------|
| [laravel-surat-menyurat-v1](https://github.com/404NotFoundIndonesia/laravel-surat-menyurat-v1) | Referensi utama: struktur folder, disposisi, migration |
| [surat_management](https://github.com/qkohst/surat_management) | Referensi struktur MVC AdminLTE |
| [arsip-iahn](https://github.com/harymahayana07/arsip-iahn) | Konteks instansi pendidikan, disposisi |
| [laravel-surat](https://github.com/chabibi212/laravel-surat) | Referensi role & manajemen pegawai |
| [Sistem-Infomasi-Pengarsipan-Surat](https://github.com/aldiariq/Sistem-Infomasi-Pengarsipan-Surat) | Fitur enkripsi file surat |
