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
        Schema::create('menu_pemesanan', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_menu')->unsigned();
            $table->foreignId('nomor_antrian')->unsigned();
            $table->integer('jumlah')->nullable();
            $table->integer('hargakalijumlah')->nullable();


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
        Schema::dropIfExists('menu_pemesanan');
    }
};
