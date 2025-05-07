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
        Schema::create('orderan_masuks', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pengantaran_id')->constrained('pengantarans')->cascadeOnDelete();

            $table->integer('total_harga');
            $table->integer('biaya_tambahan')->default(0);

            $table->enum('jenis_pembayaran', ['Cash', 'Transfer']);
            $table->string('bukti_transfer')->nullable();
            $table->string('nama_pengirim')->nullable();
            $table->string('bank_pengirim')->nullable();
            $table->string('jenis_orderan')->nullable();
            $table->text('catatan_driver')->nullable();
            $table->enum('status_pembayaran', ['pending', 'dibayar', 'gagal'])->default('pending');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orderan_masuks');
    }
};