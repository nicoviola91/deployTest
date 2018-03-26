<?php

use Illuminate\Database\Seeder;

class NecesidadesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('necesidades')->insert([
            'tipo' => 'Medicamentos',
            'especificacion' => 'Ibuprofeno'
        ]);
        DB::table('necesidades')->insert([
            'tipo' => 'Protesis',
            'especificacion' => 'Cadera'
        ]);
        DB::table('necesidades')->insert([
            'tipo' => 'Ropa',
            'especificacion' => 'Calzado'
        ]);

    }
}
