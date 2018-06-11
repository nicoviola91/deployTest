<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddZonaDePermanenciaIdToDirecciones extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('direcciones', function (Blueprint $table) {
            $table->integer('zonaDePermanencia_id')->unsigned()->nullable();
            $table->foreign('zonaDePermanencia_id')->references('id')->on('zonasDePermanencia');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('direcciones', function (Blueprint $table) {
            //
        });
    }
}
