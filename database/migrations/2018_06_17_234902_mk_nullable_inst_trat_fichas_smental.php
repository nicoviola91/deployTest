<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class MkNullableInstTratFichasSmental extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('fichasSaludMental', function (Blueprint $table) {
            $table->integer('institucion_id')->unsigned()->nullable()->change();
            $table->integer('tratamiento_id')->unsigned()->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('fichasSaludMental', function (Blueprint $table) {
            //
        });
    }
}
