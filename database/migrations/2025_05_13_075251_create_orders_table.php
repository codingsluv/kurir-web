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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users');
            $table->unsignedBigInteger('admin_id')->nullable(); // Tambahkan admin_id
            $table->foreign('admin_id')->references('id')->on('users');
            $table->timestamp('tanggal_pemesanan')->useCurrent();
            $table->decimal('total_harga', 10, 2);
            $table->enum('status_pemesanan', ['Menunggu Pembayaran', 'Diproses', 'Dikirim', 'Selesai', 'Dibatalkan'])->default('Menunggu Pembayaran');
            $table->text('alamat_pengiriman');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
