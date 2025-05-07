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
        Schema::create('detail_pesanans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pengantaran_id')->constrained('pengantarans')->cascadeOnDelete();

            $table->string('nama_makanan'); // Diisi oleh admin
            $table->integer('jumlah')->default(1); // Jumlah item yang dipesan, default 1
            $table->integer('harga_driver')->nullable(); // Diisi oleh driver
            $table->text('catatan')->nullable(); // Jika ada catatan khusus per item
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detail_pesanans');
    }
};