<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterAdiccionesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('adicciones', function (Blueprint $table) {
            $table->integer('fichaAdiccion_id')->unsigned();
            $table->foreign('fichaAdiccion_id')->references('id')->on('fichasAdicciones');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('adicciones', function (Blueprint $table) {
            //
        });
    }
}
