<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pesanan_details', function (Blueprint $table) {
            $table->id(); // Kolom ID untuk pesanan detail
            $table->foreignId('pesanan_id') // Relasi ke tabel pesanan
                  ->constrained('pesanans') // Mengacu ke tabel pesanans dan kolom 'id'
                  ->onDelete('cascade'); // Hapus detail jika pesanan dihapus
            $table->foreignId('product_id') // Relasi ke tabel produk
                  ->constrained('products') // Mengacu ke tabel products dan kolom 'id'
                  ->onDelete('cascade'); // Hapus detail jika produk dihapus
            $table->integer('qty'); // Jumlah produk yang dibeli
            $table->decimal('price', 15, 2); // Harga per produk
            $table->timestamps(); // Kolom created_at dan updated_at
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pesanan_details'); // Hapus tabel pesanan_details saat rollback
    }
};
