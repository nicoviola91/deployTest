<?php

use Illuminate\Database\Seeder;

class DireccionesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('direcciones')->insert([

            'calle' => 'Falsa',
            'numero' => '123',
            'pais' => 'Argentina',
        ]);   

        DB::table('direcciones')->insert([

            'calle' => 'Falsa2',
            'numero' => '1234',
            'pais' => 'Argentina',
        ]);  
    }
}
