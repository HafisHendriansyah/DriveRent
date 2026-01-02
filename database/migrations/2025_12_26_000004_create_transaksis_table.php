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
        Schema::create('transaksis', function (Blueprint $table) {
            // Primary Key
            $table->increments('id_transaksi');

            // Foreign Keys
            $table->unsignedInteger('id_pelanggan');
            $table->unsignedInteger('id_mobil');
            $table->unsignedInteger('id_admin');

            // Atribut transaksi
            $table->unsignedTinyInteger('lama_penyewaan');
            $table->date('tgl_pesan');
            $table->date('tgl_kembali');
            $table->integer('total_harga');
            $table->enum('status', ['PROSES', 'SELESAI']);

            $table->timestamps();
            $table->softDeletes();

            // Relasi FK
            $table->foreign('id_pelanggan')
                ->references('id_pelanggan')
                ->on('pelanggans');

            $table->foreign('id_mobil')
                ->references('id_mobil')
                ->on('mobils');

            $table->foreign('id_admin')
                ->references('id_admin')
                ->on('admins');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transaksis');
    }
};
