<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRemuneracionDDJJSTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('remuneracion_d_d_j_j_s', function (Blueprint $table) {
            $table->id();
            $table->string('fecha_incorporacion')->nullable();
            $table->string('fecha_estado')->nullable();
            $table->string('mes_impacto')->nullable();
            $table->string('estado')->nullable();
            $table->unsignedBigInteger('id_remuneracion');
            $table->foreign('id_remuneracion')->references('id')->on('remuneracions')->onUpdate('cascade')->onDelete('cascade');
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
        Schema::dropIfExists('remuneracion_d_d_j_j_s');
    }
}
