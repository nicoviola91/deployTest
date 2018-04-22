<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddIdSexoToAsistidosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('asistidos', function (Blueprint $table) {
            $table->integer('sexo_id')->unsigned();
            $table->foreign('sexo_id')->references('id')->on('sexos');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('asistidos', function (Blueprint $table) {
            $table->dropColumn('sexo_id');
            $table->dropForeign('sexo_id');
        });
    }
}
