<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdiccionesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('adicciones', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->string('frecuencia')->nullable();
            $table->string('modalidad')->nullable();
            $table->integer('edadInicio')->nullable();
            $table->integer('sustanciaInicio')->unsigned();
            $table->foreign('sustanciaInicio')->references('id')->on('sustancias');
            $table->integer('sustanciaFin')->unsigned();
            $table->foreign('sustanciaFin')->references('id')->on('sustancias');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('adicciones');
    }
}
