<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMedicacionesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('medicaciones', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->string('droga');
            $table->string('dosis')->nullable();
            $table->string('posologia')->nullable();
            $table->date('inicio')->nullable();
            $table->date('fin')->nullable();
            $table->boolean('recetada')->nullable();

            $table->integer('tratamiento_id')->unsigned();
            $table->foreign('tratamiento_id')->references('id')->on('tratamientos');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('medicaciones');
    }
}
