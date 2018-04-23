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
            'apellido' => 'Viola',
            'tipoUsuario_id'=>'1',
        ]);

        DB::table('users')->insert([
            'name' => 'Dani',
            'email' => 'danig@gmail.com',
            'password' => bcrypt('secret'),
            'dni' => '35360949',
            'apellido' => 'Garay',
            'tipoUsuario_id'=>'2',
        ]);

        DB::table('users')->insert([
            'name' => 'Pepe',
            'email' => 'pepep@gmail.com',
            'password' => bcrypt('secret'),
            'dni' => '36363654',
            'apellido' => 'Perez',
            'tipoUsuario_id'=>'3',
        ]);
        DB::table('users')->insert([
            'name' => 'Martin',
            'email' => 'martin@gmail.com',
            'password' => bcrypt('secret'),
            'dni' => '33333333',
            'apellido' => 'Gonzalez',
            'tipoUsuario_id'=>'4',
        ]);
        DB::table('users')->insert([
            'name' => 'Agus',
            'email' => 'agus@gmail.com',
            'password' => bcrypt('secret'),
            'dni' => '44444444',
            'apellido' => 'Gallo',
            'tipoUsuario_id'=>'5',
        ]);
        DB::table('users')->insert([
            'name' => 'Gabi',
            'email' => 'gabi@gmail.com',
            'password' => bcrypt('secret'),
            'dni' => '55555555',
            'apellido' => 'Campagna',
            'tipoUsuario_id'=>'6',
        ]);
        DB::table('users')->insert([
            'name' => 'Olivia',
            'email' => 'oli@gmail.com',
            'password' => bcrypt('secret'),
            'dni' => '33333333',
            'apellido' => 'Martinez',
            'tipoUsuario_id'=>'7',
        ]);

    }
}
