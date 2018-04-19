<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatPivotFichaMedicaPatologiaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //Tabla Pivote FICHA MEDICA - PATOLOGIA
        Schema::create('fichasMedicas_patologias', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            //Foreign Keys    
            $table->integer('fichaMedica_id')->unsigned();
            $table->integer('patologia_id')->unsigned();
            $table->foreign('fichaMedica_id')->references('id')->on('fichasMedicas');
            $table->foreign('patologia_id')->references('id')->on('patologias');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('fichasMedicas_patologias');
    }
}
