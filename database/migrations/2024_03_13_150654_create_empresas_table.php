<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmpresasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('empresas', function (Blueprint $table) {
            $table->id();
            $table->integer('id_empresa_sj')->nullable();
            $table->string('cuit')->nullable();
            $table->string('razon_social')->nullable();
            $table->integer('cantidad_afiliados')->nullable();
            $table->integer('cantidad_titulares')->nullable();
            $table->integer('cantidad_inconsistencias')->nullable();
            $table->integer('cantidad_titulares_activos')->nullable();
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
        Schema::dropIfExists('empresas');
    }
}
