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
            'comunidad_id' => 1,
            'apellido' => 'Viola'
        ]);

        DB::table('users')->insert([
            'name' => 'Dani',
            'email' => 'danig@gmail.com',
            'password' => bcrypt('secret'),
            'dni' => '35360949',
            'comunidad_id' => 2,
            'apellido' => 'Garay'
        ]);

        DB::table('users')->insert([
            'name' => 'Pepe',
            'email' => 'pepep@gmail.com',
            'password' => bcrypt('secret'),
            'dni' => '36363654',
            'comunidad_id' => 3,
            'apellido' => 'Perez'
        ]);
    }
}
