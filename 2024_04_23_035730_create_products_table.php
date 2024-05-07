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
    Schema::create('products', function (Blueprint $table) {
        $table->id();
        $table->string('foto');
        $table->text('nama_lengkap');
        $table->text('alamat_lengkap');
        $table->text('tempat_lahir');
        $table->date('tanggal_lahir');
        $table->text('jenis_kelamin');
        $table->text('jabatan');
        $table->date('mulai_masuk_kerja');
        $table->text('job_desc');
    });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
