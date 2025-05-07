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
        Schema::create('gajis', function (Blueprint $table) {
            $table->id();
            $table->foreignId('driver_id')->constrained()->cascadeOnDelete();
            $table->string('bulan'); // format: '2025-04'
            $table->integer('jumlah_pengantaran'); // jumlah pengantaran yang dilakukan driver di bulan ini
            $table->decimal('total_ongkir', 15, 2); // dari total biaya_tambahan bulan itu
            $table->decimal('gaji_driver', 15, 2);  // 70% dari total_ongkir
            $table->decimal('pendapatan_aplikasi', 15, 2); // 30% dari total_ongkir
            $table->timestamps();

            $table->unique(['driver_id', 'bulan']); // Biar tidak dobel entry untuk bulan yang sama
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('gajis');
    }
};