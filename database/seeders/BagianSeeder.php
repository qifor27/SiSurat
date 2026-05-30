<?php

namespace Database\Seeders;

use App\Models\Bagian;
use Illuminate\Database\Seeder;

class BagianSeeder extends Seeder
{
    public function run(): void
    {
        $data = [
            ['nama_bagian' => 'Biro Akademik', 'kode_bagian' => 'BAK'],
            ['nama_bagian' => 'Biro Sumber Daya Manusia', 'kode_bagian' => 'SDM'],
            ['nama_bagian' => 'Biro Keuangan', 'kode_bagian' => 'KEU'],
            ['nama_bagian' => 'Biro Umum', 'kode_bagian' => 'UMUM'],
        ];

        foreach ($data as $item) {
            Bagian::updateOrCreate(
                ['kode_bagian' => $item['kode_bagian']],
                ['nama_bagian' => $item['nama_bagian']]
            );
        }
    }
}
