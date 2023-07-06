<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSuratUsulanKNKPLSTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('surat_usulan_knkpls', function (Blueprint $table) {
            $table->id();
            $table->foreignId('usulans_id');
            $table->string('nomor_knkpl');
            $table->date('tgl_knkpl');
            $table->string('docs_knkpl');
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
        Schema::dropIfExists('surat_usulan_knkpls');
    }
}
