<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class DropEnumOnEducacionesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('educaciones', function (Blueprint $table) {
            $table->dropColumn('tipo'); //drop enum
            //Foreign
            $table->integer('tipoEducacion_id')->unsigned();
            $table->foreign('tipoEducacion_id')->references('id')->on('tiposEducaciones');

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
            $table->dropColumn('tipoEducacion_id');
            $table->dropForeign('tipoEducacion_id');
        });
    }
}
