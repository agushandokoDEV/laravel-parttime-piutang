<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('no_skpd')->nullable();
            $table->enum('role', ['admin', 'nasabah']);
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            // $table->foreignId('id_jenis')->nullable();
            // $table->string('umur_piutang')->nullable();
            // $table->decimal('pokok', 10, 2)->nullable();
            // $table->date('tgl_piutang')->nullable();
            $table->string('password');
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
