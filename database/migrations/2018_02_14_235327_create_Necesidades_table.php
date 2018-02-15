<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNecesidadesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('necesidades', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->enum('tipo',['Medicamentos','Protesis','Silla De Ruedas','Alimentos','Utiles Escolares','Ropa','Frazadas','Calzado','Material de construccion','Muebles','Otros (especificar)']);
            $table->string('especificacion');
            $table->date('fechaInicio');
            $table->date('fechaFin');

            $table->integer('fichasNecesidades_id')->unsigned();
            $table->foreign('fichasNecesidades_id')->references('id')->on('fichasNecesidades');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('necesidades');
    }
}
