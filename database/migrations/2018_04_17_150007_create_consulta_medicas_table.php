<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateConsultaMedicasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('consulta_medicas', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->date('fecha');
            $table->string('diagnostico')->nullable();
        //Foreign Keys
            $table->integer('institucion_id')->unsigned()->nullable();
            $table->foreign('institucion_id')->references('id')->on('instituciones');
            $table->integer('profesional_id')->unsigned()->nullable();
            $table->foreign('profesional_id')->references('id')->on('profesionales');
            $table->integer('fichaMedica_id')->unsigned();
            $table->foreign('fichaMedica_id')->references('id')->on('fichasMedicas');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('consulta_medicas');
    }
}
