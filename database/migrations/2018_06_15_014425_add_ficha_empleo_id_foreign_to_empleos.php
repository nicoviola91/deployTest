<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFichaEmpleoIdForeignToEmpleos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('empleos', function (Blueprint $table) {
            $table->integer('fichaEmpleo_id')->unsigned();
            $table->foreign('fichaEmpleo_id')->references('id')->on('empleos');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('empleos', function (Blueprint $table) {
            //
        });
    }
}
