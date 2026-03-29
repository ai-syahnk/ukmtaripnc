<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->foreignId('tari_id')->constrained('tari')->cascadeOnDelete();
            $table->string('nama_pemesan');
            $table->text('alamat_pentas');
            $table->string('no_telp', 30);
            $table->date('tanggal_tampil');
            $table->text('catatan')->nullable();
            $table->unsignedTinyInteger('jumlah_penari');
            $table->decimal('harga_per_penari', 15, 2);
            $table->decimal('total_harga', 15, 2);
            $table->string('status', 30)->default('pending');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bookings');
    }
};
