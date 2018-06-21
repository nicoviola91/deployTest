<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangeNameOfFichaNecesidadFkInNecesidades extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('necesidades', function (Blueprint $table) {
            $table->renameColumn('fichasNecesidades_id','fichaNecesidad_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('necesidades', function (Blueprint $table) {
            //
        });
    }
}
