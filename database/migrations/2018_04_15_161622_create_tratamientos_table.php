<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTratamientosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tratamientos', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->string('tipo');
            $table->date('inicio');
            $table->date('fin');
            $table->string('estado');
            $table->string('causaDeFin');
            $table->string('comentarios');

            $table->integer('fichaAdiccion_id')->unsigned();
            $table->foreign('fichaAdiccion_id')->references('id')->on('fichasAdicciones');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tratamientos');

    }
}
