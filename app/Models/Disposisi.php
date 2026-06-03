<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Disposisi extends Model
{
    protected $table = 'disposisi';

    protected $fillable = [
        'surat_masuk_id',
        'dibuat_oleh',
        'intruksi',
        'catatan',
    ];

    /**
     * Relasi: Disposisi milik satu Surat Masuk
     */

    public function suratMasuk()
    {
        return $this->belongsTo(SuratMasuk::class);
    }

    /**
     * Relasi: Disposisi dibuat oleh satu user (Rektor)
     */

    public function pembuat()
    {
        return $this->belongsTo(User::class,'dibuat_oleh');
    }

    /**
     * Relasi: Disposisi ditujukan ke banyak bagian (pivot)
     */
    public function bagians()
    {
        return $this->belongsToMany(Bagian::class,'disposisi_bagian');
    }

    
}
