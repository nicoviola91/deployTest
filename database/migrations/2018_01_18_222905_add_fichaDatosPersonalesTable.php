<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFichaDatosPersonalesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fichasDatosPersonales', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->string('nombre');
            $table->string('apellido')->nullable();
            $table->enum('sexo',['Masculino','Femenino'])->nullable();
            $table->enum('tipoDocumento',['DNI','CI','Pasaporte','LE','LC'])->nullable();
            $table->enum('estadoDocumento',['poseeConActualizacion','poseeSinActualizacion','noPosee','enTramite'])->nullable();
            $table->integer('numeroDocumento')->nullable()->unsigned();
            $table->date('fechaNacimiento')->nullable();
            $table->integer('edad')->nullable()->unsigned();
            $table->boolean('tienePartida',false);
            $table->string('nacionalidad')->nullable();
            $table->date('fechaIngresoAlPais')->nullable();
            $table->enum('estadoCivil',['Soltero','Casado','Viudo','Separado','Divorciado','Concubinato'])->nullable();
            $table->string('celular')->nullable();
            $table->string('telefono')->nullable();
            $table->string('email')->nullable();
            $table->string('nombreContacto')->nullable();
            $table->string('telefonoContacto')->nullable();
            $table->string('mailContacto')->nullable();
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return  void
     */
    public function down()
    {
        Schema::dropIfExists('fichasDatosPersonales');
    }
}
