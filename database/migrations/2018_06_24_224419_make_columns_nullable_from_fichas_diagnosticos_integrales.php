<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class MakeColumnsNullableFromFichasDiagnosticosIntegrales extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('fichasDiagnosticosIntegrales', function (Blueprint $table) {
            $table->string('trabajoInterdisciplinario')->nullable()->change();
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
