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
        Schema::create('pengantarans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pesanan_id')->constrained()->onDelete('cascade'); // Sudah ada sebelumnya
            $table->foreignId('product_id')->nullable()->constrained('products'); // Perubahan disini
            $table->foreignId('user_id')->nullable()->constrained('users');
            $table->dateTime('tanggal_pengiriman');
            $table->integer('jumlah')->nullable();
            $table->decimal('harga_satuan', 10, 2)->nullable();
            $table->string('status_pengantaran');
            $table->decimal('tarif_driver', 10, 2)->nullable();
            $table->timestamps();
            $table->unique(['pesanan_id', 'product_id', 'user_id']); // Tambahkan unique constraint baru
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pengantarans');
    }
};
