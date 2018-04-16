<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableFichasSaludMental extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fichasSaludMental', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->boolean('checkSintomasMentales')->default(false);
            $table->string('signosObservables')->nullable();
            $table->boolean('orientado')->default(false);
            $table->boolean('intoxicado')->default(false);
            $table->string('discurso')->nullable();
            $table->boolean('checkMedicacion')->default(false);
            $table->boolean('checkTratamiento')->default(false);
            $table->boolean('checkAgresiones')->default(false);
            $table->boolean('checkDerivacion')->default(false);
            $table->boolean('checkInternacion')->default(false);

            $table->integer('institucion_id')->unsigned();
            $table->foreign('institucion_id')->references('id')->on('instituciones');
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
        Schema::dropIfExists('fichasSaludMental');
    }
}
