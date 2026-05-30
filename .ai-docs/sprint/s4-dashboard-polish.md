# Sprint 4 (S4) — Dashboard & Polish

**Minggu:** 9–10
**Goal:** Dashboard sederhana, UI konsisten, testing manual, siap UAT klien
**Total:** 7 task · ~12 jam

---

## S4-01: Dashboard Admin — statistik surat masuk

| Item | Detail |
|------|--------|
| **Tags** | Backend, Frontend |
| **Priority** | HIGH |
| **Estimasi** | 2 jam |
| **Dependency** | S3-07 |

**User Story:**
Sebagai Admin, saya ingin melihat ringkasan data agar tahu kondisi surat masuk secara cepat.

**Checklist:**
- [ ] DashboardController: hitung total surat per status
- [ ] Kartu: Surat Masuk Hari Ini, Menunggu Diproses, Menunggu Warek, Selesai Bulan Ini
- [ ] Tabel 5 surat terbaru dengan kolom no. agenda, perihal, status, aksi Lihat
- [ ] Semua angka pakai query Eloquent (bukan COUNT raw SQL)
- [ ] Test data akurat sesuai data di database

---

## S4-02: Dashboard Warek & Rektor — surat perlu ditindak

| Item | Detail |
|------|--------|
| **Tags** | Backend, Frontend |
| **Priority** | HIGH |
| **Estimasi** | 1.5 jam |
| **Dependency** | S4-01 |

**User Story:**
Sebagai Warek/Rektor, saya ingin langsung tahu berapa surat yang perlu saya tindak lanjuti.

**Checklist:**
- [ ] Dashboard Warek: kartu "Surat Perlu Direview" + tabel 5 terbaru
- [ ] Dashboard Rektor: kartu "Surat Perlu Disetujui" + tabel 5 terbaru
- [ ] Highlight kartu dengan warna amber jika ada surat menunggu
- [ ] Tombol "Lihat Semua" arahkan ke daftar surat role tersebut

---

## S4-03: Fitur pencarian & filter sederhana

| Item | Detail |
|------|--------|
| **Tags** | Backend, Frontend |
| **Priority** | MEDIUM |
| **Estimasi** | 2 jam |
| **Dependency** | S4-01 |

**User Story:**
Sebagai Admin, saya ingin bisa mencari surat agar mudah menemukan surat tertentu.

**Checklist:**
- [ ] Form pencarian di atas tabel: input keyword (cari perihal/asal_surat/nomor_surat)
- [ ] Dropdown filter status: Semua, Draft, Menunggu Warek, Menunggu Rektor, Selesai, Dikembalikan
- [ ] Query: `if request has search → SuratMasuk::where("perihal","like","%{search}%")`
- [ ] Pertahankan nilai filter saat halaman diload ulang (prefill input)
- [ ] Pagination tetap berfungsi saat filter aktif

---

## S4-04: Polish UI — konsistensi visual semua halaman

| Item | Detail |
|------|--------|
| **Tags** | Frontend |
| **Priority** | MEDIUM |
| **Estimasi** | 3 jam |
| **Dependency** | S4-03 |

**User Story:**
Sebagai pengguna, saya ingin tampilan yang bersih dan konsisten agar nyaman dipakai sehari-hari.

**Checklist:**
- [ ] Cek semua badge status konsisten warnanya di semua halaman
- [ ] Perbaiki padding/margin yang tidak konsisten
- [ ] Pastikan tabel tidak overflow di layar laptop 13 inch
- [ ] Flash message (sukses/gagal) tampil dengan gaya yang jelas
- [ ] Tombol aksi konsisten: primary=biru, danger=merah, secondary=abu
- [ ] Halaman kosong (tidak ada data): tampilkan pesan "Belum ada surat masuk"

---

## S4-05: Error handling & validasi yang ramah pengguna

| Item | Detail |
|------|--------|
| **Tags** | Backend, Frontend |
| **Priority** | MEDIUM |
| **Estimasi** | 1.5 jam |
| **Dependency** | S4-04 |

**User Story:**
Sebagai pengguna, saya ingin pesan error yang jelas agar tahu apa yang perlu diperbaiki.

**Checklist:**
- [ ] Buat `resources/views/errors/403.blade.php` (akses ditolak)
- [ ] Buat `resources/views/errors/404.blade.php` (halaman tidak ditemukan)
- [ ] Pastikan semua form tampilkan `@error` di bawah setiap input
- [ ] Flash message: `@if(session("success"))` → kotak hijau, `@if(session("error"))` → kotak merah
- [ ] Konfirmasi sebelum hapus: "Yakin ingin menghapus surat ini?"

---

## S4-06: Security checklist & final review

| Item | Detail |
|------|--------|
| **Tags** | Backend |
| **Priority** | HIGH |
| **Estimasi** | 1.5 jam |
| **Dependency** | S4-05 |

**User Story:**
Sebagai developer, saya ingin memastikan sistem aman sebelum dipresentasikan ke klien.

**Checklist:**
- [ ] CSRF token ada di semua form (`@csrf`)
- [ ] Semua route dilindungi middleware `auth`
- [ ] Route per role dilindungi middleware `role:xxx`
- [ ] File surat tidak bisa diakses langsung tanpa login (serve via controller)
- [ ] Validasi semua input di Form Request (tidak ada yang bypass)
- [ ] Cek .env `APP_DEBUG` masih true di development (jangan lupa ubah false di production)

---

## S4-07: Testing final & persiapan UAT klien

| Item | Detail |
|------|--------|
| **Tags** | Testing |
| **Priority** | HIGH |
| **Estimasi** | 2 jam |
| **Dependency** | S4-06 |

**User Story:**
Sebagai PM, saya ingin sistem siap dipresentasikan ke klien dan dosen.

**Checklist:**
- [ ] Login semua 3 role → berhasil masuk ke dashboard yang benar
- [ ] Full flow: Admin input → Warek teruskan → Rektor approve → selesai
- [ ] Full flow: Admin input → Warek kembalikan → Admin revisi → Ajukan ulang
- [ ] Full flow: Rektor approve → disposisi ke 2 bagian → data tersimpan
- [ ] Dashboard semua role menampilkan data akurat
- [ ] Pencarian berfungsi: cari keyword yang ada → tampil, yang tidak ada → kosong
- [ ] Semua halaman tidak ada error PHP di log (`storage/logs/laravel.log`)

---

## Dependency Graph

```
S3-07 → S4-01 → S4-02
              → S4-03 → S4-04 → S4-05 → S4-06 → S4-07
```

## Definition of Done

- [ ] Dashboard semua role akurat
- [ ] Pencarian & filter berfungsi
- [ ] UI konsisten di semua halaman
- [ ] Error handling ramah pengguna
- [ ] Security checklist selesai
- [ ] Full regression test pass
- [ ] Siap presentasi UAT ke klien
