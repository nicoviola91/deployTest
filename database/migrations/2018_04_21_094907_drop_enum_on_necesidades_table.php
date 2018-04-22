<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class DropEnumOnNecesidadesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('necesidades', function (Blueprint $table) {
            $table->dropColumn('tipo'); //drop enum
            //Foreign
            $table->integer('tipoNecesidad_id')->unsigned();
            $table->foreign('tipoNecesidad_id')->references('id')->on('tiposNecesidades');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('necesidades', function (Blueprint $table) {
            $table->dropColumn('tipoNecesidad_id');
            $table->dropForeign('tipoNecesidad_id');
        });
    }
}
