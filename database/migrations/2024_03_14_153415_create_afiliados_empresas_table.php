<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAfiliadosEmpresasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('afiliados_empresas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_afiliado');
            $table->unsignedBigInteger('id_empresa');
            $table->foreign('id_afiliado')->references('id')->on('afiliados')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('id_empresa')->references('id')->on('empresas')->onUpdate('cascade')->onDelete('cascade');
            $table->date('fecha_desde')->nullable();
            $table->date('fecha_hasta')->nullable();
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
        Schema::dropIfExists('afiliados_empresas');
    }
}
