<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAfiliadosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('afiliados', function (Blueprint $table) {
            $table->id();
            $table->integer('id_afiliado')->nullable();
            $table->integer('id_afiliado_sj')->nullable();
            $table->integer('id_empresa_sj')->nullable();
            $table->integer('id_plan')->nullable();
            $table->string('nro_afiliado')->nullable();
            $table->string('cuil')->nullable();
            $table->string('documento')->nullable();
            $table->string('ap_y_nom')->nullable();
            $table->integer('grupo_familiar')->nullable();
            $table->integer('monotributista')->nullable();
            $table->string('fecha_ingreso')->nullable();
            $table->string('fecha_inactivacion')->nullable();
            $table->string('fecha_alta')->nullable();
            $table->string('fecha_baja')->nullable();
            $table->integer('activo')->nullable();
            $table->integer('plan_vigente')->nullable();
            $table->integer('plan_actual')->nullable();
            $table->integer('plan_calculado')->nullable();
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
        Schema::dropIfExists('afiliados');
    }
}
