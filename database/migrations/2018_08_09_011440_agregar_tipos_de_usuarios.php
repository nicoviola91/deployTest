<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AgregarTiposDeUsuarios extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::table('tiposUsuarios')->insert(array(
            'id' => 10,
            'slug' => 'buenVecino',
            'nombre' => 'Buen Vecino',
            'descripcion' => 'Nuevos Usuarios. Solo pueden generar Alertas y hacer un seguimiento basico de sus Alertas'
        ));

        DB::table('tiposUsuarios')->insert(array(
            'id' => 20,
            'slug' => 'samaritano',
            'nombre' => 'Samaritano',
            'descripcion' => 'Pueden formar parte de Comunidades. Se les permite generar Alertas y compartirlas con los miembros de su Comunidad. Asi como hacer seguimiento de Alertas propias y las generadas por miembros de su Comunidad'
        ));

        DB::table('tiposUsuarios')->insert(array(
            'id' => 30,
            'slug' => 'coordinador',
            'nombre' => 'Coordinador',
            'descripcion' => 'Coordinador de Comunidad. Samaritano al cual se le da la posibilidad de Administrar el acceso de otros Samaritanos a su Comunidad.',
        ));

        DB::table('tiposUsuarios')->insert(array(
            'id' => 40,
            'slug' => 'profesional',
            'nombre' => 'Profesional',
            'descripcion' => 'Usuario con permisos para acceder a la informacion de Fichas de Asistidos de su Comunidad si firmo el Acuerdo de Confidencialidad.',
        ));

        DB::table('tiposUsuarios')->insert(array(
            'id' => 50,
            'slug' => 'posadero',
            'nombre' => 'Posadero',
            'descripcion' => 'Coordinador de Institucion. Usuario con permisos para Administrar una Institucion en particular y sus Comunidades. Si firma el Acuerdo de Confidencialidad tiene acceso a Fichas de Asistidos de ese Posadero.',
        ));

        DB::table('tiposUsuarios')->insert(array(
            'id' => 60,
            'slug' => 'administrador',
            'nombre' => 'Administrador',
            'descripcion' => 'Administrador Global. Tiene acceso total a la Aplicacion para Administrar Usuarios, Instituciones, Comunidades y Asistidos',
        ));

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
