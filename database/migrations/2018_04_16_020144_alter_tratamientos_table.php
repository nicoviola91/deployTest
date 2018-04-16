<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterTratamientosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tratamientos', function (Blueprint $table) {
            $table->integer('profesional_id')->nullable()->unsigned()->change();
            $table->integer('fichaAdiccion_id')->nullable()->unsigned()->change();
            $table->integer('fichaSaludMental_id')->nullable()->unsigned();
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
        Schema::table('tratamientos', function (Blueprint $table) {
            //
        });
    }
}
