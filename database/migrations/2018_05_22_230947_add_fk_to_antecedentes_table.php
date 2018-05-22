<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFkToAntecedentesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('antecedentes', function (Blueprint $table) {
            $table->integer('ramaDerecho_id')->unsigned();
            $table->foreign('ramaDerecho_id')->references('id')->on('ramasDerecho');
            $table->integer('fichaLegal_id')->unsigned();
            $table->foreign('fichaLegal_id')->references('id')->on('fichasLegales');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('antecedentes', function (Blueprint $table) {
            //
        });
    }
}
