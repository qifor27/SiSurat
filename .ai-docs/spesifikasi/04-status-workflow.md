# Status Workflow — SiSurat

## Enum Status Surat Masuk

| Status | Label UI | Badge Color | Deskripsi |
|--------|----------|------------|-----------|
| `draft` | Draft | Abu-abu | Baru diinput Admin, belum diajukan |
| `menunggu_warek` | Menunggu Warek | Kuning/Amber | Sudah diajukan, menunggu review Warek |
| `menunggu_rektor` | Menunggu Rektor | Biru | Warek teruskan, menunggu Rektor |
| `selesai` | Selesai | Hijau | Diapprove Rektor |
| `dikembalikan` | Dikembalikan | Merah | Dikembalikan oleh Warek/Rektor |

---

## Diagram Transisi Status

```
            ┌─────────────────────────────────┐
            │                                 │
            ▼                                 │
         [draft] ──ajukan──> [menunggu_warek] ─┤
                                 │            │
                          teruskan│   kembalikan│
                                 ▼            │
                          [menunggu_rektor] ───┤
                                 │            │
                           approve│   kembalikan│
                                 ▼            │
                             [selesai]   [dikembalikan]
                                              │
                                              │ (edit + ajukan ulang)
                                              ▼
                                           [draft] atau langsung
                                           [menunggu_warek]
```

---

## Siapa Bisa Mengubah Status

| Dari | Ke | Dilakukan Oleh | Catatan Wajib? |
|------|----|---------------|---------------|
| `draft` | `menunggu_warek` | Admin | Tidak |
| `menunggu_warek` | `menunggu_rektor` | Wakil Rektor | Opsional |
| `menunggu_warek` | `dikembalikan` | Wakil Rektor | **YA (min 10 karakter)** |
| `menunggu_rektor` | `selesai` | Rektor | Opsional |
| `menunggu_rektor` | `dikembalikan` | Rektor | **YA** |
| `dikembalikan` | `menunggu_warek` | Admin | Tidak (ajukan ulang) |

---

## Validasi per Transisi

### Admin → Ajukan ke Warek
- Status saat ini HARUS `draft` ATAU `dikembalikan`
- Semua field wajib harus terisi
- Method: `PATCH admin/surat-masuk/{id}/ajukan`

### Warek → Teruskan ke Rektor
- Status saat ini HARUS `menunggu_warek`
- Catatan opsional (disimpan di `catatan_warek`)
- Method: `PATCH warek/surat-masuk/{id}/teruskan`

### Warek → Kembalikan
- Status saat ini HARUS `menunggu_warek`
- Catatan WAJIB diisi (validasi: `required|string|min:10`)
- Disimpan di `catatan_warek`
- Method: `PATCH warek/surat-masuk/{id}/kembalikan`

### Rektor → Approve
- Status saat ini HARUS `menunggu_rektor`
- Catatan opsional (disimpan di `catatan_rektor`)
- Method: `PATCH rektor/surat-masuk/{id}/approve`

### Rektor → Kembalikan
- Status saat ini HARUS `menunggu_rektor`
- Catatan WAJIB diisi
- Disimpan di `catatan_rektor`
- Method: `PATCH rektor/surat-masuk/{id}/kembalikan`

---

## Aturan Edit Surat

- Surat HANYA bisa diedit jika status = `draft` ATAU `dikembalikan`
- Setelah diajukan (status ≠ draft/dikembalikan), surat TIDAK bisa diedit
- Surat HANYA bisa dihapus jika status = `draft`
