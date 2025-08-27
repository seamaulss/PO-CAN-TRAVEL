<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            // ubah kolom status jadi string panjang (50 karakter cukup)
            $table->string('status', 50)->change();
        });
    }

    public function down(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            // fallback, misalnya balik ke varchar(10)
            $table->string('status', 10)->change();
        });
    }
};