<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDireccionesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('direcciones', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->string('calle');
            $table->integer('numero')->nullable();
            $table->integer('piso')->nullable();
            $table->string('departamento')->nullable();
            $table->string('entreCalles');
            $table->string('provincia');
            $table->string('codigoPostal')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('direcciones');
    }
}
