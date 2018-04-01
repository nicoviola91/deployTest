<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFkToEducaciones extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('educaciones', function (Blueprint $table) {
            $table->integer('ficha_educacion_id')->unsigned();
            $table->foreign('ficha_educacion_id')->references('id')->on('fichasEducaciones');
            $table->dropForeign(['direccion_id']);
            $table->dropColumn('direccion_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('educaciones', function (Blueprint $table) {
            //
        });
    }
}
