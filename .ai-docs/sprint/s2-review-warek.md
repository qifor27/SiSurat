# Sprint 2 (S2) — Review Wakil Rektor

**Minggu:** 5–6
**Goal:** Warek bisa teruskan atau kembalikan surat dengan catatan
**Total:** 7 task · ~12 jam

---

## S2-01: Buat WakilRektorController — daftar surat menunggu review

| Item | Detail |
|------|--------|
| **Tags** | Backend |
| **Priority** | HIGH |
| **Estimasi** | 1.5 jam |
| **Dependency** | S1-07 |

**User Story:**
Sebagai Wakil Rektor, saya ingin melihat daftar surat yang perlu saya review agar tidak ada yang terlewat.

**Deskripsi:**
Controller Wakil Rektor hanya tampilkan surat dengan status menunggu_warek.

**Checklist:**
- [ ] Buat `app/Http/Controllers/WakilRektor/SuratMasukController.php`
- [ ] Method `index()`: `SuratMasuk::where("status","menunggu_warek")->paginate(10)`
- [ ] Method `show()`: tampilkan detail + tombol aksi Warek
- [ ] Daftarkan route di group `warek/` di web.php
- [ ] Test: login Warek → hanya lihat surat menunggu_warek

---

## S2-02: View: Daftar & detail surat untuk Wakil Rektor

| Item | Detail |
|------|--------|
| **Tags** | Frontend |
| **Priority** | HIGH |
| **Estimasi** | 2 jam |
| **Dependency** | S2-01 |

**User Story:**
Sebagai Wakil Rektor, saya ingin tampilan yang jelas agar mudah membaca isi surat sebelum memutuskan.

**Deskripsi:**
Reuse view detail yang sudah ada dari Sprint 1. Tambahkan panel aksi khusus Warek.

**Checklist:**
- [ ] Buat `resources/views/warek/surat-masuk/index.blade.php` (tabel sederhana)
- [ ] Reuse `views/surat-masuk/show.blade.php` untuk detail
- [ ] Tambah panel "Tindakan Anda" di halaman detail surat (hanya jika role = warek)
- [ ] Panel berisi: textarea catatan, tombol Teruskan ke Rektor, tombol Kembalikan
- [ ] Catatan WAJIB diisi jika klik Kembalikan (validasi client-side)

---

## S2-03: Action: Warek teruskan surat ke Rektor

| Item | Detail |
|------|--------|
| **Tags** | Backend |
| **Priority** | HIGH |
| **Estimasi** | 1 jam |
| **Dependency** | S2-02 |

**User Story:**
Sebagai Wakil Rektor, saya ingin meneruskan surat ke Rektor setelah saya review dan setuju.

**Deskripsi:**
Method teruskan(). Update status ke menunggu_rektor. Simpan catatan warek jika ada.

**Checklist:**
- [ ] Tambah route `PATCH warek/surat-masuk/{id}/teruskan`
- [ ] Tambah method `teruskan()` di WakilRektorController
- [ ] Validasi: surat harus status `menunggu_warek`
- [ ] Update: status = `menunggu_rektor`, catatan_warek = input catatan (nullable)
- [ ] Flash message: "Surat diteruskan ke Rektor"
- [ ] Redirect ke daftar surat Warek

---

## S2-04: Action: Warek kembalikan surat ke Admin

| Item | Detail |
|------|--------|
| **Tags** | Backend |
| **Priority** | HIGH |
| **Estimasi** | 1 jam |
| **Dependency** | S2-02 |

**User Story:**
Sebagai Wakil Rektor, saya ingin mengembalikan surat ke Admin jika ada yang perlu diperbaiki.

**Deskripsi:**
Method kembalikan(). Catatan WAJIB diisi. Update status ke dikembalikan.

