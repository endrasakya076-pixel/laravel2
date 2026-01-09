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
        Schema::create('spesimen', function (Blueprint $table) {
            $table->id();
            $table->string('foto');
            $table->string('cif');
            $table->string('nama');
            $table->string('alamat');
            $table->string('nama_ibu');
            $table->string('alamat_ibu');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('spesimen');
    }
};
