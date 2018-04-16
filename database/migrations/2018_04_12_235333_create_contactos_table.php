<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateContactosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contactos', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->string('tipo');
            $table->string('nombre')->nullable();
            $table->string('apellido')->nullable();
            $table->string('telefono')->nullable();
            $table->string('email')->nullable();
            $table->date('fechaNacimiento')->nullable();

            $table->integer('fichaFamiliaAmigos_id')->unsigned();
            $table->foreign('fichaFamiliaAmigos_id')->references('id')->on('fichasFamiliaAmigos');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('contactos');
    }
}
