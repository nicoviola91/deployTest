<?php

use Illuminate\Database\Seeder;

class tiposUsuariosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('tiposUsuarios')->insert(['descripcion' => 'default',]);
        DB::table('tiposUsuarios')->insert(['descripcion' => 'member',]);
        DB::table('tiposUsuarios')->insert(['descripcion' => 'admin',]);
        DB::table('tiposUsuarios')->insert(['descripcion' => 'Posadero',]);
    }
}
