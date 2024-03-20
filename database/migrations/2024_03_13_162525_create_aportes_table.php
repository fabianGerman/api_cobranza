<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAportesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('aportes', function (Blueprint $table) {
            $table->id();
            $table->integer('id_aporte')->nullable();
            $table->string('periodo_aporte')->nullable();
            $table->string('mes_afip')->nullable();
            $table->boolean('pago_por_oficina')->nullable();
            $table->integer('codigo_periodo_aporte')->nullable();
            $table->integer('codigo_mes_afip')->nullable();
            $table->string('fecha_incorporacion')->nullable();
            $table->string('cuit_empresa')->nullable();
            $table->string('cuil_afiliado')->nullable();
            $table->double('remuneracion')->nullable();
            $table->double('aporte')->nullable();
            $table->double('contribucion')->nullable();
            $table->double('subsidio')->nullable();
            $table->double('monotributo')->nullable();
            $table->double('total')->nullable();
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
        Schema::dropIfExists('aportes');
    }
}
