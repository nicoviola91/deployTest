<?php

use Illuminate\Database\Seeder;

class ComunidadesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('comunidades')->insert([

            'nombre'=> 'Comunidad 1',
            'tipo'=> 'nocheDeCaridad',
            'observaciones'=> 'test',
            
        ]);

        DB::table('comunidades')->insert([

            'nombre'=> 'Comunidad 2',
            'tipo'=> 'nocheDeCaridad',
            'observaciones'=> 'test2',
            
        ]);

        DB::table('comunidades')->insert([

            'nombre'=> 'Institucion 1',
            'tipo'=> 'institucion',
            'observaciones'=> 'test institucion',
            
        ]);
    }
}
