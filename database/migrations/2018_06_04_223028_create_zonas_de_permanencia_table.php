<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateZonasDePermanenciaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('zonasDePermanencia', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->string('zona');
            $table->string('puntosDeReferencia')->nullable();
            $table->string('dias')->nullable();
            $table->string('de')->nullable();
            $table->string('hasta')->nullable();
            $table->text('observaciones')->nullable();

            $table->integer('fichaLocalizacion_id')->unsigned();
            $table->foreign('fichaLocalizacion_id')->references('id')->on('fichasLocalizacion');
            //falta correr migracion 
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('zonasDePermanencia');
    }
}
