<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEmpleosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('empleos', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->string('puesto');
            $table->string('empleador')->nullable();
            $table->string('descripcion');
            $table->date('inicio');
            $table->date('fin');
            $table->string('nombreReferente')->nullable();
            $table->string('telefonoReferente')->nullable();
            $table->string('puestoReferente')->nullable();
            $table->string('mailReferente')->nullable();

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
        Schema::dropIfExists('empleos');
    }
}
