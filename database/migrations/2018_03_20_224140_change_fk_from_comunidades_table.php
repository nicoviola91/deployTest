<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangeFkFromComunidadesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('comunidades', function (Blueprint $table) {
            $table->dropForeign(['parroquia_id']);
            $table->dropColumn('parroquia_id');
            $table->integer('institucion_id')->unsigned();
            $table->foreign('institucion_id')->references('id')->on('instituciones');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('comunidades', function (Blueprint $table) {
            //
        });
    }
}
