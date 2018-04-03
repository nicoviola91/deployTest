<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangeAsistidoIdFkName extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('asistido_comunidad', function (Blueprint $table) {
            $table->renameColumn('asistidos_id','asistido_id');
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
        Schema::table('asistido_comunidad', function (Blueprint $table) {
            //
        });
    }
}
