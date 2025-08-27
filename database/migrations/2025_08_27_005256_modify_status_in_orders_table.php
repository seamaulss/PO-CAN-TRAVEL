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
    Schema::table('orders', function (Blueprint $table) {
        // kalau sebelumnya enum, ubah jadi string lebih fleksibel
        $table->string('status', 50)->change();
    });
}

public function down()
{
    Schema::table('orders', function (Blueprint $table) {
        // fallback (misalnya balik ke varchar 10)
        $table->string('status', 10)->change();
    });
}

};
