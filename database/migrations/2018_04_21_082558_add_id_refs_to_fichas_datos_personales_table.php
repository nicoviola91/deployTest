<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddIdRefsToFichasDatosPersonalesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('fichasDatosPersonales', function (Blueprint $table) {
            $table->integer('sexo_id')->unsigned();
            $table->foreign('sexo_id')->references('id')->on('sexos');
            $table->integer('estadoCivil_id')->unsigned();
            $table->foreign('estadoCivil_id')->references('id')->on('estadosCiviles');
            $table->integer('estadoDocumento_id')->unsigned();
            $table->foreign('estadoDocumento_id')->references('id')->on('estadosDocumentos');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('fichasDatosPersonales', function (Blueprint $table) {
            $table->dropColumn('sexo_id');
            $table->dropForeign('sexo_id');
            $table->dropColumn('estadoCivil_id');
            $table->dropForeign('estadoCivil_id');
            $table->dropColumn('estadoDocumento_id');
            $table->dropForeign('estadoDocumento_id');
        });
    }
}
