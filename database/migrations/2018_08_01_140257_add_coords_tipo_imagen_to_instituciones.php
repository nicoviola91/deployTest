<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddCoordsTipoImagenToInstituciones extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('instituciones', function (Blueprint $table) {
            
            $table->string('descripcion')->nullable();
            $table->string('imagen')->nullable();
            $table->string('tipo')->nullable();
            $table->float('lat',10,6)->nullable();
            $table->float('long',10,6)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('instituciones', function (Blueprint $table) {
            //
        });
    }
}
