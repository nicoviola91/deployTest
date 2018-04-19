<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFichaMedicasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fichasMedicas', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            //Datos Basicos
            $table->integer('altura')->unsigned();
            $table->double('peso')->unsigned();
            //Campos String
            $table->string('alergicoA')->nullable();
            $table->string('obraSocial')->nullable();
            $table->string('antecedentes')->nullable();
            $table->string('observacionDiscapacidad')->nullable();
            //Checkboxes - Booleans    
            $table->boolean('checkAlergico')->default(false);
            $table->boolean('checkIntervencion')->default(false);
            $table->boolean('checkMedicacion')->default(false);
            $table->boolean('checkObraSocial')->default(false);
            $table->boolean('checkTratamiento')->default(false);
            $table->boolean('discapacidadVisual')->default(false);
            $table->boolean('discapacidadMotriz')->default(false);
            $table->boolean('discapacidadAuditiva')->default(false);            
            //Foreign Keys    
            $table->integer('tratamiento_id')->unsigned();
            $table->foreign('tratamiento_id')->references('id')->on('tratamientos');
            $table->integer('profesional_id')->unsigned();
            $table->foreign('profesional_id')->references('id')->on('profesionales');
            $table->integer('asistido_id')->unsigned();
            $table->foreign('asistido_id')->references('id')->on('asistidos');
                       
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('fichasMedicas');
    }
}
