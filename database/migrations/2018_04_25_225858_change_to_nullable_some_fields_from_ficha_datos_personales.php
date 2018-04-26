<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangeToNullableSomeFieldsFromFichaDatosPersonales extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('fichasDatosPersonales', function (Blueprint $table) {
            $table->integer('sexo_id')->unsigned()->nullable()->change();
            $table->integer('estadoCivil_id')->unsigned()->nullable()->change();
            $table->integer('estadoDocumento_id')->unsigned()->nullable()->change();
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
            //
        });
    }
}
