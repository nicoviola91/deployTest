<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAsistidoComunidadTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('asistido_comunidad', function (Blueprint $table) {
            
            $table->integer('comunidad_id')->unsigned();
            $table->foreign('comunidad_id')->references('id')->on('comunidades');

            $table->integer('asistidos_id')->unsigned();
            $table->foreign('asistidos_id')->references('id')->on('asistidos');

            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('asistido_comunidad');
    }
}
