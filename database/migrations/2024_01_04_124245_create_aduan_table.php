<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('aduan', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('no_tracking', 50);
            $table->string('judul_keluhan')->nullable();
            $table->string('keluhan')->nullable();
            $table->enum('kategori', ['Infrastruktur', 'Pelayanan Publik', 'Keamanan dan Ketertiban', 'Administrasi', 'Kesejahteraan Masyarakat', 'Fasilitas Umum'])->nullable();
            $table->enum('status', ['Diterima', 'Diproses', 'Ditolak', 'Selesai', 'Ditutup'])->nullable()->default('Diterima');
            $table->timestamp('created_at')->useCurrentOnUpdate()->useCurrent();
            $table->timestamp('updated_at')->nullable();
            $table->softDeletes();
            $table->unsignedBigInteger('created_by');
            $table->unsignedBigInteger('updated_by')->nullable();
            $table->unsignedBigInteger('deleted_by')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('aduan');
    }
};
