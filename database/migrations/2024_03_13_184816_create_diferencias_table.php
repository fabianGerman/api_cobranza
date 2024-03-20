<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDiferenciasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('diferencias', function (Blueprint $table) {
            $table->id();
            $table->double('importe')->nullable();
            $table->string('periodo')->nullable();
            $table->string('fecha_pago')->nullable();
            $table->unsignedBigInteger('id_afiliado')->nullable();
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
        Schema::dropIfExists('diferencias');
    }
}
