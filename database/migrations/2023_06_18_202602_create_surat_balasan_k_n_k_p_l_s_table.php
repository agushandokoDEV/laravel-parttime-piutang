<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSuratBalasanKNKPLSTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('surat_balasan_knkpls', function (Blueprint $table) {
            $table->id();
            $table->foreignId('usulans_id');
            $table->string('nomor_balasan');
            $table->date('tgl_balasan');
            $table->string('docs_balasan');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('surat_balasan_knkpls');
    }
}
