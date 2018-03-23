<?php

use Illuminate\Database\Seeder;

class InstitucionesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('instituciones')->insert([
            'nombre' => 'Caritas',
            'direccion_id' => 1,
            'telefono' => '46464646',
        ]);   

        DB::table('instituciones')->insert([
            'nombre' => 'San Nicolas',
            'direccion_id' => 2,
            'telefono' => '43148965',
        ]);   
    }
}
