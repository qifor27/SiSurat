<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SuratMasuk extends Model
{
    protected $table ='surat_masuk';

    protected $fillable = [
        'nomor_agenda',
        'nomor_surat',
        'tanggal_surat',
        'tanggal_diterima',
        'asal_surat',
        'perihal',
        'jenis_surat',
        'tingkat_urgensi',
        'is_rahasia',
        'file_path',
        'status',
        'catatan_warek',
        'catatan_rektor',
        'dibuat_oleh',
    ];

    protected function casts():  array{
        return [
            'tanggal_surat' => 'date',
            'tanggal_diterima' => 'date',
            'is_rahasia' => 'boolean',
        ];
    }

    public function pembuat()
    {
        return $this->belongsTo(User::class,
        'dibuat_oleh');
    }

    public function scopeDraft($query){
        return $query->where('status','draft');
    }



    public function scopeMenungguWarek($query)
    {
        return $query->where('status','menunggu_warek');
    }



    public function scopeMenungguRektor($query)
    {
        return $query->where('status','menunggu_rektor');
    }

    

    
}
