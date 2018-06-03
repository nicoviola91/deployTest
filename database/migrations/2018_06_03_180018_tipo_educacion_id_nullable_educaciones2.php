<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class TipoEducacionIdNullableEducaciones2 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('educaciones', function (Blueprint $table) {
            $table->integer('tipoEducacion_id')->unsigned()->nullable();
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
            //
        });
    }
}
