<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEvaluacionDiagnosticasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('evaluacionesDiagnosticas', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->string('descripcion');
            //Foreign Keys    
            $table->integer('fichaMedica_id')->unsigned();
            $table->foreign('fichaMedica_id')->references('id')->on('fichasMedicas');
            $table->integer('profesional_id')->unsigned()->nullable();
            $table->foreign('profesional_id')->references('id')->on('profesionales');
            $table->integer('tratamiento_id')->unsigned()->nullable();
            $table->foreign('tratamiento_id')->references('id')->on('tratamientos');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('evaluacionesDiagnosticas');
    }
}
