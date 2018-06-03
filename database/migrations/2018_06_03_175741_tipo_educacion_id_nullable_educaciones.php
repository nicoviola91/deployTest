<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class TipoEducacionIdNullableEducaciones extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('educaciones', function (Blueprint $table) {
            //SI LA MIGRACION FALLA AL CORRER, DESCOMENTAR ESTA COLUMNA Y VOLVER A CORRER!!
            $table->dropForeign(['tipoEducacion_id']);
            $table->dropColumn('tipoEducacion_id');
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
