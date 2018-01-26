<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnsToAsistidos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('asistidos', function (Blueprint $table) {

            $table->string('nombre');
            $table->string('apellido')->nullable();
            $table->string('email')->nullable();
            $table->date('fechaNacimiento')->nullable();
            $table->integer('dni')->nullable()->unsigned();
            $table->enum('sexo',['Masculino','Femenino']);
            $table->string('direccion')->nullable();
            $table->string('observaciones')->nullable();
            $table->string('foto')->default('default.jpg');
            $table->boolean('estado');
        });
    }

    public function down()
    {
        Schema::table('asistidos', function (Blueprint $table) {
            //
        });
    }
}
