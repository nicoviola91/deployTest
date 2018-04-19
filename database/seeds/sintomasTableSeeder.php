<?php

use Illuminate\Database\Seeder;

class sintomasTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('sintomas')->insert(['nombre' => 'Fiebre',]);
        DB::table('sintomas')->insert(['nombre' => 'Tos',]);
        DB::table('sintomas')->insert(['nombre' => 'Convulsiones',]);
        DB::table('sintomas')->insert(['nombre' => 'Alucinaciones',]);
        DB::table('sintomas')->insert(['nombre' => 'Mareos',]);
        DB::table('sintomas')->insert(['nombre' => 'Cefaleas',]);
        DB::table('sintomas')->insert(['nombre' => 'Dolor Abdominal',]);
        DB::table('sintomas')->insert(['nombre' => 'Diarrea',]);
        DB::table('sintomas')->insert(['nombre' => 'Vómitos',]);
        DB::table('sintomas')->insert(['nombre' => 'Sonda Vesical',]);
        DB::table('sintomas')->insert(['nombre' => 'Ano contra natura',]);
        DB::table('sintomas')->insert(['nombre' => 'Úlceras',]);
        DB::table('sintomas')->insert(['nombre' => 'Milasis',]);
        DB::table('sintomas')->insert(['nombre' => 'Hemorragias',]);
        DB::table('sintomas')->insert(['nombre' => 'Alergia',]);
        DB::table('sintomas')->insert(['nombre' => 'Infección',]);
        DB::table('sintomas')->insert(['nombre' => 'Fracturas',]);
        DB::table('sintomas')->insert(['nombre' => 'Taquicardia',]);
        DB::table('sintomas')->insert(['nombre' => 'Hipertensión',]);
        DB::table('sintomas')->insert(['nombre' => 'Hipotensión',]);
        DB::table('sintomas')->insert(['nombre' => 'Anemia',]);
        DB::table('sintomas')->insert(['nombre' => 'Deterioro general',]);
    }
}
