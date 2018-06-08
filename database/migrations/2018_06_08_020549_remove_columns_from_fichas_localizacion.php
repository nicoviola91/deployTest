<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RemoveColumnsFromFichasLocalizacion extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('fichasLocalizacion', function (Blueprint $table) {
            $table->dropColumn('zonaPermanencia');
            $table->dropColumn('situacionCalle');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('fichasLocalizacion', function (Blueprint $table) {
            //
        });
    }
}
