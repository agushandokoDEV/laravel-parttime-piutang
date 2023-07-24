<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSuratUsulansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('surat_usulans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('users_id');
            $table->foreignId('id_jenis')->nullable();
            $table->string('nama_peminjam')->nullable();
            $table->string('no_identitas')->nullable();
            $table->string('no_skrd');
            $table->string('nomor_surat')->nullable();
            $table->string('rincian');
            $table->decimal('denda', 10, 2)->nullable();
            $table->date('tgl_surat');
            $table->date('tgl_usulan');
            $table->decimal('nilai_rincian', 10, 2);
            $table->decimal('total_rincian', 10, 2);
            $table->longText('select_STS')->nullable();
            $table->string('select_ST')->nullable();
            $table->string('select_DL')->nullable();
            $table->longText('select_kriteria')->nullable();
            $table->string('docs_skdp')->nullable();
            $table->string('docs_lainnya')->nullable();
            $table->enum('status', ['ongoing', 'proses', 'validate'])->default('ongoing');
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
        Schema::dropIfExists('surat_usulans');
    }
}
