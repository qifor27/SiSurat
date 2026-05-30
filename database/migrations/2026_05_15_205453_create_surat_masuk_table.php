<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('surat_masuk', function (Blueprint $table) {
            $table->id();
            $table->string('nomor_agenda', 255)->unique();
            $table->string('nomor_surat',255);
            $table->date('tanggal_surat');
            $table->date('tanggal_diterima');
            $table->string('asal_surat',50);
            $table->string('perihal',500);

            $table->string('jenis_surat',50);
            $table->enum('tingkat_urgensi',['normal','segera','sangat_segera'])
              ->default('normal');

            $table->boolean('is_rahasia')->default(false);

            $table->string('file_path',500)->nullable();

                // Status & alur
            $table->enum('status', [
                'draft',
                'menunggu_warek',
                'menunggu_rektor',
                'selesai',
                'dikembalikan',
            ])->default('draft');
            // Catatan dari reviewer
            $table->text('catatan_warek')->nullable();
            $table->text('catatan_rektor')->nullable();
            // Relasi
            $table->foreignId('dibuat_oleh')
                  ->constrained('users')
                  ->onDelete('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('surat_masuk');
    }
};
