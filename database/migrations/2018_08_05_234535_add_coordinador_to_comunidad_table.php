<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddCoordinadorToComunidadTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('comunidades', function (Blueprint $table) {
            $table->integer('coordinador_id')->unsigned()->nullable();
            $table->foreign('coordinador_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('comunidades', function (Blueprint $table) {
            $table->dropColumn('coordinador_id');
            $table->dropForeign('coordinador_id');
        });
    }
}
