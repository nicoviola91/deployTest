<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePivotTableFichasMedicasEnfermedades extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fichasMedicas_enfermedades', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->integer('fichaMedica_id')->unsigned();
            $table->foreign('fichaMedica_id')->references('id')->on('fichasMedicas');
            $table->integer('enfermedad_id')->unsigned();
            $table->foreign('enfermedad_id')->references('id')->on('enfermedades');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('fichasMedicas_enfermedades');
    }
}
