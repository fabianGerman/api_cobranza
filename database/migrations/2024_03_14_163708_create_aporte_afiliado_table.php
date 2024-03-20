<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAporteAfiliadoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('aporte_afiliado', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_aporte');
            $table->unsignedBigInteger('id_afiliado');
            $table->foreign('id_aporte')->references('id')->on('aportes')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('id_afiliado')->references('id')->on('afiliados')->onUpdate('cascade')->onDelete('cascade');
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
        Schema::dropIfExists('aporte_afiliado');
    }
}
