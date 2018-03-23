<?php

use Illuminate\Database\Seeder;

class AsistidosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('asistidos')->insert([
            'nombre' => 'Juan',
            'sexo' => 'Masculino',
        ]);
    }
}
