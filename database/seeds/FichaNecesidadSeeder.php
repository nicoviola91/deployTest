<?php

use Illuminate\Database\Seeder;

class FichaNecesidadSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('fichasNecesidades')->insert([
            'checklistNecesidades' => TRUE,
            'asistido_id' => 1,

        ]);   
    }
}
