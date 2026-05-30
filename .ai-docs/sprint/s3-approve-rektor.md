# Sprint 3 (S3) — Approve Rektor + Disposisi

**Minggu:** 7–8
**Goal:** Rektor approve surat, disposisi ke bagian terkait, alur end-to-end selesai
**Total:** 7 task · ~12 jam

---

## S3-01: Buat RektorController — daftar surat menunggu persetujuan

| Item | Detail |
|------|--------|
| **Tags** | Backend |
| **Priority** | HIGH |
| **Estimasi** | 1.5 jam |
| **Dependency** | S2-07 |

**User Story:**
Sebagai Rektor, saya ingin melihat surat yang perlu saya setujui agar tidak ada yang tertunda.

**Checklist:**
- [ ] Buat `app/Http/Controllers/Rektor/SuratMasukController.php`
- [ ] Method `index()`: `SuratMasuk::where("status","menunggu_rektor")->paginate(10)`
- [ ] Method `show()`: tampilkan detail + catatan_warek + panel aksi Rektor
- [ ] Daftarkan route di group `rektor/` di web.php
- [ ] Test: login Rektor → hanya lihat surat menunggu_rektor

---

## S3-02: Action: Rektor approve surat → status selesai

| Item | Detail |
|------|--------|
| **Tags** | Backend |
| **Priority** | HIGH |
| **Estimasi** | 1 jam |
| **Dependency** | S3-01 |

**User Story:**
Sebagai Rektor, saya ingin menyetujui surat yang sudah direview Warek agar prosesnya selesai.

**Checklist:**
- [ ] Tambah route `PATCH rektor/surat-masuk/{id}/approve`
- [ ] Tambah method `approve()` di RektorController
- [ ] Validasi: surat harus status `menunggu_rektor`
- [ ] Update: status = `selesai`, catatan_rektor = catatan (nullable)
- [ ] Flash message: "Surat telah disetujui"
- [ ] Redirect ke daftar surat Rektor

---

## S3-03: Action: Rektor kembalikan surat

| Item | Detail |
|------|--------|
| **Tags** | Backend |
| **Priority** | MEDIUM |
| **Estimasi** | 1 jam |
| **Dependency** | S3-01 |

**User Story:**
Sebagai Rektor, saya ingin bisa mengembalikan surat jika ada yang perlu dikoreksi lebih lanjut.

**Checklist:**
- [ ] Tambah route `PATCH rektor/surat-masuk/{id}/kembalikan`
- [ ] Method `kembalikan()`: validasi catatan wajib, update status = `dikembalikan` & catatan_rektor
- [ ] Flash message: "Surat dikembalikan"
- [ ] Test: Admin lihat surat dikembalikan dari Rektor + catatan muncul

---

## S3-04: View: Halaman panel aksi Rektor

| Item | Detail |
|------|--------|
| **Tags** | Frontend |
| **Priority** | HIGH |
| **Estimasi** | 1.5 jam |
| **Dependency** | S3-02 |

**User Story:**
Sebagai Rektor, saya ingin tampilan aksi yang jelas dan tidak bisa salah klik.

**Checklist:**
- [ ] Tambah panel aksi di show.blade.php (hanya jika role = rektor dan status = menunggu_rektor)
- [ ] Tombol "Setujui Surat" → hijau, konfirmasi dialog sebelum submit
- [ ] Tombol "Kembalikan Surat" → merah, expand textarea catatan
- [ ] Catatan Rektor required jika klik Kembalikan
- [ ] Tampilkan catatan_warek di panel Rektor agar Rektor tahu konteks review Warek

---

## S3-05: Disposisi sederhana: Rektor pilih bagian terkait

| Item | Detail |
|------|--------|
| **Tags** | Backend, Frontend |
| **Priority** | HIGH |
| **Estimasi** | 2.5 jam |
| **Dependency** | S3-04 |

**User Story:**
Sebagai Rektor, saya ingin mendisposisikan surat ke bagian yang relevan agar ditindaklanjuti.

**Checklist:**
- [ ] Migration `disposisi` & `disposisi_bagian` (jika belum ada)
- [ ] Model Disposisi dengan relasi `belongsToMany Bagian`
- [ ] Di halaman detail (status = selesai): tampilkan form disposisi
- [ ] Form: checkbox multi-bagian (dari tabel bagian), textarea instruksi
- [ ] Method `storeDisposisi()`: simpan ke disposisi + attach ke disposisi_bagian
- [ ] Tampilkan daftar disposisi yang sudah dibuat di halaman detail

---

## S3-06: Update timeline status di halaman detail

| Item | Detail |
|------|--------|
| **Tags** | Frontend |
| **Priority** | MEDIUM |
| **Estimasi** | 1.5 jam |
| **Dependency** | S3-04 |

**User Story:**
Sebagai semua pengguna, saya ingin melihat riwayat status surat agar tahu sudah sampai mana prosesnya.

**Checklist:**
- [ ] Buat komponen timeline di show.blade.php
- [ ] Langkah: Draft → Menunggu Warek → Menunggu Rektor → Selesai
- [ ] Warna: hijau = sudah lewat, abu = belum, kuning = sedang di sini
- [ ] Jika dikembalikan: tampilkan langkah "Dikembalikan" dengan warna merah
- [ ] Test: buka surat berbeda status → timeline sesuai

---

## S3-07: Testing manual Sprint 3 — alur penuh end-to-end

| Item | Detail |
|------|--------|
| **Tags** | Testing |
| **Priority** | HIGH |
| **Estimasi** | 2 jam |
| **Dependency** | S3-06 |

**User Story:**
Sebagai QA, saya ingin memastikan alur penuh dari Admin sampai Rektor approve berjalan tanpa error.

**Checklist:**
- [ ] Login Admin → input surat → ajukan ke Warek
- [ ] Login Warek → teruskan ke Rektor
- [ ] Login Rektor → lihat catatan Warek → approve → status = selesai
- [ ] Cek semua role tidak bisa akses route role lain
- [ ] Test Rektor kembalikan surat → catatan muncul → Admin revisi → ajukan ulang
- [ ] Test disposisi: Rektor approve → isi form disposisi → data tersimpan di database
- [ ] Cek timeline status tampil benar di setiap langkah

---

## Dependency Graph

```
S2-07 → S3-01 → S3-02 → S3-04 → S3-05
              → S3-03          → S3-06 → S3-07
```

## Definition of Done

- [ ] Rektor hanya lihat surat menunggu_rektor
- [ ] Rektor bisa approve → status selesai
- [ ] Rektor bisa disposisi ke bagian terkait
- [ ] Alur penuh end-to-end jalan tanpa error
- [ ] Timeline status tampil di halaman detail
