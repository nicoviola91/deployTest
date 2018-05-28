<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class MakeDefaultValuesToChecklists extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('fichasAdicciones', function (Blueprint $table) {
            $table->integer('checklistAdicciones')->default(0)->change();
            $table->integer('checklistTratamiento')->default(0)->change();
            $table->integer('checklistEpisodiosAgresivos')->default(0)->change();
            $table->integer('checklistRequiereInternacion')->default(0)->change();
            $table->integer('checklistRequiereDerivacion')->default(0)->change();
            $table->integer('checklistEmbarazo')->default(0)->change();
            

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
