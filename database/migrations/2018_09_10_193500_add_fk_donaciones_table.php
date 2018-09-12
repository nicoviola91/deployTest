<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFkDonacionesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('donaciones', function (Blueprint $table) {
            $table->integer('necesidad_id')->unsigned()->nullable();
            $table->foreign('necesidad_id')->references('id')->on('necesidades');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('donaciones', function (Blueprint $table) {
            $table->dropColumn('necesidad_id');
            $table->dropForeign('necesidad_id');
        });
    }
}
