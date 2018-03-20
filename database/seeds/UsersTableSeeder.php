<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'Nico',
            'email' => 'nicov@gmail.com',
            'password' => bcrypt('secret'),
            'dni' => '34369854',
            //'comunidad_id' => 1,
            'apellido' => 'Viola'
        ]);
    }
}
