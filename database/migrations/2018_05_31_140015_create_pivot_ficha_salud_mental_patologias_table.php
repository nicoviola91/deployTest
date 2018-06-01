<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePivotFichaSaludMentalPatologiasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //Tabla Pivote FICHA SALUD MENTAL - PATOLOGIA
        Schema::create('fichasSaludMental_patologias', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            //Foreign Keys    
            $table->integer('fichaSaludMental_id')->unsigned();
            $table->integer('patologia_id')->unsigned();
            $table->foreign('fichaSaludMental_id')->references('id')->on('fichasSaludMental');
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
        Schema::dropIfExists('fichasSaludMental_patologias');
    }
}
