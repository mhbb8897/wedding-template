<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('weddings', function (Blueprint $table) {
            // 'gold' atau 'maroon' untuk sekarang, tinggal tambah opsi baru nanti
            $table->string('theme')->default('gold')->after('slug');

            // menyimpan array path foto galeri (disimpan sebagai JSON)
            $table->json('gallery_photos')->nullable()->after('couple_photo');
        });
    }

    public function down(): void
    {
        Schema::table('weddings', function (Blueprint $table) {
            $table->dropColumn(['theme', 'gallery_photos']);
        });
    }
};