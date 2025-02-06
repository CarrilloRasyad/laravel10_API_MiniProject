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
        Schema::create('olahraga', function (Blueprint $table) {
            $table->id();
            $table->string('cabor');
            $table->string('jenis_olahraga');
            $table->integer('jumlah_pemain');
            $table->string('lokasi_bermain');
            $table->text('deskripsi');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('olahraga');
    }
};
