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
        Schema::table('users', function (Blueprint $table) {
        // Memperlebar kapasitas kolom jabatan
        $table->string('jabatan', 100)->change(); 
        
        // Menambahkan kolom role jika belum ada
        if (!Schema::hasColumn('users', 'role')) {
            $table->string('role')->default('admin')->after('jabatan');
        }
    });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
