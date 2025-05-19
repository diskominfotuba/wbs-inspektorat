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
        Schema::create('pengaduans', function (Blueprint $table) {
            $table->id();
            $table->string('prihal');
            $table->string('jenis');
            $table->text('alamat');
            $table->string('opd');
            $table->date('tanggal');
            $table->text('uraian');
            $table->string('file');
            $table->enum('status', ['diterima', 'diproses', 'pending', 'selesai'])->default('pending');
            $table->foreignId('user_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pengaduans');
    }
};
