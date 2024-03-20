<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRemuneracionDJDetallesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('remuneracion_d_j_detalles', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_remuneracion_dj')->nullable();
            $table->foreign('id_remuneracion_dj')->references('id')->on('remuneracion_d_d_j_j_s')->onDelete('cascade')->onUpdate('cascade');
            $table->integer('linea')->nullable();
            $table->integer('codigo_periodo')->nullable();
            $table->string('periodo')->nullable();
            $table->double('remuneracion_procesada')->nullable();
            $table->double('remuneracion_convenio')->nullable();
            $table->double('remuneracion_valida')->nullable();
            $table->double('aporte_esperado')->nullable();
            $table->double('contribucion_esperado')->nullable();
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
        Schema::dropIfExists('remuneracion_d_j_detalles');
    }
}
