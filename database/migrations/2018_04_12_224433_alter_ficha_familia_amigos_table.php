<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterFichaFamiliaAmigosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('fichasFamiliaAmigos', function (Blueprint $table) {
            $table->dropColumn('madre');
            $table->dropColumn('padre');
            $table->dropColumn('hijos');
            $table->dropColumn('conyugue');
            $table->dropColumn('amigos');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('fichasFamiliaAmigos', function (Blueprint $table) {
            //
        });
    }
}
