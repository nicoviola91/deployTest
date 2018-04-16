<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableEpisodiosAgresivos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('episodiosAgresivos', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->string('tipo');
            $table->string('lugar')->nullable();
            $table->date('fecha')->nullable();

            $table->integer('fichaSaludMental_id')->nullable()->unsigned();
            $table->foreign('fichaSaludMental_id')->references('id')->on('fichasSaludMental');
            $table->integer('fichaAdiccion_id')->nullable()->unsigned();
            $table->foreign('fichaAdiccion_id')->references('id')->on('fichasAdicciones');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('episodiosAgresivos');
    }
}
