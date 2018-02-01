<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterFichasFamiliaAmigosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('fichasFamiliaAmigos', function (Blueprint $table) {
            $table->integer('asistidos_id')->unsigned();
            $table->foreign('asistidos_id')->references('id')->on('asistidos');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('fichasFamiliaAmigos', function (Blueprint $table) {
            //
        });
    }
}
