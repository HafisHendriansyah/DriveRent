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
        Schema::create('pelanggans', function (Blueprint $table) {
            // Primary Key
            $table->increments('id_pelanggan');

            // Data pelanggan
            $table->string('nama_pelanggan', 100);
            $table->string('email_pelanggan', 100)->unique();
            $table->string('no_ktp', 20)->unique();
            $table->string('no_hp', 15)->unique();
            $table->text('alamat')->nullable();

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pelanggans');
    }
};
