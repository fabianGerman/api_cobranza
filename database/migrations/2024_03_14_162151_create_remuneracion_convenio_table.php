<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRemuneracionConvenioTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('remuneracion_convenio', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_remuneracion');
            $table->unsignedBigInteger('id_convenio');
            $table->foreign('id_remuneracion')->references('id')->on('remuneracions')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('id_convenio')->references('id')->on('convenios')->onUpdate('cascade')->onDelete('cascade');
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
        Schema::dropIfExists('remuneracion_convenio');
    }
}
