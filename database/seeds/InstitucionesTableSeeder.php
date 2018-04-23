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
            'telefono' => '46464646',
        ]);   

        DB::table('instituciones')->insert([
            'nombre' => 'San Nicolas',
            'telefono' => '43148965',
        ]);   
    }
}
