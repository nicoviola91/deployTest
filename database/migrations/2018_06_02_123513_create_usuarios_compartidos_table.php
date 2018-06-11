<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsuariosCompartidosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('usuariosCompartidos', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users');
            $table->integer('asistido_id')->unsigned();
            $table->foreign('asistido_id')->references('id')->on('asistidos');
            $table->integer('fichaDatosPersonales_id')->unsigned()->nullable();
            $table->foreign('fichaDatosPersonales_id')->references('id')->on('fichasDatosPersonales');
            $table->integer('fichaAdicciones_id')->unsigned()->nullable();
            $table->foreign('fichaAdicciones_id')->references('id')->on('fichasAdicciones');
            $table->integer('fichaAsistenciaSocial_id')->unsigned()->nullable();
            $table->foreign('fichaAsistenciaSocial_id')->references('id')->on('fichasAsistenciasSociales');
            $table->integer('fichaDiagnosticoIntegral_id')->unsigned()->nullable();
            $table->foreign('fichaDiagnosticoIntegral_id')->references('id')->on('fichasDiagnosticosIntegrales');
            $table->integer('fichaEducacion_id')->unsigned()->nullable();
            $table->foreign('fichaEducacion_id')->references('id')->on('fichasEducaciones');
            $table->integer('fichaEmpleo_id')->unsigned()->nullable();
            $table->foreign('fichaEmpleo_id')->references('id')->on('fichasEmpleos');
            $table->integer('fichaFamiliaAmigos_id')->unsigned()->nullable();
            $table->foreign('fichaFamiliaAmigos_id')->references('id')->on('fichasFamiliaAmigos');
            $table->integer('fichaLegales_id')->unsigned()->nullable();
            $table->foreign('fichaLegales_id')->references('id')->on('fichasLegales');
            $table->integer('fichaLocalizacion_id')->unsigned()->nullable();
            $table->foreign('fichaLocalizacion_id')->references('id')->on('fichasLocalizacion');
            $table->integer('fichaMedica_id')->unsigned()->nullable();
            $table->foreign('fichaMedica_id')->references('id')->on('fichasMedicas');
            $table->integer('fichaSaludMental_id')->unsigned()->nullable();
            $table->foreign('fichaSaludMental_id')->references('id')->on('fichasSaludMental');
            $table->integer('fichaNecesidad_id')->unsigned()->nullable();
            $table->foreign('fichaNecesidad_id')->references('id')->on('fichasNecesidades');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('usuariosCompartidos');
    }
}