**Checklist:**
- [ ] Tambah route `PATCH warek/surat-masuk/{id}/kembalikan`
- [ ] Tambah method `kembalikan()` di WakilRektorController
- [ ] Validasi: catatan WAJIB diisi (`required|string|min:10`)
- [ ] Update: status = `dikembalikan`, catatan_warek = catatan
- [ ] Flash message: "Surat dikembalikan ke Admin dengan catatan"
- [ ] Test: Admin login → surat muncul di daftar dengan status dikembalikan

---

## S2-05: Handling surat dikembalikan: Admin bisa edit & ajukan ulang

| Item | Detail |
|------|--------|
| **Tags** | Backend, Frontend |
| **Priority** | HIGH |
| **Estimasi** | 1.5 jam |
| **Dependency** | S2-04 |

**User Story:**
Sebagai Admin, saya ingin bisa memperbaiki surat yang dikembalikan dan mengajukan ulang.

**Deskripsi:**
Tampilkan catatan Warek di halaman detail Admin. Ijinkan edit jika status = dikembalikan. Tambah tombol "Ajukan Ulang".

**Checklist:**
- [ ] Di halaman detail Admin: tampilkan catatan_warek jika status = dikembalikan
- [ ] Tombol Edit dan Ajukan Ulang muncul jika status = draft atau dikembalikan
- [ ] Method `ajukan()` ubah: cek status = draft OR dikembalikan
- [ ] Flash message berbeda: "Surat berhasil diajukan ulang ke Wakil Rektor"
- [ ] Test alur penuh: Admin ajukan → Warek kembalikan → Admin lihat catatan → Admin edit → Ajukan ulang

---

## S2-06: Update view detail: tampilkan catatan per role

| Item | Detail |
|------|--------|
| **Tags** | Frontend |
| **Priority** | MEDIUM |
| **Estimasi** | 1 jam |
| **Dependency** | S2-03, S2-04 |

**User Story:**
Sebagai semua role, saya ingin melihat catatan dari setiap tahap agar tahu riwayat surat.

**Deskripsi:**
Update halaman detail untuk menampilkan catatan_warek dan catatan_rektor secara kondisional.

**Checklist:**
- [ ] Jika catatan_warek ada → tampilkan kotak "Catatan Wakil Rektor" dengan teks catatan
- [ ] Jika catatan_rektor ada → tampilkan kotak "Catatan Rektor" dengan teks catatan
- [ ] Styling kotak catatan berbeda per role (warna berbeda)
- [ ] Kotak catatan tidak tampil jika kosong/null
- [ ] Test: surat yang sudah punya catatan warek → catatan muncul di detail

---

## S2-07: Testing manual Sprint 2 — alur Wakil Rektor

| Item | Detail |
|------|--------|
| **Tags** | Testing |
| **Priority** | HIGH |
| **Estimasi** | 2 jam |
| **Dependency** | S2-06 |

**User Story:**
Sebagai QA, saya ingin memastikan alur review Warek berjalan benar sebelum lanjut ke Sprint 3.

**Deskripsi:**
Test lengkap alur Admin → Warek (teruskan dan kembalikan).

**Checklist:**
- [ ] Login Admin → input surat → ajukan ke Warek
- [ ] Login Warek → lihat surat di daftar
- [ ] Warek klik Teruskan → cek status berubah ke `menunggu_rektor`
- [ ] Login Admin → surat sudah tidak bisa diedit (status bukan draft/dikembalikan)
- [ ] Login Warek → input surat baru → ajukan, Warek klik Kembalikan TANPA catatan → error
- [ ] Warek isi catatan → klik Kembalikan → berhasil
- [ ] Login Admin → lihat catatan Warek di detail → edit → ajukan ulang

---

## Dependency Graph

```
S1-07 → S2-01 → S2-02 → S2-03 → S2-06
                       → S2-04 → S2-05
                                   ↘ S2-06 → S2-07
```

## Definition of Done

- [ ] Warek hanya lihat surat status menunggu_warek
- [ ] Warek bisa teruskan ke Rektor
- [ ] Warek bisa kembalikan + catatan wajib diisi
- [ ] Status surat berubah otomatis
- [ ] Catatan Warek tampil di detail surat
