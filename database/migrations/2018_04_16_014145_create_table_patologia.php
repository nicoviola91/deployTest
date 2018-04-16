<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTablePatologia extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('patologias', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->string('descripcion');
            $table->string('comentarios')->nullable();

            $table->integer('afeccion_id')->nullable()->unsigned();
            $table->foreign('afeccion_id')->references('id')->on('afecciones');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('patologias');
    }
}
