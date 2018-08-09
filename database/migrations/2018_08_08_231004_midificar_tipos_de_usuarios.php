<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class MidificarTiposDeUsuarios extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tiposUsuarios', function (Blueprint $table) {
            
            //agregar columna slug -> usado como referencia para no manejarse por id
            $table->string('slug')->nullable();
            //agregar columna nombre -> human readable name
            $table->string('nombre')->nullable();
         });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tiposUsuarios', function (Blueprint $table) {
            //
        });
    }
}
