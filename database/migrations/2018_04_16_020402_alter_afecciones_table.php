<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterAfeccionesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('afecciones', function (Blueprint $table) {
            //esto esta repetido!!
            //$table->integer('fichaSaludMental_id')->nullable()->unsigned();
            //$table->foreign('fichaSaludMental_id')->references('id')->on('fichasSaludMental');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('afecciones', function (Blueprint $table) {
            $table->dropForeign(['fichaSaludMental_id']);
            $table->dropColumn('fichaSaludMental_id');
        });
    }
}
