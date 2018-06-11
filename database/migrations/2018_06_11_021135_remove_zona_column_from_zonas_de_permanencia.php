<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RemoveZonaColumnFromZonasDePermanencia extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('zonasDePermanencia', function (Blueprint $table) {
            $table->dropColumn('zona');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('zonasDePermanencia', function (Blueprint $table) {
            //
        });
    }
}
