<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ConvertFieldsToNullableDirecciones extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('direcciones', function (Blueprint $table) {
            $table->integer('institucion_id')->unsigned()->nullable()->change();
            $table->integer('educacion_id')->unsigned()->nullable()->change();
            $table->integer('ficha_localizacion_id')->unsigned()->nullable()->change();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('direcciones', function (Blueprint $table) {
            //
        });
    }
}
