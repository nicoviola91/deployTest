<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddParroquiasFkToComunidadesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('comunidades', function (Blueprint $table) {
            $table->integer('parroquia_id')->unsigned();
            $table->foreign('parroquia_id')->references('id')->on('parroquias');
            
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
