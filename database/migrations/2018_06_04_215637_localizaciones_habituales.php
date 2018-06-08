<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class LocalizacionesHabituales extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('localizacionesHabituales', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->string('condicion');
            $table->string('vivienda');
            $table->string('tipo');
            $table->string('referenteNombre')->nullable();
            $table->string('referenteTelefono')->nullable();
            $table->string('referenteEmail')->nullable();

            $table->integer('fichaLocalizacion_id')->unsigned();
            $table->foreign('fichaLocalizacion_id')->references('id')->on('fichasLocalizacion');
        });

        
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
