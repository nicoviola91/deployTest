<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangeToNullableDiagnosticoFromFichasDiagnosticosIntegrales extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('fichasDiagnosticosIntegrales', function (Blueprint $table) {
            $table->string('diagnostico')->nullable()->change();
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
