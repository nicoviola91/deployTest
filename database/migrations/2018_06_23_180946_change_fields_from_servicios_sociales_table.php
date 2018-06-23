<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangeFieldsFromServiciosSocialesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('serviciosSociales', function (Blueprint $table) {

            $table->dropForeign(['institucion_id']);
            $table->dropColumn('institucion_id');
            $table->string('tipo');
            $table->string('prestador')->nullable();
            $table->string('direccion')->nullable();
            $table->string('telefono')->nullable();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('serviciosSociales', function (Blueprint $table) {
            //
        });
    }
}
