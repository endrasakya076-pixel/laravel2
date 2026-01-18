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
    Schema::table('spesimen', function (Blueprint $table) {
        // Menambahkan kolom user_id setelah kolom id (opsional agar rapi)
        $table->foreignId('user_id')->after('id')->constrained('users')->onDelete('cascade');
    });
    }

    public function down(): void
    {
    Schema::table('spesimen', function (Blueprint $table) {
        // Menghapus foreign key dan kolomnya
        $table->dropForeign(['user_id']);
        $table->dropColumn('user_id');
    });
    }
};
