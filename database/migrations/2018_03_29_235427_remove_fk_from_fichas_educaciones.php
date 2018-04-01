<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RemoveFkFromFichasEducaciones extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('fichasEducaciones', function (Blueprint $table) {
            $table->dropForeign(['educacion_id']);
            $table->dropColumn('educacion_id');
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
