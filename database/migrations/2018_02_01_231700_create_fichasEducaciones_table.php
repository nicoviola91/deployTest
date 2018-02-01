<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFichasEducacionesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fichasEducaciones', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();

            $table->integer('educacion_id')->unsigned();
            $table->foreign('educacion_id')->references('id')->on('educaciones');

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
        Schema::dropIfExists('fichasEducaciones');
    }
}
