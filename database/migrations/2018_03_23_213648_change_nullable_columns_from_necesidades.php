<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangeNullableColumnsFromNecesidades extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('necesidades', function (Blueprint $table) {
            $table->dropColumn('especificacion');
            $table->dropColumn('fechaInicio');
            $table->dropColumn('fechaFin');
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
