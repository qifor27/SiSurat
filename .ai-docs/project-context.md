# SiSurat — Project Context

## Ringkasan

**SiSurat** adalah Sistem Manajemen Surat Masuk & Keluar untuk **Universitas Alifah**.
Proyek ini dikerjakan oleh mahasiswa sebagai proyek perdana dengan klien nyata.

---

## Alur Surat Masuk (Dikonfirmasi Klien)

```
Admin Input Surat
    ↓
Wakil Rektor Review
    ├── Teruskan → Rektor
    └── Kembalikan (+ catatan wajib) → Admin revisi
        ↓
Rektor
    ├── Approve → Status: Selesai
    ├── Kembalikan (+ catatan wajib) → Admin/Warek
    └── Disposisi → Bagian Terkait
```

## Status Surat Masuk

```
draft → menunggu_warek → menunggu_rektor → selesai
                                        ↘ dikembalikan
```

---

## Alur Surat Keluar (Diusulkan, Belum Final)

```
Bagian/Admin Buat Draft
    → Admin Verifikasi
        → Warek Review
            → Rektor Approve
                → Nomor Surat Otomatis
                    → Admin Kirim & Arsip
```

Format nomor: `{urut}/{UN-ALF}/{kode_unit}/{bulan_romawi}/{tahun}`
Contoh: `025/UN-ALF/BAK/XI/2025`

---

## Role Pengguna

| Role | Tugas Utama |
|------|------------|
| Admin | Input surat masuk, upload file, ajukan ke Warek, CRUD user |
| Wakil Rektor | Review surat, teruskan/kembalikan dengan catatan |
| Rektor | Approve final, disposisi ke bagian terkait |
| Bagian Terkait | Menerima disposisi (opsional — belum dikonfirmasi login) |

---

## Sprint Plan (dari Sprint Board)

| Sprint | Minggu | Fokus | Task |
|--------|--------|-------|------|
| Pra-Sprint (S0) | 1-2 | Setup, DB, Auth, Role, Layout | 8 task |
| Sprint 1 (S1) | 3-4 | CRUD Surat Masuk Admin | 9 task |
| Sprint 2 (S2) | 5-6 | Review Wakil Rektor | 7 task |
| Sprint 3 (S3) | 7-8 | Approve Rektor + Disposisi | 7 task |
| Sprint 4 (S4) | 9-10 | Dashboard + Polish + UAT | 7 task |

**Total: 38 task, ~10 minggu**

---

## Keputusan Penting

1. **Tidak ada halaman register** — sistem internal, akun dibuat admin
2. **MVP fokus surat masuk** — surat keluar adalah fitur tambahan
3. **Laravel Breeze (Blade)** — bukan API/SPA
4. **Spatie Permission** — untuk role-based access
5. **File upload** — PDF/JPG/PNG, max 5MB, simpan di storage
6. **Keamanan** — bcrypt, CSRF, Eloquent ORM, middleware role
