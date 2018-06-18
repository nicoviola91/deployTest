<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddChecklistTieneEmpleoToFichasEmpleos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('fichasEmpleos', function (Blueprint $table) {
            $table->boolean('checklistTieneEmpleo')->default(1);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('fichasEmpleos', function (Blueprint $table) {
            //
        });
    }
}
