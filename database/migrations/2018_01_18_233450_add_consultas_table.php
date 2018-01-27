<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddConsultasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('consultas', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->string('mensaje');
            
            $table->integer('ficha_id')->unsigned();
            $table->foreign('ficha_id')->references('id')->on('fichasDatosPersonales');
            
        });

        
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('consultas');
        
        Schema::table('consultas',function(Blueprint $table){
          
        });
    }
}
