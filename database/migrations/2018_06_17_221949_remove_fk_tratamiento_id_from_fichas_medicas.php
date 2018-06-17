<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RemoveFkTratamientoIdFromFichasMedicas extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('fichasMedicas', function (Blueprint $table) {
            $table->dropForeign(['tratamiento_id']);
            $table->dropColumn('tratamiento_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('fichasMedicas', function (Blueprint $table) {
            //
        });
    }
}
