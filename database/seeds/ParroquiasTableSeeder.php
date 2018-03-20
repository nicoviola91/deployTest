<?php

use Illuminate\Database\Seeder;

class ParroquiasTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('parroquias')->insert([

            'nombre' => 'San Roque',
            'direccion' => 'Plaza 1160',
            'telefono' => '46464646',
        ]);   

        DB::table('parroquias')->insert([

            'nombre' => 'San Nicolas',
            'direccion' => 'Santa Fe 1352',
            'telefono' => '43148965',
        ]);   
    }
}
