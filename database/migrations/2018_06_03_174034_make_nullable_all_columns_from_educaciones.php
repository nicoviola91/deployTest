<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class MakeNullableAllColumnsFromEducaciones extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('educaciones', function (Blueprint $table) {
            $table->string('institucion')->nullable()->change();
            $table->date('inicio')->nullable()->change();
            $table->date('fin')->nullable()->change();
            $table->text('comentarios')->nullable()->change();
            $table->string('orientacion')->nullable()->change();
            $table->string('tituloObtenido')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('educaciones', function (Blueprint $table) {
            //
        });
    }
}
