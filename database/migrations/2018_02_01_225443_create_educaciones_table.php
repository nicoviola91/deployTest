<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEducacionesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('educaciones', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->enum('tipo',['primario','secundario','terciario','universitario','curso']);
            $table->string('nivelAlcanzado');
            $table->string('institucion');
            $table->date('inicio');
            $table->date('fin');
            $table->string('comentarios');
            $table->string('orientacion');
            $table->string('tituloObtenido');

            $table->integer('direccion_id')->unsigned();
            $table->foreign('direccion_id')->references('id')->on('direcciones');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('educaciones');
    }
}
