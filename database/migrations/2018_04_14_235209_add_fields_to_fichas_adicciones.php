<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFieldsToFichasAdicciones extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('fichasAdicciones', function (Blueprint $table) {
            $table->boolean('checklistTratamiento')->default(false);
            $table->boolean('checklistEpisodiosAgresivos')->default(false);
            $table->boolean('checklistRequiereDerivacion')->default(false);
            $table->boolean('checklistRequiereInternacion')->default(false);
            $table->boolean('checklistEmbarazo')->default(false);
            $table->string('observaciones')->nullable();
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
            $table->dropColumn('checklistTratamiento');
            $table->dropColumn('checklistEpisodiosAgresivos');
            $table->dropColumn('checklistRequiereDerivacion');
            $table->dropColumn('checklistRequiereInternacion');
            $table->dropColumn('checklistEmbarazo');
            $table->dropColumn('observaciones');

        });
    }
}
