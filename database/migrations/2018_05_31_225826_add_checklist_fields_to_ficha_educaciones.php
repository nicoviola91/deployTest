<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddChecklistFieldsToFichaEducaciones extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('fichasEducaciones', function (Blueprint $table) {
            $table->integer('checklistPrimaria')->default(0);
            $table->integer('checklistSecundaria')->default(0);
            $table->integer('checklistTerciario')->default(0);
            $table->integer('checklistUniversitario')->default(0);
            $table->integer('checklistCursos')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('fichasEducaciones', function (Blueprint $table) {
            //
        });
    }
}
