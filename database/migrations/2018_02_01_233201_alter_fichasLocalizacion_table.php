<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterFichasLocalizacionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('fichasLocalizacion', function (Blueprint $table) {
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
        Schema::table('fichasLocalizacion', function (Blueprint $table) {
            //
        });
    }
}
