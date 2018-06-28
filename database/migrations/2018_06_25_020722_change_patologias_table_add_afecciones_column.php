<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangePatologiasTableAddAfeccionesColumn extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('patologias', function (Blueprint $table) {
            $table->dropForeign(['afeccion_id']);
            $table->dropColumn('afeccion_id');
            $table->string('tipo')->nullable();
            $table->integer('fichaSaludMental_id')->unsigned();
            $table->foreign('fichaSaludMental_id')->references('id')->on('fichasSaludMental');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('patologias', function (Blueprint $table) {
            //
        });
    }
}
