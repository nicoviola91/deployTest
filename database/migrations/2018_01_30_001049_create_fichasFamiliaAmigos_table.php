<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFichasFamiliaAmigosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fichasFamiliaAmigos', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->string('madre');
            $table->string('padre');
            $table->string('hijos');
            $table->string('conyugue');
            $table->string('amigos');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('fichasFamiliaAmigos');
    }
}
