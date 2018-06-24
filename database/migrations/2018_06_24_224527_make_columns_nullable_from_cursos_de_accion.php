<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class MakeColumnsNullableFromCursosDeAccion extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('cursosDeAcciones', function (Blueprint $table) {
            $table->string('accion')->nullable()->change();
            $table->date('fechaDesde')->nullable()->change();
            $table->date('fechaHasta')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('cursosDeAcciones', function (Blueprint $table) {
            //
        });
    }
}
