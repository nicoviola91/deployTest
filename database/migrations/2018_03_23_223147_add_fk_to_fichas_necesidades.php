<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFkToFichasNecesidades extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('fichasNecesidades', function (Blueprint $table) {
            $table->integer('asistido_id')->unsigned();
            $table->foreign('asistido_id')->references('id')->on('asistidos');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('fichasNecesidades', function (Blueprint $table) {
            //
        });
    }
}
