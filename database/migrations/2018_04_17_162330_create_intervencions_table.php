<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateIntervencionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('intervenciones', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->string('diagnostico');
            $table->string('tipoOperacion');
            $table->string('tratamientoIndicado');
            $table->string('medicacion');
            $table->date('fecha');
            //Foreign Keys
            $table->integer('profesional_id')->unsigned()->nullable();
            $table->foreign('profesional_id')->references('id')->on('profesionales');
            $table->integer('fichaMedica_id')->unsigned();
            $table->foreign('fichaMedica_id')->references('id')->on('fichasMedicas');
            $table->integer('institucion_id')->unsigned()->nullable();
            $table->foreign('institucion_id')->references('id')->on('instituciones');
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('intervenciones');
    }
}
