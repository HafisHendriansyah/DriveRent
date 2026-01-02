<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
// use App\Models\User;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('mobils', function (Blueprint $table) {
            // Primary Key
            $table->increments('id_mobil');

            // Foreign Key
            $table->unsignedInteger('id_admin');

            // Atribut mobil
            $table->string('no_polisi', 15)->unique();
            $table->string('merek', 50);
            $table->enum('jenis_mobil', ['Sedan', 'MPV', 'SUV']);
            $table->unsignedTinyInteger('kapasitas');
            $table->integer('harga_perhari');
            $table->string('foto', 225);
            $table->enum('status', ['tersedia', 'disewa']);

            $table->timestamps();
            $table->softDeletes();

            // Relasi Foreign Key
            $table->foreign('id_admin')
                ->references('id_admin')
                ->on('admins')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mobils');
    }
};
