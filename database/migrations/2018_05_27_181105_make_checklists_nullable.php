<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class MakeChecklistsNullable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('fichasAdicciones', function (Blueprint $table) {
            $table->integer('checklistAdicciones')->nullable()->change();
            $table->integer('checklistTratamiento')->nullable()->change();
            $table->integer('checklistEpisodiosAgresivos')->nullable()->change();
            $table->integer('checklistRequiereDerivacion')->nullable()->change();
            $table->integer('checklistRequiereInternacion')->nullable()->change();
            $table->integer('checklistEmbarazo')->nullable()->change();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('fichasAdicciones', function (Blueprint $table) {
            //
        });
    }
}
