<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddAsistidosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('asistidos', function (Blueprint $table) {
            
            
            $table->increments('id');
            $table->timestamps();
            $table->string('nombre');
            $table->string('apellido')->nullable();
            $table->string('email')->nullable();
            $table->date('fechaNacimiento')->nullable();
            $table->integer('dni')->nullable()->unsigned();
            $table->enum('sexo',['Masculino','Femenino']);
            $table->string('direccion')->nullable();
            $table->string('observaciones')->nullable();
            $table->string('foto')->default('default.jpg');

            $table->integer('comunidad_id')->unsigned();
            $table->foreign('comunidad_id')->references('id')->on('comunidades');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('asistidos');
    }
}
