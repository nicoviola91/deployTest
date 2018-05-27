<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangeAttributesTypeFromAdicciones extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('adicciones', function (Blueprint $table) {


            $table->dropForeign(['sustanciaInicio']);

            $table->dropForeign(['sustanciaFin']);
           
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('adicciones', function (Blueprint $table) {
            //
        });
    }
}
