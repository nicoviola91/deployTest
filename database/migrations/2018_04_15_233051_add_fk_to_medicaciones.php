<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFkToMedicaciones extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('medicaciones', function (Blueprint $table) {
            $table->integer('profesional_id')->unsigned();
            $table->foreign('profesional_id')->references('id')->on('profesionales');
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
            $table->dropForeign(['profesional_id']);
            $table->dropColumn('profesional_id');
        });
    }
}
