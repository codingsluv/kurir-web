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
        Schema::create('pesanan_produk', function (Blueprint $table) {
            $table->id(); // Ini bisa Anda hapus jika tidak diperlukan
            $table->unsignedBigInteger('pesanan_id');
            $table->unsignedBigInteger('produk_id');
            $table->integer('jumlah');
            $table->decimal('harga_satuan', 10, 2);
            $table->timestamps();

            $table->foreign('pesanan_id')->references('id')->on('pesanans')->onDelete('cascade');
            $table->foreign('produk_id')->references('id')->on('products')->onDelete('cascade');

            // Kombinasi pesanan_id dan produk_id harus unik
            $table->unique(['pesanan_id', 'produk_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pesanan_produk');
    }
};
