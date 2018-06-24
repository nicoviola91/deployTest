<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangeNameOfFieldFromFichasDiagnosticosIntegrales extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('fichasDiagnosticosIntegrales', function (Blueprint $table) {
            $table->renameColumn('asistidos_id','asistido_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('fichasDiagnosticosIntegrales', function (Blueprint $table) {
            //
        });
    }
}
