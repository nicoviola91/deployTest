<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFichasDiagnosticoIntegral extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fichasDiagnosticosIntegrales', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->string('diagnostico');
            $table->string('trabajoInterdisciplinario');
            
            $table->integer('asistidos_id')->unsigned();
            $table->foreign('asistidos_id')->references('id')->on('asistidos');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('fichasDiagnosticosIntegrales');
    }
}
