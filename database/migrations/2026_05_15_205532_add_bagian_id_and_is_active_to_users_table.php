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
        Schema::table('users', function (Blueprint $table) {
               $table->foreignId('bagian_id')
                  ->nullable()
                  ->after('password')
                  ->constrained('bagian')
                  ->onDelete('set null');
            $table->boolean('is_active')
                  ->default(true)
                  ->after('bagian_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
              $table->dropForeign(['bagian_id']);
            $table->dropColumn(['bagian_id', 'is_active']);
        });
    }
};
