<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChecklistNecesidadesFromFichasNecesidadesNeedsToBe0ByDefault extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('fichasNecesidades', function (Blueprint $table) {
            $table->boolean('checklistNecesidades')->default(0)->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('fichasNecesidades', function (Blueprint $table) {
            //
        });
    }
}
