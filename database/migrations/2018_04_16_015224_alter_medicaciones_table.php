<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterMedicacionesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('medicaciones', function (Blueprint $table) {
            $table->integer('profesional_id')->nullable()->unsigned()->change();
            $table->integer('tratamiento_id')->nullable()->unsigned()->change();
            $table->integer('fichaSaludMental_id')->unsigned()->nullable();
            $table->foreign('fichaSaludMental_id')->references('id')->on('fichasSaludMental');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('medicaciones', function (Blueprint $table) {
            //
        });
    }
}
