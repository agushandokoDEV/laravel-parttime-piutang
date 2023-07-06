<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKeputusanGubernursTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('keputusan_gubernurs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('usulans_id');
            $table->string('nomor_keputusan');
            $table->date('tgl_keputusan');
            $table->string('docs_keputusan');
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
        Schema::dropIfExists('keputusan_gubernurs');
    }
}
