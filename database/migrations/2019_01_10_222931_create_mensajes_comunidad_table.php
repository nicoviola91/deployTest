<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMensajesComunidadTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mensajesComunidad', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();

            $table->string('mensaje');
            $table->string('adjunto', 120)->nullable();

            $table->integer('created_by')->unsigned();
            $table->foreign('created_by')->references('id')->on('users');

            $table->integer('comunidad_id')->unsigned();
            $table->foreign('comunidad_id')->references('id')->on('comunidades');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('mensajesComunidad');
    }
}
