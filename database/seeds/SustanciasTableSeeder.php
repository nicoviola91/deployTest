<?php

use Illuminate\Database\Seeder;

class SustanciasTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('sustancias')->insert([
            'sustancia'=>'Paco'
        ]);
        DB::table('sustancias')->insert([
            'sustancia'=>'Marihuana'
        ]);
        DB::table('sustancias')->insert([
            'sustancia'=>'Cocaina'
        ]);
        DB::table('sustancias')->insert([
            'sustancia'=>'Extasis'
        ]);
        DB::table('sustancias')->insert([
            'sustancia'=>'LSD'
        ]);
    }
}
