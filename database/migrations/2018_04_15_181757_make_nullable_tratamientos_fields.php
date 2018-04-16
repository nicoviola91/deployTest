<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class MakeNullableTratamientosFields extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tratamientos', function (Blueprint $table) {
            $table->date('inicio')->nullable()->change();
            $table->date('fin')->nullable()->change();
            $table->string('estado')->nullable()->change();
            $table->string('causaDeFin')->nullable()->change();
            $table->string('comentarios')->nullable()->change();
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
