<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNullableColumnsFromNecesidades extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('necesidades', function (Blueprint $table) {
            $table->string('especificacion')->nullable();
            $table->date('fechaInicio')->nullable();
            $table->date('fechaFin')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('necesidades', function (Blueprint $table) {
            //
        });
    }
}
