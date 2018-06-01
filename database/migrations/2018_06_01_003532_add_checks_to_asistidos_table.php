<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddChecksToAsistidosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('asistidos', function (Blueprint $table) {
            $table->integer('checkFichaEducacion')->default(0);
            $table->integer('checkFichaAdicciones')->default(0);
            $table->integer('checkFichaFamiliaAmigos')->default(0);
            $table->integer('checkFichaDatosPersonales')->default(0);
            $table->integer('checkFichaAsistenciaSocial')->default(0);
            $table->integer('checkFichaDiagnosticoIntegral')->default(0);
            $table->integer('checkFichaEmpleo')->default(0);
            $table->integer('checkFichaLegal')->default(0);
            $table->integer('checkFichaLocalizacion')->default(0);
            $table->integer('checkFichaMedica')->default(0);
            $table->integer('checkFichaNecesidad')->default(0);
            $table->integer('checkFichaSaludMental')->default(0);

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('asistidos', function (Blueprint $table) {
            //
        });
    }
}
