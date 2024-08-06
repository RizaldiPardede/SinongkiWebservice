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
        Schema::create('pemesanan', function (Blueprint $table) {
            // $table->increments('id_pemesanan');
            $table->increments('nomor_antrian');
            $table->foreignId('id_user')->unsigned()->nullable();
            // $table->foreignId('id_menu')->unsigned()->nullable();
            // $table->foreignId('id_admin')->nullable();
            // $table->integer('jumlah_pemesanan')->nullable();
            // $table->integer('total_harga')->nullable();
            // $table->string('status')->nullable();
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
        Schema::dropIfExists('pemesanan');
    }
};
