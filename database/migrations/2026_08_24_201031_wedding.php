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
        Schema::create('weddings', function (Blueprint $table) {
            $table->id();
            $table->string('slug')->unique(); // andidananda

            // Mempelai Wanita
            $table->string('bride_name');
            $table->string('bride_nickname');
            $table->string('bride_child_order')->nullable(); // "ke-1"
            $table->string('bride_father')->nullable();
            $table->string('bride_mother')->nullable();

            // Mempelai Pria
            $table->string('groom_name');
            $table->string('groom_nickname');
            $table->string('groom_child_order')->nullable();
            $table->string('groom_father')->nullable();
            $table->string('groom_mother')->nullable();

            // Acara
            $table->date('wedding_date');
            $table->string('wedding_date_hijri')->nullable();
            $table->string('wedding_time')->nullable(); // "09.00 WIB s/d Selesai"
            $table->text('location_address')->nullable();
            $table->text('location_map_embed')->nullable(); // src iframe

            // Media
            $table->string('cover_image')->nullable();
            $table->string('couple_photo')->nullable();
            $table->string('audio_file')->nullable();

            // Ayat/doa (kalau mau bisa diedit per undangan)
            $table->text('quote_arabic')->nullable();
            $table->text('quote_translation')->nullable();
            $table->string('quote_source')->nullable();

            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });

        Schema::create('wedding_gift_accounts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('wedding_id')->constrained()->cascadeOnDelete();
            $table->string('bank_name'); // Seabank, DANA, dst
            $table->string('account_number');
            $table->string('account_holder');
            $table->string('logo')->nullable();
            $table->timestamps();
        });

        Schema::create('wedding_love_stories', function (Blueprint $table) {
            $table->id();
            $table->foreignId('wedding_id')->constrained()->cascadeOnDelete();
            $table->unsignedInteger('order')->default(0);
            $table->string('label'); // "AWAL BERTEMU"
            $table->string('title'); // "Pertemuan yang Tidak Kebetulan"
            $table->longText('content'); // paragraf, bisa dipisah \n\n
            $table->timestamps();
        });

        Schema::create('wedding_wishes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('wedding_id')->constrained()->cascadeOnDelete();
            $table->string('name');
            $table->text('message');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
