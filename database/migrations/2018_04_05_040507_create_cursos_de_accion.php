<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCursosDeAccion extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cursosDeAcciones', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->date('fechaDesde');
            $table->date('fechaHasta');
            $table->string('meta');
            $table->string('accion');

            $table->integer('fichaDiagnosticoIntegral_id')->unsigned();
            $table->foreign('fichaDiagnosticoIntegral_id')->references('id')->on('fichasDiagnosticosIntegrales');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cursosDeAcciones');
    }
}
