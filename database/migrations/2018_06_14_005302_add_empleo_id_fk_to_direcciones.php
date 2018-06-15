<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddEmpleoIdFkToDirecciones extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('direcciones', function (Blueprint $table) {
            $table->integer('empleo_id')->unsigned()->nullable();
            $table->foreign('empleo_id')->references('id')->on('empleos');
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
