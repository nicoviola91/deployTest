<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class TableComunidadObservacionesNullable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('comunidades', function (Blueprint $table) {
            //
            //$table->string('observaciones')->nullable()->change();
            DB::statement('ALTER TABLE comunidades CHANGE observaciones observaciones VARCHAR(255) NULL DEFAULT NULL;');
            //DB::statement('ALTER TABLE comunidades CHANGE observaciones url VARCHAR(200)');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('comunidades', function (Blueprint $table) {
            //
        });
    }
}
