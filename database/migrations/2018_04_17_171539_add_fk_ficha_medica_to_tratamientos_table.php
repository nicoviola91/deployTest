<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFkFichaMedicaToTratamientosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tratamientos', function (Blueprint $table) {
            $table->integer('fichaMedica_id')->unsigned()->nullable();
            $table->foreign('fichaMedica_id')->references('id')->on('fichasMedicas');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tratamientos', function (Blueprint $table) {
            //
        });
    }
}
