<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFichasEmpleosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fichasEmpleos', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();

            $table->integer('empleos_id')->unsigned();
            $table->foreign('empleos_id')->references('id')->on('empleos');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('fichasEmpleos');
    }
}
