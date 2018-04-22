<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class DropEnumFromDatosPersonales extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('fichasDatosPersonales', function (Blueprint $table) {
            $table->dropColumn('sexo');
            $table->dropColumn('tipoDocumento');
            $table->dropColumn('estadoDocumento');
            $table->dropColumn('estadoCivil');
            /* Hago el Drop de las siguientes columnas
            $table->enum('sexo',['Masculino','Femenino'])->nullable();
            $table->enum('tipoDocumento',['DNI','CI','Pasaporte','LE','LC'])->nullable();
            $table->enum('estadoDocumento',['poseeConActualizacion','poseeSinActualizacion','noPosee','enTramite'])->nullable();
            $table->enum('estadoCivil',['Soltero','Casado','Viudo','Separado','Divorciado','Concubinato'])->nullable();
            */
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('fichasDatosPersonales', function (Blueprint $table) {
            //
        });
    }
}
