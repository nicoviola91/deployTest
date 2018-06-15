<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class MakeEmpleosTableFieldsNullable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('empleos', function (Blueprint $table) {
            $table->string('descripcion')->nullable()->change();
            $table->date('inicio')->nullable()->change();
            $table->date('fin')->nullable()->change();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('empleos', function (Blueprint $table) {
            //
        });
    }
}
