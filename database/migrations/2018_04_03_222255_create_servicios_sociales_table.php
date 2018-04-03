<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateServiciosSocialesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('serviciosSociales', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();

            $table->date('fecha_inicio');
            $table->date('fecha_fin');

            $table->integer('institucion_id')->unsigned();
            $table->foreign('institucion_id')->references('id')->on('instituciones');

            $table->integer('fichaAsistenciaSocial_id')->unsigned();
            $table->foreign('fichaAsistenciaSocial_id')->references('id')->on('fichasAsistenciasSociales');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('servicios_sociales');
    }
}
