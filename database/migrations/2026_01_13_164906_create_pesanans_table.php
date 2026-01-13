<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('pesanans', function (Blueprint $table) {
            $table->id(); // ID pesanan
            $table->foreignId('user_id') // Relasi ke tabel users
                  ->constrained() // Mengacu ke tabel users dan kolom 'id'
                  ->onDelete('cascade'); // Menghapus pesanan ketika user dihapus
            $table->decimal('total', 15, 2); // Total harga transaksi
            $table->string('payment_method'); // Metode pembayaran
            $table->string('status')->default('Menunggu Konfirmasi'); // Status pesanan, default Menunggu Konfirmasi
            $table->timestamps(); // Kolom created_at dan updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists('pesanans'); // Drop tabel pesanans jika rollback
    }
};
