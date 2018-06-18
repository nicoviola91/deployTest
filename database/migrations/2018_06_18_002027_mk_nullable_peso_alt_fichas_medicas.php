<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class MkNullablePesoAltFichasMedicas extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('fichasMedicas', function (Blueprint $table) {
            $table->integer('altura')->unsigned()->nullable()->change();
            $table->integer('peso')->unsigned()->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('fichasMedicas', function (Blueprint $table) {
            //
        });
    }
}
