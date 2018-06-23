<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangeDefaultValueFromChecklistAsistenciaSocial extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('fichasAsistenciasSociales', function (Blueprint $table) {
            $table->integer('checklistAsistenciaSocial')->default(0)->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('fichasAsistenciasSociales', function (Blueprint $table) {
            //
        });
    }
}
